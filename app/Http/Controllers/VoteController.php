<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    // Active elections ki list dikhana, jisme voter vote de sake
    public function index()
    {
        $elections = Election::where('status', 'active')->get();
        return view('vote.index', compact('elections'));
    }

    // Ek specific election ke candidates dikhana, jahan se vote diya jayega
    public function showCandidates(Election $election)
    {
        $voterId = Auth::guard('voter')->id();

        // Check karo yeh voter is election mein pehle hi vote de chuka hai kya
        $alreadyVoted = Vote::where('voter_id', $voterId)
                             ->where('election_id', $election->id)
                             ->exists();

        if ($alreadyVoted) {
            return redirect()->route('vote.index')->with('error', 'You have already voted in this election.');
        }

        // Election ka status bhi check karo
        if ($election->status !== 'active') {
            return redirect()->route('vote.index')->with('error', 'This election is not active.');
        }

        $candidates = $election->candidates; // Relationship se seedha candidates nikal liye
        return view('vote.candidates', compact('election', 'candidates'));
    }

    // Vote cast karna
    public function castVote(Request $request, Election $election)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $voterId = Auth::guard('voter')->id();

        // Server-side dobara check karo (security ke liye — kabhi user URL manipulate kar ke dobara try kar sakta hai)
        $alreadyVoted = Vote::where('voter_id', $voterId)
                             ->where('election_id', $election->id)
                             ->exists();

        if ($alreadyVoted) {
            return redirect()->route('vote.index')->with('error', 'You have already voted in this election.');
        }

        if ($election->status !== 'active') {
            return redirect()->route('vote.index')->with('error', 'This election is not active.');
        }

        Vote::create([
            'voter_id' => $voterId,
            'candidate_id' => $request->candidate_id,
            'election_id' => $election->id,
            'confirm' => true,
        ]);

        return redirect()->route('vote.index')->with('success', 'Your vote has been cast successfully!');
    }
}