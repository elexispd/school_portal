<?php

namespace App\Http\Controllers;
use App\Models\ClassArm;
use App\Models\SchoolClass;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class ClassArmController extends Controller
{
    public function index()
    {
        // Logic to list all school classes
        $classes = SchoolClass::where('status', 'active')->get();
        return view('classarms.index', compact('classes'));
    }

    public function create()
    {
        // Logic to show form for creating a new school class
        $classes = SchoolClass::where('status', 'active')->get();
        return view('classarms.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('class_arms')->where(function ($query) use ($request) {
                    return $query->where('school_class_id', $request->school_class_id);
                })
            ],
            'school_class_id' => 'required|integer|exists:school_classes,id',
        ]);


        $validated['name'] = trim($validated['name']);

        ClassArm::create($validated);

        return redirect()
            ->route('classarms.create')
            ->with('success', 'Class arm created successfully.');
    }


    public function edit($id)
    {
        // Logic to show form for editing a specific school class
        $classarm = ClassArm::findOrFail($id);
        return view('classarms.edit', compact('classarm'));
    }

    public function update(Request $request, $id)
    {
        $classArm = ClassArm::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('class_arms')
                    ->where(function ($query) use ($request) {
                        return $query->where('school_class_id', $request->school_class_id);
                    })
                    ->ignore($id) // ignore current row when checking uniqueness
            ],
            'school_class_id' => 'required|integer|exists:school_classes,id',
        ]);

        $validated['name'] = trim($validated['name']);

        $classArm->update($validated);

        return redirect()
            ->route('classarms.edit', $id)
            ->with('success', 'Class arm updated successfully.');
    }



    public function updateStatus(Request $request, $id)
    {
        $classarm = ClassArm::findOrFail($id);

        // Toggle between active and inactive
        $newStatus = $classarm->status === 'active' ? 'inactive' : 'active';
        $classarm->update(['status' => $newStatus]);
        return redirect()->route('classarms.index')
                    ->with('success', "Class arm status updated to {$newStatus} successfully.");
    }

    public function destroy($id)
    {
        // Logic to delete a specific school class
    }

    public function getByClass($classId)
    {
        $classArms = ClassArm::where('school_class_id', $classId)
            ->orderBy('name')
            ->get(); // include status

        return response()->json($classArms);
    }














}
