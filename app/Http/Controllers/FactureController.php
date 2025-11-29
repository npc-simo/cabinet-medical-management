<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FactureController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $factures = Facture::where('patient_id', $user->id)
            ->orderBy('date_facture', 'desc')
            ->get();

        // الملف الصحيح عندك هو: resources/views/patient/factures.blade.php
        return view('patient.factures', compact('factures', 'user'));
    }

    public function download($id)
    {
        $facture = Facture::where('id', $id)
            ->where('patient_id', Auth::id())
            ->firstOrFail();

        if (!$facture->fichier || !Storage::exists($facture->fichier)) {
            return back()->with('error', 'Fichier introuvable.');
        }

        return Storage::download($facture->fichier);
    }
}
