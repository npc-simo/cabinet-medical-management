<?php

namespace App\Http\Controllers;

use App\Models\DossierMedical;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DossierMedicalController extends Controller
{
    // عرض جميع الملفات الطبية الخاصة بالمريض
    public function index()
    {
        $user = Auth::user();

        // chercher le patient lié à cet utilisateur
        $patient = Patient::where('user_id', $user->id)->first();

        // tous les dossiers médicaux (documents) de ce patient
        $documents = DossierMedical::where('patient_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.dossier', compact(
            'user',
            'patient',
            'documents'
        ));
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
