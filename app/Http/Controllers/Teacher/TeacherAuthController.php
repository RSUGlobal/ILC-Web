<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeacherAuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('teacher.auth.login', [
            'registrationOpen' => ! Teacher::exists(),
        ]);
    }

    public function showRegistrationForm(): View|RedirectResponse
    {
        if (Teacher::exists()) {
            return redirect()->route('teacher.login');
        }

        return view('teacher.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        abort_if(Teacher::exists(), 403, 'Teacher registration is closed.');

        $this->normalizeEmail($request);

        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:72', 'confirmed'],
        ]);

        try {
            $teacher = Teacher::create($data);
        } catch (UniqueConstraintViolationException $exception) {
            if (Teacher::exists()) {
                abort(403, 'Teacher registration is closed.');
            }

            throw $exception;
        }

        Auth::guard('teacher')->login($teacher);
        $request->session()->regenerate();

        return redirect()->route('teacher.dashboard')->with('status', 'Your teacher account has been created.');
    }

    public function login(Request $request): RedirectResponse
    {
        $this->normalizeEmail($request);

        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:72'],
        ]);

        if (! Auth::guard('teacher')->attempt($credentials)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        return redirect()->route('teacher.dashboard');
    }

    public function dashboard(): View
    {
        return view('teacher.dashboard', [
            'teacher' => Auth::guard('teacher')->user(),
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    }

    private function normalizeEmail(Request $request): void
    {
        if (is_string($request->input('email'))) {
            $request->merge(['email' => Str::lower(trim($request->input('email')))]);
        }
    }
}
