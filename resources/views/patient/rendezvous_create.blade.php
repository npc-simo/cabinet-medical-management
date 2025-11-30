<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Prendre rendez-vous – Cabinet Médical</title>

    <!-- REMIX ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* نفس الستايل ديالك بلا تغيير */
        *{margin:0;padding:0;box-sizing:border-box}
        body{
            font-family:'Poppins',sans-serif;
            background:linear-gradient(135deg,#f5f7fa 0%,#e8f1f8 100%);
            min-height:100vh;
            padding:20px;
        }
        .header{
            max-width:900px;margin:0 auto 30px;text-align:center;
            padding:30px 20px;background:white;border-radius:20px;
            box-shadow:0 4px 20px rgba(0,0,0,0.08);
        }
        .header h1{
            color:#1e88e5;font-size:32px;font-weight:700;
            margin-bottom:10px;display:flex;align-items:center;
            justify-content:center;gap:12px;
        }
        .header h1 i{font-size:38px}
        .header p{color:#666;font-size:16px}
        .container{
            max-width:900px;margin:0 auto;background:white;
            padding:40px;border-radius:20px;
            box-shadow:0 8px 30px rgba(0,0,0,0.1);
        }
        .error-box{
            background:linear-gradient(135deg,#fff5f5 0%,#ffe8e8 100%);
            border-left:4px solid #e53e3e;color:#c53030;
            padding:18px 20px;border-radius:12px;margin-bottom:30px;
            font-size:14px;display:flex;align-items:start;gap:12px;
        }
        .error-box i{font-size:22px;flex-shrink:0;margin-top:2px}
        .error-list{list-style:none;margin:0;padding:0}
        .error-list li{margin-bottom:6px;padding-left:20px;position:relative}
        .error-list li:before{
            content:"•";position:absolute;left:5px;font-weight:bold;
        }
        .section-title{
            font-weight:600;font-size:20px;margin-top:35px;margin-bottom:20px;
            color:#1e88e5;padding-bottom:12px;border-bottom:3px solid #e3f2fd;
            display:flex;align-items:center;gap:10px;
        }
        .section-title i{font-size:24px}
        .section-title:first-of-type{margin-top:0}
        .grid{
            display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;margin-bottom:20px;
        }
        .form-group{display:flex;flex-direction:column}
        .form-group.full-width{grid-column:1/-1}
        label{
            font-size:14px;color:#2d3748;font-weight:500;
            margin-bottom:8px;display:flex;align-items:center;gap:6px;
        }
        label i{color:#1e88e5;font-size:16px}
        label .required{color:#e53e3e;font-weight:600}
        input,textarea,select{
            width:100%;padding:12px 16px;border:2px solid #e2e8f0;
            border-radius:10px;font-size:15px;font-family:'Poppins',sans-serif;
            transition:all .3s ease;background:white;
        }
        input:focus,textarea:focus,select:focus{
            border-color:#1e88e5;outline:none;
            box-shadow:0 0 0 3px rgba(30,136,229,0.1);
        }
        input:hover,textarea:hover,select:hover{border-color:#90caf9}
        textarea{resize:vertical;min-height:100px;line-height:1.6}
        select{
            cursor:pointer;
            background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%231e88e5' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat:no-repeat;background-position:right 12px center;
            appearance:none;padding-right:40px;
        }
        .info-box{
            background:linear-gradient(135deg,#e3f2fd 0%,#bbdefb 100%);
            border-left:4px solid #1e88e5;padding:16px 20px;
            border-radius:12px;margin:25px 0;display:flex;
            align-items:start;gap:12px;
        }
        .info-box i{color:#1e88e5;font-size:22px;flex-shrink:0;margin-top:2px}
        .info-box p{color:#1565c0;font-size:14px;margin:0;line-height:1.6}
        .btn-submit{
            width:100%;padding:16px;margin-top:30px;
            background:linear-gradient(135deg,#1e88e5 0%,#1565c0 100%);
            color:white;border:none;border-radius:12px;font-weight:600;
            font-size:17px;cursor:pointer;transition:all .3s ease;
            display:flex;align-items:center;justify-content:center;gap:10px;
            box-shadow:0 4px 15px rgba(30,136,229,0.3);
        }
        .btn-submit:hover{
            transform:translateY(-2px);
            box-shadow:0 6px 25px rgba(30,136,229,0.4);
        }
        .btn-submit i{font-size:20px}
        @media(max-width:768px){
            .container{padding:30px 20px}
            .header h1{font-size:26px}
            .grid{grid-template-columns:1fr}
            .section-title{font-size:18px}
        }
        @media(max-width:480px){
            body{padding:10px}
            .header{padding:20px 15px}
            .header h1{font-size:22px;flex-direction:column;gap:8px}
            .container{padding:25px 15px}
            .section-title{font-size:17px}
        }
    </style>
</head>
<body>
@include('partials.dashboard_back')
<div class="header">
    <h1>
        <i class="ri-calendar-check-line"></i>
        Prendre rendez-vous
    </h1>
    <p>Remplissez le formulaire ci-dessous pour réserver votre consultation</p>
</div>

<div class="container">

    {{-- Affichage erreurs --}}
    @if ($errors->any())
        <div class="error-box">
            <i class="ri-error-warning-line"></i>
            <div>
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- FORMULAIRE --}}
    <form method="POST" action="{{ route('rendezvous.store') }}">
        @csrf

        {{-- SECTION PATIENT --}}
        <div class="section-title">
            <i class="ri-user-line"></i>
            Informations du patient
        </div>

        <div class="grid">
            <div class="form-group">
                <label>
                    <i class="ri-user-3-line"></i>
                    Nom <span class="required">*</span>
                </label>
                <input type="text" name="nom" placeholder="Ex: ELHAJJI"
                       value="{{ old('nom') }}" required>
            </div>

            <div class="form-group">
                <label>
                    <i class="ri-user-smile-line"></i>
                    Prénom <span class="required">*</span>
                </label>
                <input type="text" name="prenom" placeholder="Ex: Mohammed"
                       value="{{ old('prenom') }}" required>
            </div>

            <div class="form-group">
                <label>
                    <i class="ri-cake-2-line"></i>
                    Date de naissance
                </label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance') }}">
            </div>

            <div class="form-group">
                <label>
                    <i class="ri-genderless-line"></i>
                    Sexe
                </label>
                <select name="sexe">
                    <option value="">-- Sélectionner --</option>
                    <option value="M" {{ old('sexe')=='M'?'selected':'' }}>Masculin</option>
                    <option value="F" {{ old('sexe')=='F'?'selected':'' }}>Féminin</option>
                </select>
            </div>

            <div class="form-group">
                <label>
                    <i class="ri-phone-line"></i>
                    Téléphone
                </label>
                <input type="tel" name="telephone"
                       placeholder="Ex: 06 12 34 56 78"
                       value="{{ old('telephone') }}">
            </div>

            <div class="form-group">
                <label>
                    <i class="ri-bank-card-line"></i>
                    CIN
                </label>
                <input type="text" name="cin" placeholder="Ex: AB123456"
                       value="{{ old('cin') }}">
            </div>
        </div>

        <div class="form-group full-width">
            <label>
                <i class="ri-map-pin-line"></i>
                Adresse
            </label>
            <textarea name="adresse" placeholder="Votre adresse complète...">{{ old('adresse') }}</textarea>
        </div>

        {{-- SECTION RENDEZ-VOUS --}}
        <div class="section-title">
            <i class="ri-calendar-event-line"></i>
            Détails du rendez-vous
        </div>

        <div class="grid">
            <div class="form-group">
                <label>
                    <i class="ri-calendar-2-line"></i>
                    Date du rendez-vous <span class="required">*</span>
                </label>
                <input type="date" name="date_rv"
                       value="{{ old('date_rv') }}" required>
            </div>

            <div class="form-group">
                <label>
                    <i class="ri-time-line"></i>
                    Heure du rendez-vous <span class="required">*</span>
                </label>
                <input type="time" name="heure_rv"
                       value="{{ old('heure_rv') }}" required>
            </div>
        </div>

        <div class="form-group full-width">
            <label>
                <i class="ri-file-text-line"></i>
                Motif de consultation <span class="required">*</span>
            </label>
            <textarea name="motif"
                      placeholder="Décrivez brièvement le motif de votre consultation..."
                      required>{{ old('motif') }}</textarea>
        </div>

        <div class="info-box">
            <i class="ri-information-line"></i>
            <p>
                <strong>Note :</strong> Les champs marqués d'un astérisque (<span class="required">*</span>) sont obligatoires. 
                Votre rendez-vous sera confirmé dans les plus brefs délais par notre équipe.
            </p>
        </div>

        <button type="submit" class="btn-submit">
            <i class="ri-check-line"></i>
            Confirmer le rendez-vous
        </button>
    </form>

</div>

</body>
</html>
