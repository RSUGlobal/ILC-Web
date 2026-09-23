<?php

use App\Http\Controllers\Admin\AdminAnalyticController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminFileUploadLinkController;
use App\Http\Controllers\Admin\AdminFormController;
use App\Http\Controllers\Admin\AdminMentorTimetableController;
use App\Http\Controllers\Admin\AdminTeamLeaderTimetableController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\CourseSyllabusController;
use App\Http\Controllers\GuestPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Mentor\MentorController;
use App\Http\Controllers\Mentor\MentorFormController;
use App\Http\Controllers\Mentor\TimetableController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\Student\AppointmentController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentFormController;
use App\Http\Controllers\Teacher\CourseSyllabusController as TeacherCourseSyllabusController;
use App\Http\Controllers\Teacher\TeacherAuthController;
use App\Http\Controllers\TeamLeader\TeamLeaderController;
use App\Http\Controllers\TeamLeader\TeamLeaderFormController;
use App\Http\Controllers\TeamLeader\TeamLeaderTimetableController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MentorMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\TeamLeaderMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest');
});
Route::get('/playlist', [GuestPageController::class, 'showAllPlaylists'])->name('playlist');
Route::get('/', [GuestPageController::class, 'showStats'])->name('guest');

// Authentication Routes
Route::middleware(RedirectIfAuthenticated::class)->group(function () {

    Route::get('/register/student', [SignupController::class, 'showStudentRegistrationForm'])->name('register.student');
    Route::post('/register/student', [SignupController::class, 'registerStudent']);

    Route::get('/register/mentor', [SignupController::class, 'showMentorRegistrationForm'])->name('register.mentor');
    Route::post('/register/mentor', [SignupController::class, 'registerMentor']);

    Route::get('/register/admin', [SignupController::class, 'showAdminRegistrationForm'])->name('register.admin');
    Route::post('/register/admin', [SignupController::class, 'registerAdmin']);

    Route::get('/register/team-leader', [SignupController::class, 'showTeamLeaderRegistrationForm'])->name('register.team_leader');
    Route::post('/register/team-leader', [SignupController::class, 'registerTeamLeader']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');

});

// Teacher access is intentionally not linked from public or other role pages.
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::middleware(TeacherMiddleware::class.':guest')->group(function () {
        Route::get('/login', [TeacherAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [TeacherAuthController::class, 'login'])->middleware('throttle:5,1,teacher-login:')->name('login.store');
        Route::get('/register', [TeacherAuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [TeacherAuthController::class, 'register'])->middleware('throttle:5,1,teacher-register:')->name('register.store');
    });

    Route::middleware(TeacherMiddleware::class)->group(function () {
        Route::get('/dashboard', [TeacherAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('logout');
        Route::get('/syllabus', [TeacherCourseSyllabusController::class, 'edit'])->name('syllabus.edit');
        Route::put('/syllabus', [TeacherCourseSyllabusController::class, 'update'])->name('syllabus.update');
        Route::get('/syllabus/materials', [TeacherCourseSyllabusController::class, 'materials'])->name('syllabus.materials');
        Route::put('/syllabus/pdf', [TeacherCourseSyllabusController::class, 'uploadSyllabus'])->name('syllabus.pdf');
        Route::post('/syllabus/materials', [TeacherCourseSyllabusController::class, 'storeMaterial'])->name('materials.store');
        Route::put('/syllabus/materials/{material}', [TeacherCourseSyllabusController::class, 'updateMaterial'])->name('materials.update');
        Route::delete('/syllabus/materials/{material}', [TeacherCourseSyllabusController::class, 'destroyMaterial'])->name('materials.destroy');
    });
});

// Mentor Routes
Route::middleware([MentorMiddleware::class, 'auth'])->group(function () {
    Route::get('/mentor/dashboard', function () {
        return view('mentor.dashboard');
    })->name('mentor.dashboard');

    // Mentor Links
    Route::get('/mentor/links', [MentorController::class, 'links'])->name('mentor.links');
    Route::post('/mentor/links/{form}/complete', [MentorFormController::class, 'complete'])->name('mentor.forms.complete');
    Route::delete('/mentor/links/{form}/undo', [MentorFormController::class, 'undo'])->name('mentor.forms.undo');

    // Mentor Profile Management
    Route::get('/mentor/profile', [MentorController::class, 'show'])->name('mentor.profile');
    Route::put('/mentor/profile', [MentorController::class, 'update'])->name('mentor.update');

    Route::post('/mentor/image/upload', [MentorController::class, 'uploadImage'])->name('mentor.image.upload');

    // Timetable Routes
    Route::get('/mentor/timetables/reserve', [TimetableController::class, 'create'])->name('mentor.timetables.create');
    Route::post('/mentor/timetables/reserve', [TimetableController::class, 'store'])->name('mentor.timetables.store');

    Route::get('/mentor/timetables/show', [TimetableController::class, 'show'])->name('mentor.timetables.show');

    Route::get('/timetables/availability', [TimetableController::class, 'checkAvailability'])->name('timetables.availability');

    Route::get('/mentor/timetables/students', [TimetableController::class, 'searchStudents'])->name('mentor.timetables.students');

    Route::get('/mentor/nextsem/{mentor}', [MentorController::class, 'nextSemester'])->name('mentor.nextsem');
    // Route for mentor checker
    Route::post('/mentor/confirm-next-semester', [MentorController::class, 'confirmNextSemester'])->name('mentor.confirmNextSemester');
    // Mentor suspend and pause routes
    Route::get('/mentor/pause', [MentorController::class, 'pause'])->name('mentor.pause');
    Route::get('/mentor/suspended', [MentorController::class, 'suspended'])->name('mentor.suspended');
    // Route for mentors viewing student profile
    Route::get('/mentor/students/{id}', [StudentController::class, 'mentorShow'])->name('mentor.students.show');
});

// Student Routes
Route::middleware([StudentMiddleware::class, 'auth'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

    // Team Leader Consent Links
    Route::get('/student/links', [StudentController::class, 'links'])->name('student.links');
    Route::post('/student/links/{form}/complete', [StudentFormController::class, 'complete'])->name('student.forms.complete');
    Route::delete('/student/links/{form}/undo', [StudentFormController::class, 'undo'])->name('student.forms.undo');

    // Student Profile Management
    Route::get('/student/profile', [StudentController::class, 'show'])->name('student.profile');
    Route::put('/student/profile', [StudentController::class, 'update'])->name('student.update');

    Route::get('/student/mentors/{id}', [MentorController::class, 'studentShow'])->name('student.mentors.show');

    Route::get('/student/appointments/create', [AppointmentController::class, 'create'])->name('student.appointments.create');
    Route::post('/student/appointments/store', [AppointmentController::class, 'store'])->name('student.appointments.store');
    Route::get('/student/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('student.appointments.edit');
    Route::put('/student/appointments/{appointment}', [AppointmentController::class, 'update'])->name('student.appointments.update');

    Route::get('/student/appointments/availability', [AppointmentController::class, 'checkAvailability'])->name('student.appointments.availability');
});

// Admin Routes
Route::middleware([AdminMiddleware::class, 'auth'])->group(function () {
    Route::get('/admin/dashboard', action: function () {
        $totalStudents = \App\Models\User::whereHas('students')->count();
        $totalMentors = \App\Models\User::whereHas('mentors')->count();
        $totalTeamLeaders = \App\Models\User::whereHas('teamLeaders')->count();
        $totalForms = \App\Models\Form::count();
        $totalAppointments = \App\Models\Appointment::count();
        $totalTimetables = \App\Models\Timetable::count();

        return view('admin.dashboard', compact(
            'totalStudents', 'totalMentors', 'totalTeamLeaders',
            'totalForms', 'totalAppointments', 'totalTimetables'
        ));
    })->name('admin.dashboard');

    Route::get('/admin/profile', [AdminController::class, 'show'])->name('admin.profile');
    Route::put('/admin/profile', [AdminController::class, 'update'])->name('admin.update');

    // to check timetable of team leader
    Route::get('/admin/team-leaders-timetables', [AdminController::class, 'viewTeamLeadersTimetable'])->name('admin.team_leaders_timetable');

    // to check timetable of mentor-student timetable
    Route::get('/admin/mentor-students-timetable', [AdminController::class, 'viewMentorStudentsTimetable'])->name('admin.mentor_students_timetable');

    // Admin edits mentor/team-leader timetables (mentors and team leaders cannot edit their own)
    Route::get('/admin/mentors/{mentor_id}/timetable/edit', [AdminMentorTimetableController::class, 'edit'])->name('admin.mentor_timetable.edit');
    Route::put('/admin/mentors/{mentor_id}/timetable', [AdminMentorTimetableController::class, 'update'])->name('admin.mentor_timetable.update');

    Route::get('/admin/team-leaders/{team_leader_id}/timetable/edit', [AdminTeamLeaderTimetableController::class, 'edit'])->name('admin.team_leader_timetable.edit');
    Route::put('/admin/team-leaders/{team_leader_id}/timetable', [AdminTeamLeaderTimetableController::class, 'update'])->name('admin.team_leader_timetable.update');

    // Admin see all users and delete
    Route::get('/admin/users/index', [AdminController::class, 'viewUsers'])->name('admin.users.index'); // View all users
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete'); // Delete a user

    // Admin: manage semesters (start a new semester without wiping data)
    Route::get('/admin/semesters', [SemesterController::class, 'index'])->name('admin.semesters.index');
    Route::post('/admin/semesters', [SemesterController::class, 'store'])->name('admin.semesters.store');
    Route::get('/admin/semesters/{semester}/edit', [SemesterController::class, 'edit'])->name('admin.semesters.edit');
    Route::put('/admin/semesters/{semester}', [SemesterController::class, 'update'])->name('admin.semesters.update');
    Route::put('/admin/semesters/{semester}/activate', [SemesterController::class, 'activate'])->name('admin.semesters.activate');

    // See Profiles
    Route::get('/admin/mentors/{id}', [MentorController::class, 'adminShow'])->name('admin.mentors.show');
    Route::get('/admin/students/{id}', [StudentController::class, 'adminShow'])->name('admin.students.show');
    Route::get('/admin/team-leaders/{id}', [TeamLeaderController::class, 'adminShow'])->name('admin.team_leaders.show');

    // Admin Forms
    // Display a list of forms
    Route::get('admin/forms', [AdminFormController::class, 'index'])->name('admin.forms.index');

    // Show the form for creating a new form
    Route::get('admin/forms/create', [AdminFormController::class, 'create'])->name('admin.forms.create');

    // Store a newly created form
    Route::post('admin/forms', [AdminFormController::class, 'store'])->name('admin.forms.store');

    // Show the form for editing the specified form
    Route::get('admin/forms/{form}/edit', [AdminFormController::class, 'edit'])->name('admin.forms.edit');

    // Update the specified form in the database
    Route::put('admin/forms/{form}', [AdminFormController::class, 'update'])->name('admin.forms.update');

    // Delete the specified form
    Route::delete('admin/forms/{form}', [AdminFormController::class, 'destroy'])->name('admin.forms.destroy');

    // Display the details of a specific form
    Route::get('admin/forms/{form}', [AdminFormController::class, 'show'])->name('admin.forms.show');

    // Admin Form Tracking
    Route::get('/admin/form-tracking', [AdminFormController::class, 'tracking'])->name('admin.forms.tracking');

    Route::get('/admin/file_upload_links/create', [AdminFileUploadLinkController::class, 'create'])->name('admin.file_upload_links.create');

    // Admin File Upload Links
    Route::post('/admin/file_upload_links', [AdminFileUploadLinkController::class, 'store'])->name('admin.file_upload_links.store');

    Route::get('/admin/file_upload_links/{file_upload_link}', [AdminFileUploadLinkController::class, 'show'])->name('admin.file_upload_links.show');

    Route::get('/admin/file_upload_links/{file_upload_link}/edit', [AdminFileUploadLinkController::class, 'edit'])->name('admin.file_upload_links.edit');

    Route::put('/admin/file_upload_links/{file_upload_link}', [AdminFileUploadLinkController::class, 'update'])->name('admin.file_upload_links.update');

    Route::delete('/admin/file_upload_links/{file_upload_link}', [AdminFileUploadLinkController::class, 'destroy'])->name('admin.file_upload_links.destroy');

    Route::get('/admin/attendance', [AttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::post('/admin/attendance/preview', [AttendanceController::class, 'preview'])->name('admin.attendance.preview');

    Route::get('/admin/database-analytics', [AdminAnalyticController::class, 'index'])->name('admin.database_analytics');

});

// Team Leader Routes
Route::middleware([TeamLeaderMiddleware::class, 'auth'])->group(function () {
    Route::get('/team-leader/dashboard', [TeamLeaderController::class, 'dashboard'])->name('team_leader.dashboard');

    // Team Leader Consent Links
    Route::get('/team-leader/links', [TeamLeaderController::class, 'links'])->name('team_leader.links');
    Route::post('/team-leader/links/{form}', [TeamLeaderFormController::class, 'markCompleted'])->name('team_leader.forms.complete');
    Route::delete('/team-leader/links/{form}/undo', [TeamLeaderFormController::class, 'undo'])->name('team_leader.forms.undo');

    // Team Leader Timetable Management
    Route::get('/team-leader/view-timetables', [TeamLeaderController::class, 'viewTimetables'])->name('team_leader.view_timetables');

    Route::get('/team-leader/profile', [TeamLeaderController::class, 'show'])->name('team_leader.profile');
    Route::put('/team-leader/profile', [TeamLeaderController::class, 'update'])->name('team_leader.update');

    // for reserve their timetables
    Route::get('/team-leader/timetable', [TeamLeaderTimetableController::class, 'create'])->name('team_leader.timetable.create');
    Route::post('/team-leader/timetable', [TeamLeaderTimetableController::class, 'store'])->name('team_leader.timetable.store');

    // Check Availability
    Route::get('/team-leader/timetable/availability', [TeamLeaderTimetableController::class, 'checkAvailability'])
        ->name('team_leader.timetable.availability');

    Route::post('/team-leader/image/upload', [TeamLeaderController::class, 'uploadImage'])->name('team_leader.image.upload');

    // Team Leader Viewing Student and Mentor Profiles
    Route::get('/team-leader/students/{id}', [StudentController::class, 'teamLeaderShow'])->name('team_leader.students.show');
    Route::get('/team-leader/mentors/{id}', [MentorController::class, 'teamLeaderShow'])->name('team_leader.mentors.show');
});

// Guest Page Route

Route::get('/components/newsletter', function () {
    return view('components.newsletter');
})->name('newsletter')->withoutMiddleware(RedirectIfAuthenticated::class);

Route::get('/components/publications', function () {
    return view('components.publications');
})->name('publications')->withoutMiddleware(RedirectIfAuthenticated::class);

Route::get('/components/about', function () {
    return view('components.about');
})->name('about')->withoutMiddleware(RedirectIfAuthenticated::class);

Route::get('/course', [CourseSyllabusController::class, 'show'])->name('course.show');
Route::get('/course/pdf', [CourseSyllabusController::class, 'pdf'])->name('course.pdf');
Route::get('/course-materials/{material}/pdf', [CourseSyllabusController::class, 'material'])->name('course.materials.pdf');

// Logout

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
