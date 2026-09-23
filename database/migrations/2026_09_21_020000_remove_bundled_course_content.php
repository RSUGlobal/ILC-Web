<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('course_materials', 'bundled_key')) {
            return;
        }

        $courseIds = DB::table('course_materials')
            ->whereNotNull('bundled_key')
            ->pluck('course_syllabus_id')
            ->unique();

        DB::table('course_materials')->whereNotNull('bundled_key')->delete();

        foreach ($courseIds as $courseId) {
            $syllabus = DB::table('course_syllabi')->find($courseId);
            if ($syllabus && ! $syllabus->pdf_path && $syllabus->created_at === $syllabus->updated_at
                && ! DB::table('course_materials')->where('course_syllabus_id', $courseId)->exists()) {
                DB::table('course_syllabi')->where('id', $courseId)->delete();
            }
        }

        Schema::table('course_materials', function (Blueprint $table) {
            $table->dropUnique(['bundled_key']);
        });
        Schema::table('course_materials', function (Blueprint $table) {
            $table->dropColumn('bundled_key');
        });
    }

    public function down(): void
    {
        // Removed starter content is intentionally not recreated.
    }
};
