<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // صفحة login
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // Add this for security
        
        $user = Auth::user();

        // Redirect based on role
        return match($user->role) {
            'medecin' => redirect()->route('medecin.dashboard'),
            'secretaire' => redirect()->route('secretaire.dashboard'),
            default => redirect()->route('patient.dashboard'),
        };
    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect.'
    ])->onlyInput('email');
}

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
