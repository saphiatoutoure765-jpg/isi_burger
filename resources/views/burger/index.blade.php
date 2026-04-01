@extends('template')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2> Liste des Burgers</h2>
        <a href="{{ route('addBurger') }}" class="btn btn-warning">
             Ajouter un Burger
        </a>
    </div>

    <table class="table table-bordered table-hover bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($burgers as $burger)
                <tr class="{{ $burger->archive ? 'table-secondary' : '' }}">
                    <td>{{ $burger->id }}</td>
                    <td>
                        @if($burger->image)
                            <img src="{{ asset('storage/' . $burger->image) }}"
                                 width="60" height="60"
                                 style="object-fit:cover; border-radius:8px;">
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>{{ $burger->nom }}</td>
                    <td>{{ number_format($burger->prix, 0, ',', ' ') }} FCFA</td>
                    <td>
                        @if($burger->stock == 0)
                            <span class="badge bg-danger">Rupture</span>
                        @else
                            <span class="badge bg-success">{{ $burger->stock }}</span>
                        @endif
                    </td>
                    <td>
                        @if($burger->archive)
                            <span class="badge bg-secondary">Archivé</span>
                        @else
                            <span class="badge bg-success">Actif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('editBurger', $burger->id) }}"
                           class="btn btn-warning btn-sm">
                             Modifier
                        </a>

                        <a href="{{ route('archiverBurger', $burger->id) }}"
                           class="btn btn-secondary btn-sm">
                            {{ $burger->archive ? ' Désarchiver' : '🗄️ Archiver' }}
                        </a>

                        <form action="{{ route('deleteBurger', $burger->id) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $burgers->links() }}

@endsection
