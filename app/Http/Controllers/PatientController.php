<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;

class PatientController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();      // المستخدم اللي داخل
        $patient = $user?->patient; // relation hasOne (ممكن تكون null دابا)

        return view('patient.dashboard', compact('user', 'patient'));
    }
}
