<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseSyllabus extends Model
{
    protected $fillable = [
        'code', 'title', 'subtitle', 'term', 'credits', 'manager_name', 'manager_role',
        'lecturer_name', 'lecturer_role', 'office_name', 'office_details', 'description',
        'eligibility', 'teaching_methods', 'objectives', 'assessments', 'grading',
        'requirements', 'rules', 'schedule', 'resources',
    ];

    protected function casts(): array
    {
        return [
            'credits' => 'integer',
            'teaching_methods' => 'array',
            'objectives' => 'array',
            'assessments' => 'array',
            'grading' => 'array',
            'requirements' => 'array',
            'rules' => 'array',
            'schedule' => 'array',
        ];
    }

    public static function current(): ?self
    {
        return static::query()->first();
    }

    public static function blank(): self
    {
        $syllabus = new static;

        foreach (['teaching_methods', 'objectives', 'assessments', 'grading', 'requirements', 'rules', 'schedule'] as $field) {
            $syllabus->$field = [];
        }

        return $syllabus;
    }

    public function materials(): HasMany
    {
        return $this->hasMany(CourseMaterial::class)->orderBy('week')->orderBy('id');
    }
}
