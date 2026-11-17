<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
     protected $fillable = [
    'teacher_id',
    'student_id',
    'course_syllabus_id',
    'grade',
];
      public function teacher()
      {
          return $this->belongsTo(Teacher::class);
      }

        public function student()
        {
            return $this->belongsTo(Student::class);
        }

        public function course()
{
    return $this->belongsTo(CourseSyllabus::class, 'course_syllabus_id');
}
}
