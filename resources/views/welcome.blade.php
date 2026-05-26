<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque Numérique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.3rem;
            margin: 20px 0;
        }
        .feature-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">📚 Bibliothèque Numérique</a>
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Inscription</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero">
    <div class="container">
        <h1>📚 Bienvenue à la Bibliothèque Numérique</h1>
        <p>Découvrez, empruntez et gérez vos livres facilement</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">Commencer</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Se connecter</a>
    </div>
</div>

<!-- Features Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Nos Services</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card feature-card p-4 text-center">
                <h1>📖</h1>
                <h5>Large Catalogue</h5>
                <p class="text-muted">Accédez à des milliers de livres dans tous les genres</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card feature-card p-4 text-center">
                <h1>🔖</h1>
                <h5>Emprunt Facile</h5>
                <p class="text-muted">Empruntez vos livres préférés en quelques clics</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card feature-card p-4 text-center">
                <h1>🤖</h1>
                <h5>Assistant IA</h5>
                <p class="text-muted">Notre chatbot vous aide à trouver le livre parfait</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4">
    <p>© 2026 Bibliothèque Numérique — Tous droits réservés</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
