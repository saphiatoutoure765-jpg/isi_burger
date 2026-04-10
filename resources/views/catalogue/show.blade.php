@extends('template')

@section('content')

    <div class="row">
        <div class="col-md-5">
            @if($burger->image)
                <img src="{{ asset('storage/' . $burger->image) }}"
                     class="img-fluid rounded shadow" style="width:100%; object-fit:cover; max-height:350px;">
            @else
                <div class="bg-secondary d-flex align-items-center justify-content-center rounded"
                     style="height:350px; font-size:8rem;">

                </div>
            @endif
        </div>

        <div class="col-md-7">
            <h2>{{ $burger->nom }}</h2>
            <p class="text-muted">{{ $burger->description }}</p>
            <h3 class="text-warning">{{ number_format($burger->prix, 0, ',', ' ') }} FCFA</h3>
            <p>Stock disponible : <span class="badge bg-success">{{ $burger->stock }}</span></p>

            <hr>

            <a href="{{ route('commander') }}" class="btn btn-warning btn-lg">
                 Commander maintenant
            </a>
            <a href="{{ route('catalogue') }}" class="btn btn-secondary ms-2">
                ← Retour au catalogue
            </a>
        </div>
    </div>

@endsection
