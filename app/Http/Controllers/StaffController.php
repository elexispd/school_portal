<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
       $staffMembers = User::where('role', '!=', 'student')->get();
        return view('staff.index', compact('staffMembers'));
    }

    public function create()
    {
        // Logic to show form for creating a new staff member
        return view('staff.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new staff member
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:super_admin,admin,staff',
        ]);

        $validated['password'] = bcrypt('password1234');
        User::create($validated);

        return redirect()->route('staff.create')->with('success', 'Staff member created successfully.');
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ]
        ]);

        $validated['name'] = trim($validated['name']);

        $staff->update($validated);

        return redirect()
            ->route('staff.edit', $id)
            ->with('success', 'Staff name updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $staff = User::findOrFail($id);
        // Toggle between active and inactive
        $newStatus = $staff->status === 'active' ? 'inactive' : 'active';
        $staff->update(['status' => $newStatus]);
        return redirect()->route('staff.index')
                    ->with('success', "Staff status updated to {$newStatus} successfully.");
    }






















}
