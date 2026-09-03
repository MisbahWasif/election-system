<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    // Saari elections ki list, jahan se result dekhne ke liye select karenge
    public function index()
    {
        $elections = Election::all();
        return view('results.index', compact('elections'));
    }

    // Ek specific election ka result dikhana
    public function show(Election $election)
    {
        // Candidates ko unke votes count ke sath uthao, zyada se kam order mein
        $candidates = $election->candidates()
                                ->withCount('votes') // Har candidate ke sath 'votes_count' naam ka field add ho jata hai
                                ->orderByDesc('votes_count') // Sabse zyada votes wala upar
                                ->get();

        // Winner wo hai jiske sabse zyada votes hain (pehla candidate, kyun ke already sort kiya hai)
        $winner = $candidates->first();

        $totalVotes = $candidates->sum('votes_count'); // Sab candidates ke votes jama kar diye

        return view('results.show', compact('election', 'candidates', 'winner', 'totalVotes'));
    }
}