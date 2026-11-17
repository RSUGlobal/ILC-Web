<?php

namespace App\Models;

use App\Scopes\CurrentSemesterScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy([CurrentSemesterScope::class])]
class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function studentForms()
    {
        return $this->hasMany(\App\Models\StudentForm::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
