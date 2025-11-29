<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion – Cabinet Médical</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f3f7fb;
        }

        .container {
            max-width: 420px;
            margin: 70px auto;
            background: white;
            padding: 35px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border-radius: 16px;
            text-align: center;
        }

        h2 {
            color: #0A77D5;
            margin-bottom: 20px;
        }

        .input-group {
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #3a5568;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 13px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1.5px solid #dce6f1;
            font-size: 15px;
        }

        .input-group input:focus {
            border-color: #0A77D5;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: #0A77D5;
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: .3s;
            font-size: 16px;
        }

        .btn:hover {
            background: #085ca8;
        }

        .links {
            margin-top: 20px;
            font-size: 14px;
        }

        .links a {
            color: #0A77D5;
            text-decoration: none;
            font-weight: 500;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .top-icon {
            font-size: 55px;
            color: #0A77D5;
            margin-bottom: 10px;
        }

        .error-box {
            background: #ffe1e1;
            color: #b30000;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
            text-align: left;
        }
    </style>
</head>

<body>

<div class="container">
    <i class="ri-user-3-line top-icon"></i>
    <h2>Se connecter</h2>

    {{-- Affichage erreurs --}}
    @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)
                • {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="input-group">
            <label>Email :</label>
            <input
                type="email"
                name="email"
                placeholder="Entrez votre email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="input-group">
            <label>Mot de passe :</label>
            <input
                type="password"
                name="password"
                placeholder="Votre mot de passe"
                required
            >
        </div>

        <button class="btn" type="submit">Connexion</button>

        <div class="links">
            Pas de compte ? <a href="/register">S'inscrire</a>
        </div>
    </form>
</div>

</body>
</html>
