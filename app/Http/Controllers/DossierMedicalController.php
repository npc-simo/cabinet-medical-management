<?php

namespace App\Http\Controllers;

use App\Models\DossierMedical;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DossierMedicalController extends Controller
{
    // عرض جميع الملفات الطبية الخاصة بالمريض
    public function index()
    {
        $user = Auth::user();

        $dossiers = DossierMedical::where('patient_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // الملف الصحيح عندك هو: resources/views/patient/dossier.blade.php
        return view('patient.dossier', compact('dossiers', 'user'));
    }

    // تحميل الملف فقط (ما عندكش صفحة show)
    public function download($id)
    {
        $dossier = DossierMedical::where('id', $id)
            ->where('patient_id', Auth::id())
            ->firstOrFail();

        if (!$dossier->fichier || !Storage::exists($dossier->fichier)) {
            return back()->with('error', 'Fichier introuvable.');
        }

        return Storage::download($dossier->fichier);
    }
}
