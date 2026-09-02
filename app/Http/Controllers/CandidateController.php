<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CandidateController extends Controller
{
    // Saare candidates ki list
    public function index()
    {
        $candidates = Candidate::with('election')->get(); // 'with' se election ka data bhi sath mein utha lete hain (1 hi query mein)
        return view('admin.candidates.index', compact('candidates'));
    }

    // Naya candidate add karne ka form
    public function create()
    {
        $elections = Election::all(); // Dropdown mein dikhane ke liye saari elections chahiye
        return view('admin.candidates.create', compact('elections'));
    }

    // Form submit hone par candidate save karna
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'password' => 'required|min:6',
            'party' => 'required|string|max:255',
            'symbol' => 'nullable|string',
            'election_id' => 'required|exists:elections,id', // exists: election_id, elections table mein wakai mojood hona chahiye
        ]);

        Candidate::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'party' => $request->party,
            'symbol' => $request->symbol,
            'election_id' => $request->election_id,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Candidate added successfully!');
    }

    // Edit form dikhana
    public function edit(Candidate $candidate)
    {
        $elections = Election::all();
        return view('admin.candidates.edit', compact('candidate', 'elections'));
    }

    // Edit form submit hona
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,' . $candidate->id, // apna khud ka email ignore karo unique check mein
            'party' => 'required|string|max:255',
            'symbol' => 'nullable|string',
            'election_id' => 'required|exists:elections,id',
        ]);

        $candidate->update([
            'name' => $request->name,
            'email' => $request->email,
            'party' => $request->party,
            'symbol' => $request->symbol,
            'election_id' => $request->election_id,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Candidate updated!');
    }

    // Delete karna
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted!');
    }
}