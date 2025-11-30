<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Rendez-vous – Cabinet Médical</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body{
            font-family:'Poppins',sans-serif;
            background:linear-gradient(135deg,#f5f7fa 0%,#e8f1f8 100%);
            min-height:100vh;
        }
        header{
            background:linear-gradient(135deg,#1e88e5 0%,#1565c0 100%);
            padding:20px 40px;color:white;
            box-shadow:0 4px 15px rgba(0,0,0,0.15);
        }
        .header-content{max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px}
        .header-left h2{font-size:24px;margin-bottom:8px;font-weight:600;display:flex;align-items:center;gap:10px}
        .header-left p{opacity:.95}
        .header-right{display:flex;gap:15px;align-items:center}
        .user-info{display:flex;align-items:center;gap:12px;background:rgba(255,255,255,0.15);padding:10px 18px;border-radius:10px}
        .user-info i{font-size:24px}
        .btn-header{
            background:white;color:#1e88e5;padding:10px 20px;text-decoration:none;font-weight:600;border-radius:8px;border:2px solid white;
        }
        .container{max-width:1200px;margin:40px auto;padding:0 20px}

        .page-header{
            background:white;padding:30px;border-radius:15px;margin-bottom:30px;
            display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:20px;
            box-shadow:0 4px 20px rgba(0,0,0,0.08)
        }
        .btn-nouveau{
            background:linear-gradient(135deg,#1e88e5,#1565c0);
            color:white;padding:14px 28px;text-decoration:none;
            border-radius:10px;font-weight:600;display:flex;align-items:center;gap:10px;
        }

        .rdv-grid{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(350px,1fr));
            gap:25px;
        }

        .rdv-card{
            background:white;padding:25px;border-radius:15px;
            box-shadow:0 4px 20px rgba(0,0,0,0.08);border-left:5px solid #1e88e5;
            position:relative;
        }
        .rdv-card.confirme{border-left-color:#10b981}
        .rdv-card.en-attente{border-left-color:#f59e0b}
        .rdv-card.annule{border-left-color:#ef4444;opacity:.85}

        .status-badge{
            position:absolute;top:20px;right:20px;padding:6px 14px;border-radius:20px;font-size:12px;font-weight:600;text-transform:uppercase;
        }
        .status-badge.confirme{background:#d1fae5;color:#065f46}
        .status-badge.en-attente{background:#fef3c7;color:#92400e}
        .status-badge.annule{background:#fee2e2;color:#991b1b}

        .rdv-header{display:flex;align-items:center;gap:15px;margin-bottom:20px;padding-bottom:15px;border-bottom:2px solid #f1f5f9}
        .rdv-icon{width:50px;height:50px;background:linear-gradient(135deg,#e3f2fd,#bbdefb);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#1e88e5;font-size:24px}

        .info-row{display:flex;align-items:start;gap:10px;margin-bottom:12px;color:#475569;font-size:14px}
        .info-row i{color:#1e88e5;font-size:18px}

        .rdv-actions{display:flex;gap:10px;padding-top:15px;border-top:2px solid #f1f5f9}
        .btn-action{flex:1;padding:10px;border:none;border-radius:8px;font-weight:600;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px}
        .btn-details{background:#e3f2fd;color:#1e88e5}
        .btn-annuler{background:#fee2e2;color:#dc2626}
    </style>
</head>
<body>
@include('partials.dashboard_back')
@php
    use Carbon\Carbon;
    $user = auth()->user();
@endphp

<header>
    <div class="header-content">
        <div class="header-left">
            <h2><i class="ri-hospital-line"></i> Cabinet Médical</h2>
            <p>Espace Patient</p>
        </div>

        <div class="header-right">
            <div class="user-info">
                <i class="ri-user-line"></i>
                <div class="user-name">{{ $user?->name }}</div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn-header">Déconnexion</button>
            </form>
        </div>
    </div>
</header>

<div class="container">

    <div class="page-header">
        <h1><i class="ri-calendar-check-line"></i> Mes Rendez-vous</h1>
        <a href="{{ route('rendezvous.create') }}" class="btn-nouveau"><i class="ri-add-line"></i> Nouveau rendez-vous</a>
    </div>

    @if($rendezvous->isEmpty())
        <div style="background:white;padding:40px;border-radius:15px;text-align:center">
            <i class="ri-calendar-line" style="font-size:70px;color:#cbd5e1"></i>
            <h3>Aucun rendez-vous</h3>
            <a href="{{ route('rendezvous.create') }}" class="btn-nouveau">Prendre un rendez-vous</a>
        </div>
    @else

    <div class="rdv-grid">
        @foreach($rendezvous as $rv)

            @php
                $statut = strtolower($rv->statut);
                $cardClass = str_contains($statut,'confirm') ? 'confirme' :
                             (str_contains($statut,'attent') ? 'en-attente' :
                             (str_contains($statut,'annul') ? 'annule' : ''));
            @endphp

            <div class="rdv-card {{ $cardClass }}">
                
                <span class="status-badge {{ $cardClass }}">{{ $rv->statut }}</span>

                <div class="rdv-header">
                    <div class="rdv-icon"><i class="ri-calendar-event-line"></i></div>

                    <div>
                        <h3>{{ Carbon::parse($rv->date_rv)->translatedFormat('l d F Y') }}</h3>
                        <p><i class="ri-time-line"></i> {{ Carbon::parse($rv->heure_rv)->format('H:i') }}</p>
                    </div>
                </div>

                <div class="info-row">
                    <i class="ri-file-text-line"></i>
                    <div><strong>Motif :</strong> {{ $rv->motif }}</div>
                </div>

                <div class="rdv-actions">

                    <a href="{{ route('rendezvous.show', $rv->id_rv) }}" class="btn-action btn-details">
                        <i class="ri-eye-line"></i>Détails
                    </a>

                    @if($cardClass !== 'annule')
                    <form method="POST" action="{{ route('rendezvous.cancel', $rv->id_rv) }}" style="flex:1;">
                        @csrf
                        @method('PATCH')
                        <button class="btn-action btn-annuler" onclick="return confirm('Voulez-vous annuler ce rendez-vous ?');">
                            <i class="ri-close-line"></i>Annuler
                        </button>
                    </form>
                    @endif

                </div>

            </div>

        @endforeach
    </div>
    @endif
</div>

</body>
</html>
