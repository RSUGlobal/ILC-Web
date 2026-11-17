<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete();

            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();

            $table->foreignId('course_syllabus_id')->constrained()->cascadeOnDelete();

            $table->enum('grade', ['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F']);
            $table->unique(['teacher_id', 'student_id', 'course_syllabus_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
