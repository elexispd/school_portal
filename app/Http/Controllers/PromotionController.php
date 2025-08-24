<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Promotion;
use App\Models\Session;

class PromotionController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display students
        $classes = SchoolClass::where('status', 'active')->get();
        return view('promotions.search', compact('classes'));
    }

    public function studentResult(Request $request)
    {
        $query = Student::query();

        // Keyword search (admission no, first name, last name)
        if ($request->filled('keyword')) {
            $keyword = trim($request->keyword);
            $query->where(function ($q) use ($keyword) {
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
        $sessions = Session::where('status', 'active')->get();

        return view('promotions.index', compact('students', 'classes', 'sessions'));
    }




    public function promoteStudents(Request $request)
    {
        $request->validate([
            'student_ids'     => 'required|array',
            'to_class_id'     => 'nullable|exists:school_classes,id',
            'to_class_arm_id' => 'nullable|exists:class_arms,id',
            'graduated'       => 'nullable|boolean',
            'graduated_at'    => 'nullable|date'
        ]);

        foreach ($request->student_ids as $studentId) {
            $student = Student::findOrFail($studentId);

            if ($request->graduated) {
                // mark student as graduated
                $student->graduated_at = $request->graduated_at;
                $student->save();
            } else {
                // normal promotion
                Promotion::create([
                    'student_id'        => $student->id,
                    'from_class_id'     => $request->from_class_id,
                    'from_class_arm_id' => $request->from_class_arm_id,
                    'to_class_id'       => $request->to_class_id,
                    'to_class_arm_id'   => $request->to_class_arm_id,
                ]);

                // update student’s current class/arm
                $student->school_class_id = $request->to_class_id;
                $student->class_arm = $request->to_class_arm_id;
                $student->save();
            }
        }

        return redirect()->back()->with('success', 'Students promoted successfully!');
    }
}
