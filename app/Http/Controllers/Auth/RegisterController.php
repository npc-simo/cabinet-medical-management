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
        // نفس الفاليداسيون لي درتي فـ PHP
        $request->validate([
            'name'                  => ['required', 'regex:/^[a-zA-Z ]+$/'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'password'              => ['required', 'min:8', 'confirmed'], // password_confirmation
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
