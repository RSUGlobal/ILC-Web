<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseSyllabus;
use App\Models\Grade;
use App\Models\Student;

class GradeController extends Controller
{
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();

        $grades = $teacher->grades()->with(['student.user', 'course'])->latest()->get();

        return view('teacher.grades.index', compact('grades'));
    }

    public function create()
    {
        $courses = CourseSyllabus::query()->orderBy('code')->get();

        return view('teacher.grades.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,student_id'],
            'course_syllabus_id' => ['required', 'exists:course_syllabi,id'],
            'grade' => ['required', 'in:A,B+,B,C+,C,D+,D,F'],
        ]);

        $teacher = Auth::guard('teacher')->user();
        $student = Student::query()->where('student_id', $data['student_id'])->firstOrFail();

        Grade::updateOrCreate(
            [
                'teacher_id' => $teacher->id,
                'student_id' => $student->id,
                'course_syllabus_id' => $data['course_syllabus_id'],
            ],
            ['grade' => $data['grade']],
        );

        return redirect()->route('teacher.grades.index')->with('success', 'Student grade saved successfully.');
    }

    public function edit(int $id)
    {
        $grade = $this->teacherGrade($id);

        return view('teacher.grades.edit', compact('grade'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate(['grade' => ['required', 'in:A,B+,B,C+,C,D+,D,F']]);
        $this->teacherGrade($id)->update($data);

        return redirect()->route('teacher.grades.index')->with('success', 'Student grade updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->teacherGrade($id)->delete();

        return redirect()->route('teacher.grades.index')->with('success', 'Student grade deleted successfully.');
    }

    private function teacherGrade(int $id): Grade
    {
        return Grade::query()
            ->whereKey($id)
            ->where('teacher_id', Auth::guard('teacher')->id())
            ->firstOrFail();
    }
}
