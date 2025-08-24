<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdmissionNumberService;
use App\Models\SchoolClass;
use App\Models\Session;
use App\Models\Student;
use Illuminate\Support\Str;


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
        $classes = SchoolClass::where('status', 'active')->get();
        return view('students.search', compact('classes'));
    }


    public function create()
    {
        $classes = SchoolClass::where('status', 'active')->get();
        $sessions = Session::where('status', 'active')->get();
        return view('students.create', compact('classes', 'sessions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'admission_year' => 'required|digits:4|integer|min:2015|max:' . (date('Y') + 1),
            'class' => 'required|string|exists:school_classes,id',
            'classarm' => 'required|string',
            'gender' => 'required|in:male,female',
        ]);

        // Generate admission number with selected year
        $admissionNumber = $this->admissionService->generate($validated['admission_year']);

        // Create student record
        $student = Student::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'admission_number' => $admissionNumber,
            'admission_year' => $validated['admission_year'],
            'school_class_id' => $validated['class'],
            'class_arm' => $validated['classarm'],
            'gender' => $validated['gender'],
            'result_pin' => Str::random(8), // Generate random PIN
        ]);

        return redirect()->route('students.create')
                    ->with('success', "Student created successfully. Admission Number: $admissionNumber");
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = SchoolClass::where('status', 'active')->get();
        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        // Validate incoming data
        $validated = $request->validate([
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'required|string|max:255',
            'last_name'       => 'nullable|string|max:255',
            'school_class_id' =>  'required|string|exists:school_classes,id',
            'class_arm_id'    => 'required|string|exists:class_arms,id',
            'gender'          => 'required|in:male,female',
            'date_of_birth'   => 'nullable|date',
            'state_of_origin' => 'nullable|string|max:255',
            'address'         => 'nullable|string|max:500',
            'phone'           => 'nullable|string|max:20',
        ]);

        // Update the student record
        $student->update([
            'first_name'      => $validated['first_name'],
            'last_name'       => $validated['last_name'],
            'middle_name'     => $validated['middle_name'],
            'school_class_id' => $validated['school_class_id'],
            'class_arm'       => $validated['class_arm_id'],
            'gender'          => $validated['gender'],
            'date_of_birth'   => $validated['date_of_birth'],
            'state_of_origin' => $validated['state_of_origin'],
            'address'         => $validated['address'],
            'phone'           => $validated['phone'],
        ]);

        return redirect()
            ->route('students.show', $student->id)
            ->with('success', 'Student profile updated successfully.');
    }


    public function show($id) {
        $student = Student::findOrFail($id);
        $classes = SchoolClass::where('status', 'active')->get();
        return view('students.show', compact('student', 'classes'));
    }

    public function profile($id)
    {
        $student = Student::findOrFail($id);
        return view('students.profile', compact('student'));
    }



    public function studentResult(Request $request)
    {
        $query = Student::query();

        // Keyword search (admission no, first name, last name)
        if ($request->filled('keyword')) {
            $keyword = trim($request->keyword);
            $query->where(function($q) use ($keyword) {
                $q->where('admission_number', 'like', "%{$keyword}%")
                ->orWhere('first_name', 'like', "%{$keyword}%")
                ->orWhere('last_name', 'like', "%{$keyword}%");
            });
        }

        // Search by class
        if ($request->filled('class') && !$request->filled('classarm')) {
            $query->where('school_class_id', $request->class);
        }

        // Search by class + arm
        if ($request->filled('class') && $request->filled('classarm')) {
            $query->where('school_class_id', $request->class)
                ->where('class_arm', $request->classarm);
        }

        $students = $query->get()->whereNull('graduated_at');

        $classes = SchoolClass::where('status', 'active')->get();

        return view('students.index', compact('students', 'classes'));
    }

    public function searchList() {
        $classes = SchoolClass::where('status', 'active')->get();
        return view('students.searchlist', compact('classes'));
    }

    public function studentListResult(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer|exists:school_classes,id',
            'class_arm_id' => 'required|integer|exists:class_arms,id',
        ]);

        $students = Student::where('school_class_id', $request->class_id)
            ->where('class_arm', $request->class_arm_id)
            ->whereNull('graduated_at')
            ->get();

        $className = $students->isNotEmpty() ? $students->first()->schoolClass->name : '';
        $classArmName = $students->isNotEmpty() ? $students->first()->classArm->name : '';

        return view('students.studentlist', compact('students', 'className', 'classArmName'));
    }






}
