<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Médical – Dr.XXXXXX</title>

    <!-- GOOGLE FONT – POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- REMIX ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f7fb;
            color: #2c3e50;
        }

        /* HEADER */
        header {
            background: #0A77D5;
            padding: 22px 40px;
            color: white;
            box-shadow: 0 3px 15px rgba(0,0,0,0.12);
        }

        .header-content {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left h2 {
            font-size: 24px;
            font-weight: 600;
        }

        .header-left p {
            font-size: 14px;
            opacity: 0.9;
        }

        .btn-top {
            background: white;
            color: #0A77D5;
            padding: 10px 22px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            font-weight: 600;
            transition: 0.25s;
            font-size: 14px;
        }

        .btn-top:hover {
            background: #e1eefc;
            transform: translateY(-2px);
        }

        /* HERO */
        .hero {
            background: white;
            max-width: 980px;
            margin: 50px auto;
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(0,0,0,0.07);
            overflow: hidden;
        }

        .hero-content {
            padding: 50px 45px;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 38px;
            font-weight: 700;
            color: #0A77D5;
            margin-bottom: 18px;
        }

        .hero-content p {
            font-size: 17px;
            color: #4e5d6c;
            line-height: 1.7;
        }

        .highlight {
            color: #0A77D5;
            font-weight: 600;
        }

        /* SERVICES */
        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            padding: 40px;
            gap: 25px;
            background: #f9fcff;
        }

        .service-card {
            background: white;
            padding: 28px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
            transition: 0.3s;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .service-icon {
            font-size: 46px;
            color: #0A77D5;
            margin-bottom: 14px;
        }

        .service-card h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .service-card p {
            font-size: 14px;
            color: #617182;
        }

        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, #0A77D5, #085ca8);
            padding: 55px 25px;
            text-align: center;
            color: white;
        }

        .cta-section h2 {
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .btn-main {
            margin-top: 18px;
            display: inline-block;
            padding: 14px 38px;
            background: white;
            color: #0A77D5;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-main:hover {
            background: #e1eefc;
            transform: translateY(-3px);
        }

        /* INFO GRID */
        .info-section {
            max-width: 950px;
            margin: 40px auto;
            padding: 35px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.09);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 28px;
        }

        .info-item {
            text-align: center;
        }

        .info-item i {
            font-size: 38px;
            color: #0A77D5;
            margin-bottom: 12px;
        }

        .info-item h4 {
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .info-item p {
            font-size: 13px;
            color: #617182;
        }

        /* FOOTER */
        footer {
            background: #085ca8;
            padding: 35px 20px;
            text-align: center;
            color: white;
        }

        footer p {
            font-size: 14px;
            opacity: 0.9;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<header>
    <div class="header-content">
        <div class="header-left">
            <h2>Cabinet Médical – Dr.XXXXXX</h2>
            <p>Médecin Généraliste – Soins, suivis et consultations</p>
        </div>

        <div class="header-right">
            <a href="/register" class="btn-top">S'inscrire</a>
            <a href="/login" class="btn-top">Se connecter</a>
        </div>
    </div>
</header>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <h1>Bienvenue dans notre cabinet médical</h1>
        <p>Nous mettons à votre disposition un <span class="highlight">service de consultation moderne</span> et un suivi médical professionnel.</p>
        <p><span class="highlight">Votre santé est notre priorité.</span></p>
    </div>

    <!-- SERVICES -->
    <div class="services">

        <div class="service-card">
            <i class="ri-stethoscope-line service-icon"></i>
            <h3>Consultations</h3>
            <p>Consultations générales et spécialisées</p>
        </div>

        <div class="service-card">
            <i class="ri-clipboard-line service-icon"></i>
            <h3>Suivi médical</h3>
            <p>Suivi détaillé de votre dossier médical</p>
        </div>
    </div>

    <!-- CTA -->
<div class="cta-section">
    <h2>Prenez rendez-vous aujourd'hui</h2>
    <p>Réservez votre consultation en quelques clics</p>
    <a href="{{ route('rendezvous.create') }}" class="btn-main">
        Prendre rendez-vous
    </a>
</div>


    <!-- INFO GRID -->
    <div class="info-section">
        <div class="info-grid">
            <div class="info-item">
                <i class="ri-time-line"></i>
                <h4>Horaires flexibles</h4>
                <p>Du lundi au samedi</p>
            </div>

            <div class="info-item">
                <i class="ri-smartphone-line"></i>
                <h4>Plateforme digitale</h4>
                <p>Gestion en ligne simplifiée</p>
            </div>

            <div class="info-item">
                <i class="ri-shield-check-line"></i>
                <h4>Données sécurisées</h4>
                <p>Confidentialité garantie</p>
            </div>

            <div class="info-item">
                <i class="ri-user-heart-line"></i>
                <h4>Médecin qualifié</h4>
                <p>Expertise reconnue</p>
            </div>
        </div>
    </div>

</div>

<!-- FOOTER -->
<footer>
    <p><strong>Cabinet Médical – Dr. XXXXXXXX</strong></p>
    <p>Adresse : Rue Exemple, Ville, Maroc</p>
    <p>Téléphone : 06 00 00 00 00</p>
    <p>Email : contact@cabinet-medical.ma</p>
    <p style="margin-top: 15px;">© 2025 Cabinet Médical. Tous droits réservés</p>
</footer>

</body>
</html>
