<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Système d\'Évaluation des Enseignants') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #ce7b21ff 0%, #d81616ff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.25);
            max-width: 700px;
            width: 100%;
            padding: 40px 30px;
            text-align: center;
        }
        .logo {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        h1 {
            color: #1f2937;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #6b7280;
            font-size: 1rem;
            margin-bottom: 25px;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        .feature {
            background: #f9fafb;
            padding: 15px;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .feature:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 1.8rem;
            margin-bottom: 8px;
        }
        .feature h3 {
            color: #374151;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }
        .feature p {
            color: #6b7280;
            font-size: 0.9rem;
        }
        .buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-block;
            padding: 15px 35px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-primary {
            background: linear-gradient(135deg, #ce7b21ff 0%, #d81616ff 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 2px solid #e5e7eb;
        }
        .btn-secondary:hover {
            background: #e5e7eb;
        }
        .footer {
            margin-top: 25px;
            color: #9ca3af;
            font-size: 0.8rem;
        }
        @media (max-width: 640px) {
            h1 { font-size: 1.8rem; }
            .container { padding: 30px 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">🎓</div>
        <h1>Système d'Évaluation des Enseignants</h1>
        <p class="subtitle">Plateforme moderne pour l'évaluation pédagogique</p>

        <div class="features">
            <div class="feature">
                <div class="feature-icon">👨‍🏫</div>
                <h3>Enseignants</h3>
                <p>Gestion complète des profils enseignants</p>
            </div>
            <div class="feature">
                <div class="feature-icon">👨‍🎓</div>
                <h3>Étudiants</h3>
                <p>Évaluations anonymes et sécurisées</p>
            </div>
            <div class="feature">
                <div class="feature-icon">📊</div>
                <h3>Statistiques</h3>
                <p>Tableaux de bord et rapports détaillés</p>
            </div>
            <div class="feature">
                <div class="feature-icon">✅</div>
                <h3>Critères</h3>
                <p>Évaluation multi-critères personnalisable</p>
            </div>
        </div>

        @if(auth()->check())
            <div class="buttons">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Accéder au Tableau de Bord</a>
            </div>
        @else
            <div class="buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Se Connecter</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Créer un Compte</a>
            </div>
        @endif

        <div class="footer">
            <p>L3 Génie Logiciel - Projet Académique 2026</p>
        </div>
    </div>
</body>
</html>
