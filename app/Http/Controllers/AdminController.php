<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Register form dikhane ke liye (GET request)
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // Register form submit hone par ye chalega (POST request)
    public function register(Request $request)
    {
        // Validation: sab fields sahi format mein hain ya nahi check karta hai
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email', // email admins table mein already exist na ho
            'password' => 'required|min:6|confirmed', // 'confirmed' matlab password_confirmation field bhi match karni chahiye
            'phone' => 'nullable|string',
            'cnic' => 'nullable|string|unique:admins,cnic',
        ]);

        // Naya admin database mein create karo
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Plain password ko hash (encrypt) kar rahe hain
            'phone' => $request->phone,
            'cnic' => $request->cnic,
            'role' => 'admin',
        ]);

        // Register hone ke baad login page par bhej do, success message ke sath
        return redirect()->route('admin.login')->with('success', 'Registration successful! Please login.');
    }

    // Login form dikhane ke liye (GET request)
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Login form submit hone par ye chalega (POST request)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 'admin' guard use karke check karo email/password sahi hain ya nahi
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // Sahi hain to session regenerate karo (security best practice, session hijacking se bachata hai)
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Galat hain to wapis login page par error ke sath
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    // Dashboard dikhane ke liye (login ke baad)
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Logout logic
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Admin ko logout karo
        $request->session()->invalidate(); // Purani session khatam karo
        $request->session()->regenerateToken(); // CSRF token naya banao (security)

        return redirect()->route('admin.dashboard')->with('success', 'New admin added successfully!');
    }
}