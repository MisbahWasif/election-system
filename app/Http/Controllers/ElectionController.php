<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        return view('elections.index', compact('elections'));
    }

    public function create()
    {
        return view('elections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Election::create([
            'title' => $request->title,
            'status' => 'upcoming',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('elections.index')->with('success', 'Election created successfully!');
    }

    public function updateStatus(Request $request, Election $election)
    {
        $request->validate([
            'status' => 'required|in:upcoming,active,ended',
        ]);

        $election->status = $request->status;
        $election->save();

        return redirect()->route('elections.index')->with('success', 'Status updated!');
    }

    public function destroy(Election $election)
    {
        $election->delete();
        return redirect()->route('elections.index')->with('success', 'Election deleted!');
    }
}