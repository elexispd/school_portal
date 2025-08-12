<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display sessions
        $sessions = Session::all();
        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        // Logic to show form for creating a new session
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new session
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sessions,name',
            'code' => 'required|string|max:10|unique:sessions,code',
        ]);

        Session::create($validated);

        return redirect()->route('sessions.create')->with('success', 'Session created successfully.');
    }

    public function edit($id)
    {
        // Logic to show form for editing a specific school class
        $session = Session::findOrFail($id);
        return view('sessions.edit', compact('session'));
    }
    public function update(Request $request, $id)
    {
        // Logic to update a specific school class
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $session = Session::findOrFail($id);
        $session->update($request->all());
        return redirect()->route('sessions.edit', $id)->with('success', 'Session updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $session = Session::findOrFail($id);

        // Toggle between active and inactive
        $newStatus = $session->status === 'active' ? 'inactive' : 'active';

        $session->update(['status' => $newStatus]);

        return redirect()->route('sessions.index')
                    ->with('success', "Session status updated to {$newStatus} successfully.");
    }







}
