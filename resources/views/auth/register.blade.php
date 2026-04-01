<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ISI Burger - Inscription</title>
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
            <h2> ISI Burger</h2>
            <p class="mb-0">Créer un compte client</p>
        </div>
        <div class="card-body p-4">

            <form action="{{ route('registerPost') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-warning w-100 fw-bold">S'inscrire</button>
            </form>

            <hr>
            <div class="text-center">
                <p class="mb-0">Déjà un compte ?
                    <a href="{{ route('login') }}">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
