<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISI Burger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; font-size: 1.5rem; color: #ff6b35 !important; }
        .sidebar { min-height: calc(100vh - 56px); background-color: #343a40; }
        .sidebar a { color: #adb5bd; text-decoration: none; display: block; padding: 10px 15px; }
        .sidebar a:hover { background-color: #495057; color: #fff; }
        .sidebar a.active { background-color: #ff6b35; color: #fff; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> ISI Burger</a>

        <div class="ms-auto d-flex align-items-center">
            @auth
                <span class="text-light me-3">
                    <i class="bi bi-person-circle"></i>
                    {{ Auth::user()->name }}
                    <span class="badge bg-{{ Auth::user()->isGestionnaire() ? 'warning' : 'success' }} ms-1">
                        {{ Auth::user()->role }}
                    </span>
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR GESTIONNAIRE --}}
        @auth
        @if(Auth::user()->isGestionnaire())
        <div class="col-md-2 sidebar pt-3">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('burgers') }}" class="{{ request()->routeIs('burgers') ? 'active' : '' }}">
                <i class="bi bi-egg-fried"></i> Burgers
            </a>
            <a href="{{ route('commandes') }}" class="{{ request()->routeIs('commandes') ? 'active' : '' }}">
                <i class="bi bi-bag-check"></i> Commandes
            </a>
        </div>
        <div class="col-md-10 pt-4">
        @else
        {{-- NAVBAR CLIENT --}}
        <div class="col-12">
        <nav class="navbar navbar-light bg-light mb-3">
            <div class="container">
                <a class="btn btn-outline-secondary btn-sm me-2" href="{{ route('catalogue') }}">
                    <i class="bi bi-grid"></i> Catalogue
                </a>
                <a class="btn btn-outline-secondary btn-sm me-2" href="{{ route('commander') }}">
                    <i class="bi bi-cart-plus"></i> Commander
                </a>
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('mesCommandes') }}">
                    <i class="bi bi-list-ul"></i> Mes Commandes
                </a>
            </div>
        </nav>
        </div>
        <div class="col-12 px-4">
        @endif
        @endauth

            {{-- MESSAGES --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
