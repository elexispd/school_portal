<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Session;
use App\Models\Subject;
use App\Models\Result;

class ResultController extends Controller
{
    public function showUploadForm()
    {
        $classes = SchoolClass::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $sessions = Session::where('status', 'active')->get();
        return view('results.upload', compact('classes', 'subjects', 'sessions'));
    }

    public function fetchStudents(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'class_arm_id'    => 'required|exists:class_arms,id',
        ]);

        $students = Student::where('school_class_id', $request->school_class_id)
            ->where('class_arm', $request->class_arm_id)
            ->get();

        // Get the results for each student
        foreach ($students as $student) {
            $result = Result::where('student_id', $student->id)
                ->where('school_class_id', $request->school_class_id)
                ->where('class_arm_id', $request->class_arm_id)
                ->where('subject_id', $request->subject_id)
                ->where('term', $request->term)
                ->first();

            // Attach the result to the student object
            $student->result = $result;
        }


        return view('layouts.partials.fetchResult', [
            'students' => $students
        ]);
    }

    public function store(Request $request)
    {
        // Get all students and their scores from the request
        $studentsScores = $request->students;

        // Get the existing results in a batch query (all results for the provided term, subject, class, and arm)
        $existingResults = Result::whereIn('student_id', array_keys($studentsScores))  // Fetch results only for the students being processed
            ->where('subject_id', $request->subject_id)
            ->where('term', $request->term)
            ->where('school_class_id', $request->school_class_id)
            ->where('class_arm_id', $request->class_arm_id)
            ->pluck('student_id');

        // Prepare an array to store new results
        $newResults = [];

        // Loop through each student's data
        foreach ($studentsScores as $studentId => $scores) {
            // Skip students who already have results
            if (in_array($studentId, $existingResults->toArray())) {
                continue;
            }

            // Calculate the total score
            $total = ($scores['ca'] ?? 0) + ($scores['ca2'] ?? 0) + ($scores['ca3'] ?? 0) + ($scores['ca4'] ?? 0) + ($scores['exam'] ?? 0);

            // Prepare new result data
            $newResults[] = [
                'student_id' => $studentId,
                'subject_id' => $request->subject_id,
                'term' => $request->term,
                'school_class_id' => $request->school_class_id,
                'class_arm_id' => $request->class_arm_id,
                'ca' => $scores['ca'] ?? null,
                'ca2' => $scores['ca2'] ?? null,
                'ca3' => $scores['ca3'] ?? null,
                'ca4' => $scores['ca4'] ?? null,
                'exam' => $scores['exam'] ?? null,
                'total' => $total,
                'grade' => $this->calculateGrade($total),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all new results in one go
        if (!empty($newResults)) {
            Result::insert($newResults);
        }

        // Update class statistics after processing all the results
        $this->updateClassStatistics($request);

        return redirect()->route('results.upload')->with('success', 'Results uploaded successfully!');
    }

    public function show(Request $request)
    {
        $classes = SchoolClass::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $sessions = Session::where('status', 'active')->get();
        return view('results.show', compact('classes', 'subjects', 'sessions'));
    }

    public function fetchSubjects(Request $request)
    {

        // Validate incoming request data
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'class_arm_id'    => 'required|exists:class_arms,id',
            'subject_id'      => 'required|exists:subjects,id',
        ]);

        // Fetch results for the specific subject, class, and arm
        $results = Result::where('subject_id', $request->subject_id)
            ->where('school_class_id', $request->school_class_id)
            ->where('class_arm_id', $request->class_arm_id)
            ->get();

        // Add student data to each result object
        foreach ($results as $result) {
            $result->student = $result->student;
        }

        return view('layouts.partials.subjectResult', [
            'results' => $results,
        ]);
    }

    public function edit(Result $result)
    {
        return view('results.edit', compact('result'));
    }

    // Update result
    public function update(Request $request, Result $result)
    {
        // Validate input data
        $request->validate([
            'ca' => 'nullable|numeric',
            'exam' => 'nullable|numeric',
        ]);

        // Update the result
        $result->update([
            'ca' => $request->ca,
            'exam' => $request->exam,
            'total' => ($request->ca + $request->exam),
            'subject_id' => $request->subject_id,
            'term' => $request->term,
            'school_class_id' => $request->school_class_id,
            'class_arm_id' => $request->class_arm_id,
        ]);

        $this->updateClassStatistics($request);

        return redirect()->route('results.edit',  $result->subject_id)
            ->with('success', 'Result updated successfully!');
    }

    // Delete result

    public function destroy($id, Request $request)
    {
        // Find the result by ID
        $result = Result::findOrFail($id);

        // Store class and arm info for statistics update
        $schoolClassId = $result->school_class_id;
        $classArmId = $result->class_arm_id;
        $subjectId = $result->subject_id;
        $term = $result->term;

        // Delete the result
        $result->delete();

        // Recalculate the class statistics after deletion
        $this->updateClassStatistics(new Request([
            'school_class_id' => $schoolClassId,
            'class_arm_id' => $classArmId,
            'subject_id' => $subjectId,
            'term' => $term
        ]));

        // Respond with a success message or any relevant data
        return response()->json(['success' => 'Result deleted successfully']);
    }

    public function mastersheet()
    {
        $classes = SchoolClass::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $sessions = Session::where('status', 'active')->get();
        return view('results.mastersheet', compact('classes', 'subjects', 'sessions'));
    }

    public function getMasterSheet(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'session_id' => 'required|exists:sessions,id',
        'school_class_id' => 'required|exists:school_classes,id',
        'class_arm_id'    => 'required|exists:class_arms,id',
        'term'             => 'required|integer',
    ]);

    // Get all subjects for the given class and arm
    $subjects = Subject::all();

    // Initialize an array to hold results for each subject
    $subjectResults = [];

    // Loop through each subject to fetch results and calculate aggregates
    foreach ($subjects as $subject) {
        // Get results for the subject in the given class, arm, and term
        $results = Result::where('school_class_id', $request->school_class_id)
                        ->where('class_arm_id', $request->class_arm_id)
                        ->where('subject_id', $subject->id)
                        ->where('term', $request->term)
                        ->with('student')  // Eager load the student information
                        ->get();

        // Calculate aggregates for the subject
        if ($results->count() > 0) {
            $totalScores = $results->pluck('total');

            // Calculate the highest, lowest, and average score
            $highestScore = $totalScores->max();
            $lowestScore = $totalScores->min();
            $avgScore = $totalScores->avg();

            // Add to the subject's data
            $subjectResults[] = [
                'subject' => $subject,
                'results' => $results,
                'highest_score' => $highestScore,
                'lowest_score' => $lowestScore,
                'avg_score' => $avgScore,
            ];
        }
    }

    // Get all students in the class with their total score
    $students = Student::where('school_class_id', $request->school_class_id)
                        ->where('class_arm', $request->class_arm_id)
                        ->with(['results' => function ($query) use ($request) {
                            $query->where('term', $request->term);
                                //   ->where('session_id', $request->session_id);
                        }])
                        ->get();

    // Prepare total score and position for each student
    foreach ($students as $student) {
        $totalScore = $student->results->sum('total');
        $student->total_score = $totalScore;
    }

    // Sort the students by their total score to calculate positions
    $sortedStudents = $students->sortByDesc('total_score');
    foreach ($sortedStudents as $index => $student) {
        $student->position = $index + 1;
    }

    return view('layouts.partials.mastersheet', [
        'subjectResults' => $subjectResults,
        'students' => $sortedStudents,
    ]);
}




























    /**
     * Calculate the grade based on the total score
     * This is an example, adjust as per your grading scale
     */
    private function calculateGrade($total)
    {
        if ($total >= 80) return 'A';
        if ($total >= 70) return 'B';
        if ($total >= 60) return 'C';
        if ($total >= 50) return 'D';
        return 'F';
    }

    /**
     * Update class statistics after all results have been processed
     */
    private function updateClassStatistics(Request $request)
    {
        // Get all results for the given class, arm, subject, and term
        $results = Result::where('school_class_id', $request->school_class_id)
                        ->where('class_arm_id', $request->class_arm_id)
                        ->where('subject_id', $request->subject_id)
                        ->where('term', $request->term)
                        ->get();

        $totalScores = $results->pluck('total');

        // Calculate class statistics
        $lowestScore = $totalScores->min();
        $highestScore = $totalScores->max();
        $avgScore = $totalScores->avg();

        // Update each result with the statistics
        foreach ($results as $index => $result) {
            $result->update([
                'class_lowest_score' => $lowestScore,
                'class_highest_score' => $highestScore,
                'subject_avg_score' => $avgScore,
                'position' => $index + 1,  // Assuming results are ordered by total score
            ]);
        }
    }


}
