<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Rendezvous;

class SecretaireController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Statistiques globales
        $totalPatients   = Patient::count();
        $totalRendezvous = Rendezvous::count();
        $today           = now()->toDateString();

        // Rendez-vous du jour
        $todayRendezvous = Rendezvous::with('patient')
            ->whereDate('date_rv', $today)
            ->orderBy('heure_rv')
            ->get();

        // Rendez-vous en attente (si le statut est "en_attente")
        $pendingRendezvousCount = Rendezvous::where('statut', 'en_attente')->count();

        return view('secretaire.dashboard', compact(
            'user',
            'totalPatients',
            'totalRendezvous',
            'todayRendezvous',
            'pendingRendezvousCount'
        ));
    }
}
