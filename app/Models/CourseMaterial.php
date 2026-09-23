<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    protected $fillable = ['week', 'title', 'pdf_path', 'pdf_name'];

    protected function casts(): array
    {
        return ['week' => 'integer', 'course_syllabus_id' => 'integer'];
    }
}
