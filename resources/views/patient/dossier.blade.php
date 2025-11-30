<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon dossier médical</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family:'Poppins',sans-serif; background:#f5f7fa; margin:0; }
        header{
            background:linear-gradient(135deg,#1e88e5 0%,#1565c0 100%);
            padding:20px;color:white;box-shadow:0 4px 15px rgba(0,0,0,.15)
        }
        .container{ max-width:1100px;margin:40px auto;padding:0 20px; }
        .title{
            background:white;padding:25px;border-radius:15px;
            display:flex;justify-content:space-between;align-items:center;
            box-shadow:0 4px 15px rgba(0,0,0,.08)
        }
        .section{
            background:white;margin-top:20px;padding:25px;
            border-radius:15px;box-shadow:0 4px 15px rgba(0,0,0,.08)
        }
        .row{ margin-bottom:12px; }
        .row strong{ color:#1565c0; }
        .docs-grid{
            display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
            gap:20px;margin-top:20px;
        }
        .doc-item{
            background:#e3f2fd;padding:18px;border-radius:10px;
            display:flex;justify-content:space-between;align-items:center;
        }
        .btn{
            background:#1e88e5;color:white;padding:8px 16px;
            text-decoration:none;border-radius:8px;font-weight:600;
        }
    </style>
</head>
<body>
@include('partials.dashboard_back')
<header>
    <h2><i class="ri-folder-user-line"></i> Mon dossier médical</h2>
</header>

<div class="container">

    <div class="title">
        <h2><i class="ri-user-heart-line"></i> Informations du patient</h2>
    </div>

    <div class="section">

        <div class="row"><strong>Nom :</strong> {{ $patient->nom }}</div>
        <div class="row"><strong>Prénom :</strong> {{ $patient->prenom }}</div>
        <div class="row"><strong>CIN :</strong> {{ $patient->cin }}</div>
        <div class="row"><strong>Adresse :</strong> {{ $patient->adresse }}</div>
        <div class="row"><strong>Téléphone :</strong> {{ $patient->telephone }}</div>
        <div class="row"><strong>Email :</strong> {{ $patient->email }}</div>
        <div class="row"><strong>Date de naissance :</strong> {{ $patient->date_naissance }}</div>

    </div>

    <div class="title" style="margin-top:40px;">
        <h2><i class="ri-stethoscope-line"></i> Informations médicales</h2>
    </div>

    <div class="section">
        <div class="row"><strong>Groupe sanguin :</strong> {{ $patient->groupe_sanguin }}</div>
        <div class="row"><strong>Allergies :</strong> {{ $patient->allergies }}</div>
        <div class="row"><strong>Antécédents :</strong> {{ $patient->antecedents }}</div>
        <div class="row"><strong>Notes du médecin :</strong> {{ $patient->notes_medicales }}</div>
    </div>

    <div class="title" style="margin-top:40px;">
        <h2><i class="ri-file-list-3-line"></i> Documents médicaux</h2>
    </div>

    <div class="section">

        <div class="docs-grid">
            @foreach($documents as $doc)
            <div class="doc-item">
                <span><i class="ri-file-line"></i> {{ $doc->nom }}</span>
                <a class="btn" href="{{ route('dossier.download', $doc->id) }}">Télécharger</a>
            </div>
            @endforeach
        </div>

    </div>

</div>

</body>
</html>
