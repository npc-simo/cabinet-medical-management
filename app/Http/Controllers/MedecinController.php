<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Rendezvous;
use App\Models\DossierMedical;
use App\Models\Ordonnance;

class MedecinController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Statistiques globales
        $totalPatients        = Patient::count();
        $totalRendezvous      = Rendezvous::count();
        $today                = now()->toDateString();
        $todayRendezvousCount = Rendezvous::whereDate('date_rv', $today)->count();

        // Prochains rendez-vous (les 5 plus proches)
        $upcomingRendezvous = Rendezvous::with('patient')
            ->whereDate('date_rv', '>=', $today)
            ->orderBy('date_rv')
            ->orderBy('heure_rv')
            ->limit(5)
            ->get();

        // Dossiers & ordonnances
        $dossiersCount     = DossierMedical::count();
        $ordonnancesCount  = Ordonnance::count();

        return view('medecin.dashboard', compact(
            'user',
            'totalPatients',
            'totalRendezvous',
            'todayRendezvousCount',
            'upcomingRendezvous',
            'dossiersCount',
            'ordonnancesCount'
        ));
    }
}
