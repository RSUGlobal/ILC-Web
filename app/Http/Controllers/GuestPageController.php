<?php

namespace App\Http\Controllers;

use App\Models\CourseSyllabus;
use App\Models\User;

class GuestPageController extends Controller
{
    public function showStats()
    {
        $totalUsers = User::count();
        $totalMentors = User::whereHas('mentors')->count();
        $totalTeamLeaders = User::whereHas('teamLeaders')->count();
        $totalStudents = User::whereHas('students')->count();
        $courseSyllabi = CourseSyllabus::query()->latest()->get();

        // Data is passed here. If the route points here, the view WILL receive these variables.
        return view('guest', compact('totalUsers', 'totalMentors', 'totalTeamLeaders', 'totalStudents', 'courseSyllabi'));
    }

    public function showAllPlaylists()
    {
        return view('youtube');
    }
}
