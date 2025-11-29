<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du rendez-vous</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body{font-family:'Poppins',sans-serif;background:#f5f7fa;margin:0;padding:40px;}
        .card{max-width:700px;margin:0 auto;background:#fff;border-radius:12px;padding:25px;
              box-shadow:0 4px 18px rgba(0,0,0,.08);}
        h1{margin-top:0;color:#1e88e5;}
        dt{font-weight:600;margin-top:10px;}
        a.btn{display:inline-block;margin-top:20px;padding:10px 18px;border-radius:8px;
              background:#1e88e5;color:#fff;text-decoration:none;font-weight:500;}
    </style>
</head>
<body>
<div class="card">
    <h1>Détail du rendez-vous</h1>

    <dl>
        <dt>Date</dt>
        <dd>{{ $rendezvous->date_rv }}</dd>

        <dt>Heure</dt>
        <dd>{{ $rendezvous->heure_rv }}</dd>

        <dt>Motif</dt>
        <dd>{{ $rendezvous->motif }}</dd>

        <dt>Statut</dt>
        <dd>{{ $rendezvous->statut }}</dd>

        <dt>Patient</dt>
        <dd>{{ $patient->nom }} {{ $patient->prenom }}</dd>
    </dl>

    <a href="{{ route('patient.rendezvous.index') }}" class="btn">Retour à mes rendez-vous</a>
</div>
</body>
</html>
