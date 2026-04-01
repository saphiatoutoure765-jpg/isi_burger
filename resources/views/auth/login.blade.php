<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ISI Burger - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #1a1a2e; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); }
        .card-header { background-color: #ff6b35; color: white; border-radius: 15px 15px 0 0 !important; text-align: center; padding: 20px; }
    </style>
</head>
<body>
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h1> ISI Burger</h1>
            <p class="mb-0">Connexion à votre espace</p>
        </div>
        <div class="card-body p-4">

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('loginPost') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-warning w-100 fw-bold">Se connecter</button>
            </form>

            <hr>
            <div class="text-center">
                <p class="mb-0">Pas encore de compte ?
                    <a href="{{ route('register') }}">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
