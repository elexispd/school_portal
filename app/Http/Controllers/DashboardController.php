<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // get total student, subjects and staff counts
        $totalStudents = \App\Models\Student::count();
        $totalSubjects = \App\Models\Subject::count();
        $totalStaff = User::where('role', '!=', 'student')->count();
        $recentStudents = \App\Models\Student::latest()->take(5)->get();
        return view('dashboard', compact(['totalStudents', 'totalSubjects', 'totalStaff', 'recentStudents']));
    }
}
