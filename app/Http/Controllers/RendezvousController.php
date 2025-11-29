<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rendezvous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezvousController extends Controller
{
    // ====== LISTE DES RENDEZ-VOUS DU PATIENT CONNECTÉ ======
    public function index()
    {
        $user = Auth::user();

        // patient lié à ce compte
        $patient = Patient::where('user_id', $user->id)->first();

        $rendezvous = collect();   // collection vide par défaut

        if ($patient) {
            $rendezvous = Rendezvous::where('id_patient', $patient->id_patient)
                ->orderBy('date_rv', 'desc')
                ->orderBy('heure_rv', 'desc')
                ->get();
        }

        return view('patient.rendezvous_index', [
            'user'       => $user,
            'patient'    => $patient,
            'rendezvous' => $rendezvous,
        ]);
    }

    // ====== FORMULAIRE PRISE DE RDV ======
    public function create()
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->first();

        return view('patient.rendezvous_create', [
            'user'    => $user,
            'patient' => $patient,
        ]);
    }

    // ====== ENREGISTRER LE RDV ======
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'             => 'required|string|max:100',
            'prenom'          => 'required|string|max:100',
            'date_naissance'  => 'nullable|date',
            'sexe'            => 'nullable|in:M,F',
            'telephone'       => 'nullable|string|max:20',
            'cin'             => 'nullable|string|max:20',
            'adresse'         => 'nullable|string',
            'date_rv'         => 'required|date',
            'heure_rv'        => 'required',
            'motif'           => 'required|string',
        ]);

        $user = Auth::user();

        // on crée / récupère le patient lié à ce user
        $patient = Patient::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nom'            => $data['nom'],
                'prenom'         => $data['prenom'],
                'date_naissance' => $data['date_naissance'] ?? null,
                'sexe'           => $data['sexe'] ?? null,
                'telephone'      => $data['telephone'] ?? null,
                'adresse'        => $data['adresse'] ?? null,
                'cin'            => $data['cin'] ?? null,
            ]
        );

        Rendezvous::create([
            'id_patient' => $patient->id_patient,
            'date_rv'    => $data['date_rv'],
            'heure_rv'   => $data['heure_rv'],
            'motif'      => $data['motif'],
            'statut'     => 'En attente',
        ]);

        return redirect()
            ->route('patient.rendezvous.index')
            ->with('success', 'Votre rendez-vous a été enregistré avec succès.');
    }

    // ====== ANNULER UN RENDEZ-VOUS ======
    public function cancel($id)
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->firstOrFail();

        // نتأكد بلي هاد RDV ديال هاد الـ patient
        $rdv = Rendezvous::where('id', $id)
            ->where('id_patient', $patient->id_patient)
            ->firstOrFail();

        $rdv->statut = 'Annulé';
        $rdv->save();

        return redirect()
            ->route('patient.rendezvous.index')
            ->with('success', 'Le rendez-vous a été annulé avec succès.');
    }
}
