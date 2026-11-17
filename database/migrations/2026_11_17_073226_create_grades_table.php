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
        $table->foreign('teacher_id')
              ->references('id')
              ->on('teachers')
              ->onDelete('cascade');

        $table->foreignId('student_id')
              ->constrained('students')
              ->onDelete('cascade');

               $table->foreignId('course_syllabus_id')
          ->constrained('course_syllabi')
          ->onDelete('cascade');

        $table->enum('grade', ['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F']);

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
