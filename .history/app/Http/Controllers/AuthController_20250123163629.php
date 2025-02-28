<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function dashboard()
    {
        // Fetch the count of users where role is not 'admin'
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Return the dashboard view with the total user count
        return view('dashboard', compact('totalUsers'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:pengguna,email',
            'password' => 'required|string|min:8|confirmed',
            'nomor_telepon' => 'nullable|string|max:15',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nomor_telepon' => $request->nomor_telepon,
            'role' => 'penumpang', // Default role
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
    }

    return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
}


    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

    public function layout()
{
    $user = Auth::user(); // Mendapatkan pengguna yang sedang login
    return view('layouts.app', compact('user')); // Kirim data pengguna ke view
}

}
