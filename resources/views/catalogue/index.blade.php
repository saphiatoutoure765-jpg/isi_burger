@extends('template')

@section('content')

    <h2> Catalogue des Burgers</h2>
    <hr>

    {{-- Filtres --}}
    <form action="{{ route('catalogue') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="nom" class="form-control"
                   placeholder="Rechercher par nom..." value="{{ request('nom') }}">
        </div>
        <div class="col-md-3">
            <input type="number" name="prix_max" class="form-control"
                   placeholder="Prix max (FCFA)" value="{{ request('prix_max') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-warning w-100"> Filtrer</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('catalogue') }}" class="btn btn-secondary w-100">Réinitialiser</a>
        </div>
    </form>

    <div class="row">
        @forelse($burgers as $burger)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($burger->image)
                        <img src="{{ asset('storage/' . $burger->image) }}"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center"
                             style="height:200px; font-size:4rem;">

                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $burger->nom }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($burger->description, 80) }}</p>
                        <p class="fw-bold text-warning fs-5">
                            {{ number_format($burger->prix, 0, ',', ' ') }} FCFA
                        </p>
                        <span class="badge bg-success">Stock : {{ $burger->stock }}</span>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('showBurger', $burger->id) }}"
                           class="btn btn-outline-warning btn-sm w-100">
                             Voir les détails
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Aucun burger disponible pour le moment.</div>
            </div>
        @endforelse
    </div>

    {{ $burgers->links() }}

@endsection
