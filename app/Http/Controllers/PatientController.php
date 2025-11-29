<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Rendezvous;
use App\Models\DossierMedical;
use App\Models\Facture;

class PatientController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $patient = $user?->patient;

        // Initialize counts
        $rendezvousCount = 0;
        $upcomingCount = 0;
        $facturesCount = 0;
        $dossiersCount = 0;

        // Calculate statistics if patient exists
        if ($patient) {
            $rendezvousCount = Rendezvous::where('id_patient', $patient->id_patient)->count();
            
            $upcomingCount = Rendezvous::where('id_patient', $patient->id_patient)
                ->where('date_rv', '>=', today())
                ->where('statut', '!=', 'Annulé')
                ->count();
        }

        // Count factures and dossiers for the user
        $facturesCount = Facture::where('patient_id', $user->id)->count();
        $dossiersCount = DossierMedical::where('patient_id', $user->id)->count();

        return view('patient.dashboard', compact(
            'user',
            'patient',
            'rendezvousCount',
            'upcomingCount',
            'facturesCount',
            'dossiersCount'
        ));
    }
}