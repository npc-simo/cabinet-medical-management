<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord – Médecin</title>

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
            margin: 18px auto 40px;
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(0, 1.3fr);
            gap: 18px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        }

        /* TITLES */
        h1 {
            font-size: 22px;
            margin-bottom: 4px;
            color: var(--text-main);
        }
        .subtitle {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* GRID INFO */
        .grid {
            display: grid;
            grid-template-columns: minmax(0,1.2fr) minmax(0,1.2fr);
            gap: 12px;
            margin-top: 18px;
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

        /* STATS */
        .stats-title { font-size: 15px; font-weight: 600; margin-bottom: 10px; color: var(--text-main); }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px,1fr));
            gap: 10px; margin-top: 8px;
        }
        .stats-card {
            background: #f7fafc;
            border-radius: 12px;
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
        }
        .stats-label {
            font-size: 12px;
            color: #4a5568;
            margin-bottom: 4px;
        }
        .stats-number {
            font-size: 22px;
            font-weight: 600;
            color: var(--primary-dark);
        }

        /* TABLE RENDEZ-VOUS */
        .table-wrapper {
            margin-top: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        th, td {
            padding: 8px 6px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        th { font-size: 12px; color: #718096; text-transform: uppercase; }
        .tag {
            display:inline-block;
            padding: 2px 8px;
            font-size: 11px;
            border-radius: 999px;
            background:#ebf4ff;
            color:#2b6cb0;
        }

        /* RIGHT COLUMN – ACTIONS */
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

        @media (max-width: 900px) {
            .wrapper {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

{{-- TOP BAR --}}
<div class="topbar">
    <div class="topbar-left">
        <div class="logo-circle">CM</div>
        <div>
            <div class="topbar-title">Cabinet médical – Espace médecin</div>
            <div class="topbar-user">Connecté en tant que {{ $user->name ?? 'Médecin' }}</div>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Déconnexion</button>
    </form>
</div>

{{-- NAV TABS --}}
<div class="nav-tabs">
    <span class="nav-tab active">Tableau de bord</span>
    <a href="{{ route('rendezvous.create') }}" class="nav-tab">Nouveau rendez-vous</a>
</div>

<div class="wrapper">

    {{-- COLONNE GAUCHE --}}
    <div>
        <div class="card">
            <h1>Bonjour Dr {{ $user->name ?? '' }}</h1>
            <p class="subtitle">
                Vue globale sur l’activité du cabinet aujourd’hui.
            </p>

            <div class="grid">

                {{-- STATISTIQUES GÉNÉRALES --}}
                <div class="box">
                    <div class="box-title">Statistiques générales</div>
                    <div class="box-text">
                        Nombre total de patients : <strong>{{ $totalPatients }}</strong><br>
                        Nombre total de rendez-vous : <strong>{{ $totalRendezvous }}</strong><br>
                        Rendez-vous prévus aujourd'hui : <strong>{{ $todayRendezvousCount }}</strong><br>
                        <span class="chip">Vue cabinet</span>
                    </div>
                </div>

                {{-- INFORMATIONS MEDICAL --}}
                <div class="box">
                    <div class="box-title">Dossiers & ordonnances</div>
                    <div class="box-text">
                        Dossiers médicaux enregistrés : <strong>{{ $dossiersCount }}</strong><br>
                        Ordonnances générées : <strong>{{ $ordonnancesCount }}</strong><br>
                        <small>Vous pouvez utiliser ces informations pour suivre la charge clinique.</small><br>
                        <span class="chip">Suivi médical</span>
                    </div>
                </div>

            </div>

            {{-- PROCHAINS RENDEZ-VOUS --}}
            <div class="table-wrapper">
                <div class="box-title" style="margin-bottom:8px;">Prochains rendez-vous</div>

                @if($upcomingRendezvous->isEmpty())
                    <p class="subtitle">Aucun rendez-vous planifié pour le moment.</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Patient</th>
                                <th>Statut</th>
                                <th>Détail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($upcomingRendezvous as $rv)
                            <tr>
                                <td>{{ $rv->date_rv }}</td>
                                <td>{{ $rv->heure_rv }}</td>
                                <td>
                                    @if($rv->patient)
                                        {{ $rv->patient->nom }} {{ $rv->patient->prenom }}
                                    @else
                                        Patient n/a
                                    @endif
                                </td>
                                <td>
                                    <span class="tag">
                                        {{ $rv->statut ?? '—' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('rendezvous.show', $rv->id_rv) }}" style="font-size:12px;color:#3182ce;text-decoration:none;">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>

    {{-- COLONNE DROITE --}}
    <div>
        <div class="card">
            <div class="actions-title">Actions rapides</div>

            <a href="{{ route('rendezvous.create') }}">
                <button type="button" class="action-btn action-primary">
                    Programmer un nouveau rendez-vous
                </button>
            </a>

            <button type="button" class="action-btn action-secondary">
                Consulter l’historique des consultations (à implémenter)
            </button>

            <button type="button" class="action-btn action-secondary">
                Gérer les dossiers médicaux (à implémenter)
            </button>

            <div style="margin-top:18px;">
                <div class="stats-title">Synthèse rapide</div>
                <div class="stats-grid">
                    <div class="stats-card">
                        <div class="stats-label">Patients</div>
                        <div class="stats-number">{{ $totalPatients }}</div>
                    </div>
                    <div class="stats-card">
                        <div class="stats-label">Rendez-vous (total)</div>
                        <div class="stats-number">{{ $totalRendezvous }}</div>
                    </div>
                    <div class="stats-card">
                        <div class="stats-label">Aujourd'hui</div>
                        <div class="stats-number">{{ $todayRendezvousCount }}</div>
                    </div>
                    <div class="stats-card">
                        <div class="stats-label">Dossiers médicaux</div>
                        <div class="stats-number">{{ $dossiersCount }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
