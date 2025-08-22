<?php

namespace App\Http\Controllers;

use App\Models\Vacation;
use App\Models\Session;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    public function create()
    {
        $sessions = Session::where('status', 'active')->get();
        return view('vacations.create', compact('sessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'session_id' => 'required|exists:sessions,id',
            'term' => 'required|in:1,2,3',
        ]);

        // Update if exists, otherwise insert
        Vacation::updateOrCreate(
            [
                'session_id' => $request->session_id,
                'term' => $request->term,
            ],
            [
                'date' => $request->date,
            ]
        );

        return redirect()->route('vacations.create')
            ->with('success', 'Vacation saved successfully.');
    }
}
