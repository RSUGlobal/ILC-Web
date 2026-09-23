<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_syllabi', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('term');
            $table->unsignedTinyInteger('credits');
            foreach (['manager_name', 'manager_role', 'lecturer_name', 'lecturer_role', 'office_name', 'office_details'] as $field) {
                $table->string($field)->nullable();
            }
            $table->text('description');
            $table->text('eligibility')->nullable();
            foreach (['teaching_methods', 'objectives', 'assessments', 'grading', 'requirements', 'rules', 'schedule'] as $field) {
                $table->json($field);
            }
            $table->text('resources')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('pdf_name')->nullable();
            $table->timestamps();
        });

        Schema::create('course_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_syllabus_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('week');
            $table->string('title');
            $table->string('pdf_path')->nullable();
            $table->string('pdf_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_materials');
        Schema::dropIfExists('course_syllabi');
    }
};
