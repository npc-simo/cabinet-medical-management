<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord – Patient</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0A77D5;
            --primary-dark: #085ca8;
            --bg: #f3f7fb;
            --text-main: #2d3748;
            --text-muted: #718096;
            --card-bg: #ffffff;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            font-family: 'Poppins', sans-serif;
        }

        /* TOP NAVBAR */
        .topbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar-left { display: flex; align-items: center; gap: 10px; }
        .logo-circle {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 18px;
        }
        .topbar-title { font-weight: 600; color: var(--text-main); font-size: 16px; }
        .topbar-user { font-size: 14px; color: var(--text-muted); }

        .logout-btn {
            margin-left: 15px; border: none; background: #e53e3e;
            color: #fff; padding: 7px 14px; border-radius: 999px;
            font-size: 12px; cursor: pointer;
        }

        /* NAV TABS */
        .nav-tabs {
            max-width: 1100px;
            margin: 20px auto 0;
            display: flex; gap: 8px; flex-wrap: wrap;
        }

        .nav-tab {
            padding: 8px 16px; border-radius: 999px;
            background: #e2edf9; color: var(--primary-dark);
            font-size: 13px; text-decoration: none; font-weight: 500;
        }
        .nav-tab.active { background: var(--primary); color: #fff; }
        .nav-tab:hover { background: var(--primary-dark); color: #fff; }

        /* PAGE LAYOUT */
        .wrapper {
            max-width: 1100px;
            margin: 25px auto 40px;
            display: grid;
            grid-template-columns: 2.1fr 0.9fr;
            gap: 18px;
        }
        .card {
            background: var(--card-bg);
            padding: 22px; border-radius: 12px;
            box-shadow: 0 6px 22px rgba(0,0,0,0.06);
        }

        h1 { color: var(--primary); margin-bottom: 5px; font-size: 24px; }
        .subtitle { color: var(--text-muted); margin-bottom: 18px; font-size: 14px; }

        /* BOXES */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 14px;
        }
        .box {
            background: #f8fbff;
            border-radius: 10px;
            padding: 16px; border: 1px solid #e1ecf7;
        }
        .box-title { font-weight: 600; color: var(--primary); margin-bottom: 6px; font-size: 14px; }
        .box-text { font-size: 13px; color: #555; line-height: 1.5; }
        .chip {
            display: inline-block; padding: 3px 9px;
            border-radius: 999px; font-size: 11px;
            background: #e6fffa; color: #0b8073; margin-top: 6px;
        }

        /* QUICK ACTIONS */
        .actions-title { font-size: 15px; font-weight: 600; margin-bottom: 12px; color: var(--text-main); }
        .action-btn {
            width: 100%; padding: 10px 12px; border-radius: 9px;
            border: none; margin-bottom: 8px; font-size: 13px;
            cursor: pointer; text-align: left;
        }
        .action-primary { background: var(--primary); color: #fff; }
        .action-primary:hover { background: var(--primary-dark); }
        .action-secondary { background: #edf2f7; color: #2d3748; }
        .action-secondary:hover { background: #e2e8f0; }

        /* STATS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px,1fr));
            gap: 10px; margin-top: 12px;
        }
        .stats-card {
            background: #f7fafc; border-radius: 9px; padding: 10px 12px;
        }
        .stats-number { font-size: 22px; font-weight: 600; color: var(--primary-dark); }
        .stats-label { font-size: 11px; color: var(--text-muted); }

        @media (max-width: 900px) {
            .wrapper { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>


{{-- TOP BAR --}}
<div class="topbar">
    <div class="topbar-left">
        <div class="logo-circle">CM</div>
        <div>
            <div class="topbar-title">Cabinet Médical – Espace Patient</div>
            <div class="topbar-user">Connecté en tant que {{ $user->name }}</div>
        </div>
    </div>

    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Se déconnecter</button>
        </form>
    </div>
</div>

{{-- NAVIGATION --}}
<div class="nav-tabs">
    <a href="{{ route('patient.dashboard') }}" class="nav-tab active">Aperçu</a>
    <a href="{{ route('rendezvous.create') }}" class="nav-tab">Prendre un rendez-vous</a>
    <a href="{{ route('patient.rendezvous.index') }}" class="nav-tab">Mes rendez-vous</a>
    <a href="{{ route('patient.dossier') }}" class="nav-tab">Mon dossier médical</a>
    <a href="{{ route('patient.ordonnances') }}" class="nav-tab">Mes ordonnances</a>
    <a href="{{ route('patient.factures') }}" class="nav-tab">Mes factures</a>
</div>


<div class="wrapper">

    {{-- LEFT CONTENT --}}
    <div>
        <div class="card">
            <h1>Bonjour {{ $user->name }}</h1>
            <p class="subtitle">
                Bienvenue dans votre espace patient.
            </p>

            <div class="grid">

                {{-- INFORMATIONS PATIENT --}}
                <div class="box">
                    <div class="box-title">Mes informations</div>
                    <div class="box-text">
                        @if($patient)
                            Nom : {{ $patient->nom }} {{ $patient->prenom }}<br>
                            Téléphone : {{ $patient->telephone ?? 'Non renseigné' }}<br>
                            CIN : {{ $patient->cin ?? 'Non renseigné' }}<br>
                            <small>Adresse : {{ $patient->adresse ?? 'Non renseignée' }}</small><br>
                            <span class="chip">Profil patient associé</span>
                        @else
                            Votre profil patient n’est pas encore créé.<br>
                            Il sera créé automatiquement lors de la prise de rendez-vous.
                        @endif
                    </div>
                </div>

                {{-- RDV --}}
                <div class="box">
                    <div class="box-title">Mes rendez-vous</div>
                    <div class="box-text">
                        Consultez vos rendez-vous dans la section dédiée.<br>
                        <small>Accès via “Mes rendez-vous”.</small>
                    </div>
                </div>

                {{-- DOCUMENTS --}}
                <div class="box">
                    <div class="box-title">Mes documents</div>
                    <div class="box-text">
                        Ordonnances, analyses et comptes rendus seront affichés ici.
                    </div>
                </div>

                {{-- FACTURES --}}
                <div class="box">
                    <div class="box-title">Factures</div>
                    <div class="box-text">
                        Consultez vos paiements et factures associées aux consultations.
                    </div>
                </div>
            </div>
        </div>

        {{-- MINI STATS --}}
        <div class="card">
            <div class="stats-grid">
                <div class="stats-card">
                    <div class="stats-number">{{ $rendezvousCount ?? 0 }}</div>
                    <div class="stats-label">Rendez-vous total</div>
                </div>

                <div class="stats-card">
                    <div class="stats-number">{{ $upcomingCount ?? 0 }}</div>
                    <div class="stats-label">À venir</div>
                </div>

                <div class="stats-card">
                    <div class="stats-number">{{ $facturesCount ?? 0 }}</div>
                    <div class="stats-label">Factures</div>
                </div>

                <div class="stats-card">
                    <div class="stats-number">{{ $dossiersCount ?? 0 }}</div>
                    <div class="stats-label">Dossiers médicaux</div>
                </div>
            </div>
        </div>

    </div>

    {{-- RIGHT COLUMN --}}
    <div>
        <div class="card">
    <div class="actions-title">Actions rapides</div>

    <a href="{{ route('rendezvous.create') }}">
        <button type="button" class="action-btn action-primary">
            Prendre un rendez-vous
        </button>
    </a>

    <a href="{{ route('patient.rendezvous.index') }}">
        <button type="button" class="action-btn action-secondary">
            Voir mes rendez-vous
        </button>
    </a>

    <a href="{{ route('patient.dossier') }}">
        <button type="button" class="action-btn action-secondary">
            Consulter mon dossier médical
        </button>
    </a>

    <a href="{{ route('patient.ordonnances') }}">
        <button type="button" class="action-btn action-secondary">
            Voir mes ordonnances
        </button>
    </a>

    <a href="{{ route('patient.factures') }}">
        <button type="button" class="action-btn action-secondary">
            Consulter mes factures
        </button>
    </a>
</div>

    </div>

</div>

</body>
</html>
