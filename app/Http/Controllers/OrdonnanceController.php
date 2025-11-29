<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrdonnanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $ordonnances = Ordonnance::where('patient_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // الملف الصحيح عندك هو: resources/views/patient/ordonnances.blade.php
        return view('patient.ordonnances', compact('ordonnances', 'user'));
    }

    public function download($id)
    {
        $ordonnance = Ordonnance::where('id', $id)
            ->where('patient_id', Auth::id())
            ->firstOrFail();

        if (!$ordonnance->fichier || !Storage::exists($ordonnance->fichier)) {
            return back()->with('error', 'Fichier introuvable.');
        }

        return Storage::download($ordonnance->fichier);
    }
}
