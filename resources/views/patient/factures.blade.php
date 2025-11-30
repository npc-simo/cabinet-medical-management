<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes factures</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <style>
        body{ background:#f5f7fa;font-family:'Poppins';margin:0; }
        header{ background:#1e88e5;padding:20px;color:white; }
        .container{ max-width:1100px;margin:40px auto;padding:0 20px; }
        table{
            width:100%;background:white;border-collapse:collapse;
            box-shadow:0 4px 15px rgba(0,0,0,.1);
        }
        th,td{ padding:15px;border-bottom:1px solid #e5e7eb;text-align:left; }
        th{ background:#f1f5f9;color:#1565c0 }
        .btn{
            background:#1565c0;color:white;padding:8px 15px;
            border-radius:8px;text-decoration:none;font-weight:600
        }
    </style>
</head>
<body>
@include('partials.dashboard_back')
<header>
    <h2><i class="ri-receipt-line"></i> Mes factures</h2>
</header>

<div class="container">

    <table>
        <tr>
            <th>N° Facture</th>
            <th>Date</th>
            <th>Consultation</th>
            <th>Montant</th>
            <th>Statut</th>
            <th>Télécharger</th>
        </tr>

        @foreach($factures as $fact)
        <tr>
            <td>{{ $fact->numero }}</td>
            <td>{{ $fact->date }}</td>
            <td>{{ $fact->type }}</td>
            <td>{{ $fact->montant }} MAD</td>
            <td>{{ $fact->statut }}</td>
            <td>
                <a class="btn" href="{{ route('patient.factures.download', $fact->id) }}">
                    PDF
                </a>
            </td>
        </tr>
        @endforeach
    </table>

</div>

</body>
</html>
