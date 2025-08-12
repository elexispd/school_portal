<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdmissionNumberService;
use App\Models\SchoolClass;
use App\Models\Session;

class StudentController extends Controller
{
    protected $admissionService;

    public function __construct(AdmissionNumberService $admissionService)
    {
        $this->admissionService = $admissionService;
    }

    public function index()
    {
        // Logic to retrieve and display students
        return view('students.index');
    }

    public function create()
    {
        $classes = SchoolClass::where('status', 'active')->get();
        // $sessions = Session::where('status', 'active')->get();
        return view('students.create', compact('classes', 'sessions'));
    }

    public function store(Request $request)
    {
        $admissionNumber = $this->admissionService->generate();

        // ... rest of your logic
    }
}
