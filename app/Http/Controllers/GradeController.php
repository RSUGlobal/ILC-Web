<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Student\StudentController;
use App\Models\CourseSyllabus;
use App\Models\Grade;
use App\Models\Student;

class GradeController extends Controller
{
    //
   public function index()
{
    $teacher = Auth::guard('teacher')->user();

    $grades = $teacher->grades()->with(['student', 'course'])->get();

    return view('teacher.grades.index', compact('grades'));
}
public function create()
{
    $courses = CourseSyllabus::all();
    return view('teacher.grades.create', compact('courses'));
}

public function store(Request $request)
{
    $request->validate([
        'student_id' => ['required', 'exists:students,student_id'],
        'course_syllabus_id' => ['required', 'exists:course_syllabi,id'],
        'grade' => ['required', 'in:A,B+,B,C+,C,D+,D,F'],
    ]);

    $teacher = Auth::guard('teacher')->user();

    $student = Student::where('student_id', $request->student_id)
        ->firstOrFail();

    Grade::updateOrCreate(
        [
            'teacher_id' => $teacher->id,
            'student_id' => $student->id,
            'course_syllabus_id' => $request->course_syllabus_id,
        ],
        [
            'grade' => $request->grade,
        ]
    );

    return redirect()
        ->route('teacher.grades.index')
        ->with('success', 'Student grade saved successfully!');
}
   public function edit($id)
{
    $teacher = Auth::guard('teacher')->user();

    $grade = Grade::where('id', $id)
        ->where('teacher_id', $teacher->id)
        ->firstOrFail();

    return view('teacher.grades.edit', compact('grade'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'grade' => ['required', 'in:A,B+,B,C+,C,D+,D,F'],
    ]);

    $teacher = Auth::guard('teacher')->user();

    $grade = Grade::where('id', $id)
        ->where('teacher_id', $teacher->id)
        ->firstOrFail();

    $grade->update([
        'grade' => $request->grade,
    ]);

    return redirect()
        ->route('teacher.grades.index')
        ->with('success', 'Student grade updated successfully!');
}
public function destroy($id)
{
    $teacher = Auth::guard('teacher')->user();

    $grade = Grade::where('id', $id)
        ->where('teacher_id', $teacher->id)
        ->firstOrFail();

    $grade->delete();

    return redirect()
        ->route('teacher.grades.index')
        ->with('success', 'Student grade deleted successfully!');
}
}
