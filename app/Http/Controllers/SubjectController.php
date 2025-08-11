<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $classes = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'code' => 'required|string|exists:school_classes,id',
        ]);


        $validated['name'] = trim($validated['name']);
        $validated['code'] = trim($validated['code']);

        Subject::create($validated);

        return redirect()
            ->route('subjects.create')
            ->with('success', 'Subject created successfully.');
    }


    public function edit($id)
    {
        $classarm = Subject::findOrFail($id);
        return view('subjects.edit', compact('subjects'));
    }

    public function update(Request $request, $id)
    {
        $classArm = Subject::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'code' => 'required|integer|exists:subjects,id',
        ]);

        $validated['name'] = trim($validated['name']);
        $validated['code'] = trim($validated['code']);

        $classArm->update($validated);

        return redirect()
            ->route('subjects.edit', $id)
            ->with('success', 'Subject updated successfully.');
    }



    public function updateStatus(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        // Toggle between active and inactive
        $newStatus = $subject->status === 'active' ? 'inactive' : 'active';
        $subject->update(['status' => $newStatus]);
        return redirect()->route('subjects.index')
                    ->with('success', "Subject status updated to {$newStatus} successfully.");
    }

    public function destroy($id)
    {
        // Logic to delete a specific school class
    }



}
