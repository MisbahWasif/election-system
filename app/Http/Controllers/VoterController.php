<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VoterController extends Controller
{
    public function showRegisterForm()
    {
        return view('voter.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cnic' => 'required|string|unique:voters,cnic',
            'reg_no' => 'required|string|unique:voters,reg_no',
            'email' => 'required|email|unique:voters,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Voter::create([
            'name' => $request->name,
            'cnic' => $request->cnic,
            'reg_no' => $request->reg_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'active', // Naya voter register hote hi active ho jata hai
        ]);

        return redirect()->route('voter.login')->with('success', 'Registration successful! Please login.');
    }

    public function showLoginForm()
    {
        return view('voter.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Pehle check karo voter hai bhi ya nahi, aur uska status "blocked" to nahi
        $voter = Voter::where('email', $request->email)->first();

        if ($voter && $voter->status === 'blocked') {
            return back()->withErrors(['email' => 'Your account has been blocked. Contact admin.']);
        }

        if (Auth::guard('voter')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('voter.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function dashboard()
    {
        return view('voter.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('voter')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('voter.login');
    }
}
