<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\FileUploadLink;
use App\Models\Form;
use App\Models\Student;
use App\Models\StudentForm;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $student = $user->students()->first();

        return view('student.profile', compact('user', 'student'));
    }

   public function grade()
{
    $student = Auth::user()->students()->first();

    if (!$student) {
        return view('student.grade', [
            'grades' => collect(),
        ]);
    }

    $grades = Grade::with('course')
        ->where('student_id', $student->id)
        ->get()
        ->groupBy('course_syllabus_id');

    return view('student.grade', compact('grades'));
}
    // student links

    public function links()
    {
        $user = Auth::user();
        $role = $user->role; // 'student', 'mentor', 'team_leader'

        // 1) Get ALL forms for the role, grouped by form_type
        $forms = Form::where('for_role', $role)
            ->where('is_active', true)
            ->orderBy('form_type')
            ->orderBy('created_at')
            ->get()
            ->groupBy('form_type');

        $completion = []; // nested: [$type][$formId] = bool

        if ($role === 'student') {
            $student = $user->students()->first();

            foreach ($forms as $type => $formList) {
                foreach ($formList as $form) {
                    $completed = StudentForm::where('student_id', $student->id)
                        ->where('form_id', $form->id)
                        ->exists();

                    $completion[$type][$form->id] = $completed;
                }
            }
        }
        $fileUploadLink = FileUploadLink::where('for_role', $role)->first();

        return view('student.links', compact('forms', 'fileUploadLink', 'completion'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $student = $user->students()->first();

        // Validate the request
        $request->validate([
            // Fields from the `users` table
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'line_id' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',

            // Fields from the `students` table
            'student_id' => 'required|string|unique:students,student_id,'.$student->id,

            // Password fields
            'current_password' => 'nullable|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the `users` table
        $user->update([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'line_id' => $request->line_id,
            'phone_number' => $request->phone_number,
        ]);

        // Update the `students` table
        $student->update([
            'student_id' => $request->student_id,
        ]);

        // Update password if provided and valid
        if ($request->filled('current_password')) {
            if (! Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }

    public function adminShow($id)
    {
        $student = Student::with('user')->findOrFail($id); // Fetch student with user info

        return view('admin.student-profile', compact('student'));
    }

    public function teamLeaderShow($id)
    {
        $student = Student::with('user')->findOrFail($id);

        return view('team_leader.student-profile', compact('student'));
    }

    // StudentController.php
    public function mentorShow($id)
    {
        // Load student with related user details
        $student = Student::with('user')->findOrFail($id);

        // Return view with student data
        return view('mentor.student-profile', compact('student'));
    }

    // Dashboard to show appointment details

    public function dashboard()
    {
        $student = Auth::user()->students()->first();

        $appointments = collect(); // make sure it's always defined

        if ($student) {
            $appointments = Appointment::with('timetable')
                ->where('student_id', $student->id)
                ->orderByDesc('created_at')
                ->take(5)
                ->get();
        }

        return view('student.dashboard', compact('appointments'));
    }
}
