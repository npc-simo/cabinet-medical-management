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
        $patient = Patient::where('user_id', $user->id)->first();
        $rendezvous = collect();

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
    // ====== ENREGISTRER LE RDV ======
public function store(Request $request)
{
    $data = $request->validate([
        'nom'             => 'required|string|max:100',
        'prenom'          => 'required|string|max:100',
        'date_naissance'  => 'nullable|date|before:today',
        'sexe'            => 'nullable|in:M,F',
        'telephone'       => 'nullable|string|max:20',
        'cin'             => 'nullable|string|max:20',
        'adresse'         => 'nullable|string',
        'date_rv'         => 'required|date|after_or_equal:today',
        'heure_rv'        => 'required|date_format:H:i',
        'motif'           => 'required|string|max:500',
    ]);

    $user = Auth::user();

    // 1) Créer ou récupérer le patient
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

    // 2) Vérifier si le créneau est déjà occupé
    $rdvExistant = Rendezvous::where('id_patient', $patient->id_patient)
        ->where('date_rv', $data['date_rv'])
        ->where('heure_rv', $data['heure_rv'])
        ->whereIn('statut', ['En attente', 'Confirmé'])
        ->first();

    if ($rdvExistant) {
        // branche "[Créneau occupé]" du diagramme
        return back()
            ->withInput()
            ->withErrors([
                'date_rv' => 'Ce créneau n’est pas disponible. Vous avez déjà un rendez-vous à cette date et heure.',
            ]);
    }

    // 3) Créer le rendez-vous (branche "[Créneau disponible]")
    Rendezvous::create([
        'id_patient' => $patient->id_patient,
        'date_rv'    => $data['date_rv'],
        'heure_rv'   => $data['heure_rv'],
        'motif'      => $data['motif'],
        'statut'     => 'En attente',
    ]);

    return redirect()
        ->route('patient.rendezvous.index')
        ->with('success', 'Votre rendez-vous a été enregistré avec succès et est en attente de validation.');
}


    // ====== AFFICHER UN RENDEZ-VOUS ======
    public function show($id)
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->firstOrFail();

        $rendezvous = Rendezvous::where('id_rv', $id)
            ->where('id_patient', $patient->id_patient)
            ->firstOrFail();

        return view('patient.rendezvous_show', compact('rendezvous', 'patient'));
    }

    // ====== ANNULER UN RENDEZ-VOUS ======
    public function cancel($id)
    {
        $user = Auth::user();
        $patient = Patient::where('user_id', $user->id)->firstOrFail();

        $rdv = Rendezvous::where('id_rv', $id)
            ->where('id_patient', $patient->id_patient)
            ->firstOrFail();

        // Ne pas annuler un RDV déjà annulé
        if ($rdv->statut === 'Annulé') {
            return redirect()
                ->route('patient.rendezvous.index')
                ->with('info', 'Ce rendez-vous est déjà annulé.');
        }

        $rdv->statut = 'Annulé';
        $rdv->save();

        return redirect()
            ->route('patient.rendezvous.index')
            ->with('success', 'Le rendez-vous a été annulé avec succès.');
    }
}