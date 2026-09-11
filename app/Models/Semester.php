<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Semester extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'team_leader_slot_limits' => 'array',
        'table_capacity_grid' => 'array',
    ];

    public const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    public const HOUR_SLOTS = [
        '09:00-10:00', '10:00-11:00', '11:00-12:00', '12:00-13:00',
        '13:00-14:00', '14:00-15:00', '15:00-16:00', '16:00-17:00',
    ];

    public const HALF_HOUR_SLOTS = [
        '09:00-09:30', '09:30-10:00', '10:00-10:30', '10:30-11:00',
        '11:00-11:30', '11:30-12:00', '12:00-12:30', '12:30-13:00',
        '13:00-13:30', '13:30-14:00', '14:00-14:30', '14:30-15:00',
        '15:00-15:30', '15:30-16:00', '16:00-16:30', '16:30-17:00',
    ];

    public const TEAM_LEADER_TIME_SLOTS = ['09:00-11:00', '11:00-13:00', '13:00-15:00', '15:00-17:00'];

    // Academic year = Sem 1, Sem 2, and a Summer term (labeled "S").
    public const TERMS = [1 => 'Sem 1', 2 => 'Sem 2', 3 => 'S (Summer)'];

    public const DEFAULT_TEAM_LEADER_SLOT_LIMITS = [
        '09:00-11:00' => 2,
        '11:00-13:00' => 4,
        '13:00-15:00' => 4,
        '15:00-17:00' => 4,
    ];

    public const DEFAULT_TABLE_CAPACITY_DEFAULT = 10;

    public const STUDENTS_PER_SESSION = 5;

    /**
     * One explicit table-count per day x hour slot — no "any day" fallback,
     * so there's never ambiguity about which number applies. Mirrors the
     * values mentors/students already schedule against.
     */
    public const DEFAULT_TABLE_CAPACITY_GRID = [
        'Monday' => [
            '09:00-10:00' => 4, '10:00-11:00' => 4, '11:00-12:00' => 10, '12:00-13:00' => 10,
            '13:00-14:00' => 10, '14:00-15:00' => 10, '15:00-16:00' => 10, '16:00-17:00' => 10,
        ],
        'Tuesday' => [
            '09:00-10:00' => 4, '10:00-11:00' => 4, '11:00-12:00' => 10, '12:00-13:00' => 10,
            '13:00-14:00' => 10, '14:00-15:00' => 10, '15:00-16:00' => 10, '16:00-17:00' => 10,
        ],
        'Wednesday' => [
            '09:00-10:00' => 4, '10:00-11:00' => 4, '11:00-12:00' => 10, '12:00-13:00' => 10,
            '13:00-14:00' => 10, '14:00-15:00' => 10, '15:00-16:00' => 10, '16:00-17:00' => 10,
        ],
        'Thursday' => [
            '09:00-10:00' => 4, '10:00-11:00' => 4, '11:00-12:00' => 10, '12:00-13:00' => 10,
            '13:00-14:00' => 10, '14:00-15:00' => 10, '15:00-16:00' => 10, '16:00-17:00' => 10,
        ],
        'Friday' => [
            '09:00-10:00' => 4, '10:00-11:00' => 4, '11:00-12:00' => 10, '12:00-13:00' => 10,
            '13:00-14:00' => 10, '14:00-15:00' => 10, '15:00-16:00' => 10, '16:00-17:00' => 10,
        ],
    ];

    public static function current(): ?self
    {
        return static::where('is_current', true)->first();
    }

    public static function nameFor(int $year, int $term): string
    {
        $short = $term == 3 ? 'S' : "Sem {$term}";

        return "{$year} {$short}";
    }

    public function activate(): void
    {
        DB::transaction(function () {
            static::where('is_current', true)->update(['is_current' => false]);
            $this->update(['is_current' => true]);
        });
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function mentors()
    {
        return $this->hasMany(Mentor::class);
    }

    public function teamLeaders()
    {
        return $this->hasMany(TeamLeader::class);
    }

    public function teamLeaderSlotLimits(): array
    {
        return $this->team_leader_slot_limits ?: self::DEFAULT_TEAM_LEADER_SLOT_LIMITS;
    }

    public function tableCapacityDefault(): int
    {
        return $this->table_capacity_default ?? self::DEFAULT_TABLE_CAPACITY_DEFAULT;
    }

    /**
     * The full day x hour-slot capacity grid as configured for this
     * semester (or the historical defaults if not yet customized).
     */
    public function tableCapacityGrid(): array
    {
        return $this->table_capacity_grid ?: self::DEFAULT_TABLE_CAPACITY_GRID;
    }

    /**
     * Table capacity for an hour-long slot (e.g. "09:00-10:00") on a given
     * day, read directly from the grid. Falls back to the semester's
     * default only for a slot the grid doesn't cover (e.g. an extended
     * evening slot added after the grid was configured).
     */
    public function tableCapacityForHourSlot(?string $day, ?string $hourSlot): int
    {
        $grid = $this->tableCapacityGrid();

        return $grid[$day][$hourSlot] ?? $this->tableCapacityDefault();
    }

    /**
     * Same as tableCapacityForHourSlot, but for a half-hour slot (e.g.
     * "09:30-10:00"), resolved to the hour block it falls in.
     */
    public function tableCapacityForHalfHourSlot(?string $day, ?string $halfHourSlot): int
    {
        return $this->tableCapacityForHourSlot($day, self::hourSlotFor($halfHourSlot));
    }

    public static function hourSlotFor(?string $halfHourSlot): ?string
    {
        if (! $halfHourSlot || ! str_contains($halfHourSlot, '-')) {
            return null;
        }

        [$start] = explode('-', $halfHourSlot);
        [$hour] = explode(':', $start);
        $hour = (int) $hour;

        return sprintf('%02d:00-%02d:00', $hour, $hour + 1);
    }

    /**
     * Full day x hour-slot capacity matrix, for the mentor/admin
     * hour-based views to drive their table-number dropdown from.
     */
    public function hourSlotMatrix(): array
    {
        $matrix = [];
        foreach (self::DAYS as $day) {
            foreach (self::HOUR_SLOTS as $slot) {
                $matrix[$day][$slot] = $this->tableCapacityForHourSlot($day, $slot);
            }
        }

        return $matrix;
    }

    /**
     * Full day x half-hour-slot capacity matrix, for the student
     * appointment views (which pick half-hour slots directly).
     */
    public function halfHourSlotMatrix(): array
    {
        $matrix = [];
        foreach (self::DAYS as $day) {
            foreach (self::HALF_HOUR_SLOTS as $slot) {
                $matrix[$day][$slot] = $this->tableCapacityForHalfHourSlot($day, $slot);
            }
        }

        return $matrix;
    }
}
