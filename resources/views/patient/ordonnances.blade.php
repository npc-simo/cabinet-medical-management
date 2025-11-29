<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes ordonnances</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <style>
        body{ background:#f5f7fa;font-family:'Poppins';margin:0; }
        header{ background:#1565c0;padding:20px;color:white; }
        .container{ max-width:1100px;margin:40px auto;padding:0 20px; }
        .ord-card{
            background:white;padding:25px;border-radius:15px;
            box-shadow:0 4px 15px rgba(0,0,0,.1);margin-bottom:20px;
        }
        .title{ font-size:20px;color:#1565c0;margin-bottom:10px; }
        .btn{ background:#1e88e5;color:white;padding:10px 15px;
              border-radius:8px;text-decoration:none;font-weight:600 }
    </style>
</head>
<body>

<header>
    <h2><i class="ri-capsule-line"></i> Mes ordonnances</h2>
</header>

<div class="container">

    @foreach($ordonnances as $ord)
    <div class="ord-card">
        <div class="title"><i class="ri-file-list-3-line"></i> Ordonnance du {{ $ord->date }}</div>

        <strong>Diagnostic :</strong> {{ $ord->diagnostic }} <br><br>

        <strong>Médicaments :</strong>
        <ul>
            @foreach($ord->medicaments as $med)
            <li>{{ $med->nom }} — {{ $med->dose }} — {{ $med->frequence }}</li>
            @endforeach
        </ul>

        <br>
        <a class="btn" href="{{ route('patient.ordonnances.download', $ord->id) }}">
            Télécharger PDF
        </a>
    </div>
    @endforeach

</div>

</body>
</html>
