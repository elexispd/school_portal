<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\Resumption;

class ResumptionController extends Controller
{
    public function index()
    {
        return view('resumptions.index');
    }

    public function create()
    {
        $sessions = Session::where('status', 'active')->get();
        return view('resumptions.create', compact('sessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'session_id' => 'required|exists:sessions,id',
            'term' => 'required|in:1,2,3',
        ]);

        // Update if exists, otherwise insert
        Resumption::updateOrCreate(
            [
                'session_id' => $request->session_id,
                'term' => $request->term,
            ],
            [
                'date' => $request->date,
            ]
        );

        return redirect()->route('resumptions.create')
            ->with('success', 'Resumption saved successfully.');
    }


}
