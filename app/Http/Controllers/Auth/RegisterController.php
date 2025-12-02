<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // afficher formulaire
    public function show()
    {
        return view('auth.register');
    }

    // traiter formulaire
    public function register(Request $request)
    {
       
        $request->validate([
    'name'     => ['required', 'string', 'max:255'],
    'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
    'password' => ['required', 'string', 'min:8', 'confirmed'],
]);

        // création user
        User::create([
    'name'     => $request->name,
    'email'    => $request->email,
    'password' => Hash::make($request->password),
    'role'     => 'patient', // هنا
]);


        return redirect('/login')->with('success', 'Compte créé avec succès !');
    }
}
