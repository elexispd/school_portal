<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;

use Illuminate\Http\Request;

class SchoolClassController extends Controller
{

    public function index()
    {
        // Logic to list all school classes
        $classes = SchoolClass::all();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        // Logic to show form for creating a new school class
        return view('classes.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new school class
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:school_classes,code',
            'category' => 'required|in:junior,senior',
        ]);
        $validated['name'] = trim($validated['name']);
        $validated['code'] = trim($validated['code']);
        SchoolClass::create($request->all());
        return redirect()->route('classes.create')->with('success', 'Class created successfully.');
    }

    public function edit($id)
    {
        // Logic to show form for editing a specific school class
        $class = SchoolClass::findOrFail($id);
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific school class
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:school_classes,code',
            'category' => 'required|in:junior,senior',
        ]);
        $class = SchoolClass::findOrFail($id);
        $class->update($request->all());
        return redirect()->route('classes.edit', $id)->with('success', 'School class updated successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $class = SchoolClass::findOrFail($id);

        // Toggle between active and inactive
        $newStatus = $class->status === 'active' ? 'inactive' : 'active';

        $class->update(['status' => $newStatus]);

        return redirect()->route('classes.index')
                    ->with('success', "School class status updated to {$newStatus} successfully.");
    }

    public function destroy($id)
    {
        // Logic to delete a specific school class
    }
}
