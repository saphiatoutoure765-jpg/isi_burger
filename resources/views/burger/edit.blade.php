@extends('template')

@section('content')

    <h2>✏️ Modifier le Burger</h2>
    <hr>

    <div class="col-md-6">
        <form action="{{ route('updateBurger', $burger->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom du Burger</label>
                <input type="text" name="nom" class="form-control" value="{{ $burger->nom }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Prix (FCFA)</label>
                <input type="number" name="prix" class="form-control" value="{{ $burger->prix }}" step="0.01" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ $burger->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $burger->stock }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Image actuelle</label><br>
                @if($burger->image)
                    <img src="{{ asset('storage/' . $burger->image) }}"
                         width="100" height="100"
                         style="object-fit:cover; border-radius:8px;" class="mb-2"><br>
                @else
                    <span class="text-muted">Aucune image</span><br>
                @endif
                <input type="file" name="image" class="form-control mt-2" accept="image/*">
            </div>

            <button class="btn btn-warning">Mettre à jour</button>
            <a href="{{ route('burgers') }}" class="btn btn-secondary ms-2">Annuler</a>
        </form>
    </div>

@endsection
