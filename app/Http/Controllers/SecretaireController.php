<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretaireController extends Controller
{
    public function dashboard()
    {
        return view('secretaire.dashboard');
    }
}
