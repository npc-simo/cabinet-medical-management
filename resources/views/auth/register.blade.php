<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription – Cabinet Médical</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f3f7fb;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 430px;
            margin: 60px auto;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 6px 22px rgba(0,0,0,0.12);
        }

        h2 {
            text-align: center;
            color: #0A77D5;
            margin-bottom: 15px;
        }

        .error-box {
            background: #ffe1e1;
            color: #b30000;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .input-group { margin-bottom: 18px; }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #34495e;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            font-size: 15px;
            border: 1.5px solid #dce6f1;
            border-radius: 7px;
        }

        input:focus {
            border-color: #0A77D5;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 13px;
            background: #0A77D5;
            color: white;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: .25s;
            margin-top: 5px;
        }

        .btn:hover { background: #085ca8; }

        .login-link {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }

        .login-link a {
            color: #0A77D5;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>

<div class="container">

    <h2>Créer un compte</h2>

    {{-- Affichage des erreurs Laravel --}}
    @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)
                • {{ $error }}<br>
            @endforeach
        </div>
    @endif

    {{-- Message succès --}}
    @if (session('success'))
        <div class="error-box" style="background:#e1ffe1;color:#0b7a0b;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group">
            <label>Nom complet :</label>
            <input
                type="text"
                name="name"
                required
                pattern="[A-Za-z ]+"
                title="Seulement les lettres A-Z et espaces sont autorisés."
                placeholder="Entrez votre nom et prénom"
                value="{{ old('name') }}"
            >
        </div>

        <div class="input-group">
            <label>Email :</label>
            <input
                type="email"
                name="email"
                required
                placeholder="exemple@gmail.com"
                value="{{ old('email') }}"
            >
        </div>

        <div class="input-group">
            <label>Mot de passe :</label>
            <input
                type="password"
                name="password"
                required
                minlength="8"
                placeholder="Au moins 8 caractères"
            >
        </div>

        <div class="input-group">
            <label>Confirmer le mot de passe :</label>
            <input
                type="password"
                name="password_confirmation"
                required
                minlength="8"
                placeholder="Répétez le mot de passe"
            >
        </div>

        <button class="btn" type="submit">Créer le compte</button>

    </form>

    <div class="login-link">
        Vous avez déjà un compte ?
        <a href="/login">Se connecter</a>
    </div>

</div>

</body>
</html>
