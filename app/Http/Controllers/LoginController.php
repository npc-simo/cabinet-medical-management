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
        // Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Credentials
        $credentials = $request->only('email', 'password');

        // Attempt login
        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();

            // Redirect selon role
            if ($user->role === 'medecin') {
                return redirect()->route('medecin.dashboard');
            }

            if ($user->role === 'secretaire') {
                return redirect()->route('secretaire.dashboard');
            }

            // Par défaut
            return redirect()->route('patient.dashboard');
        }

        // Login failed
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
