@extends('template')

@section('content')

    <h2> Ajouter un Burger</h2>
    <hr>

    <div class="col-md-6">
        <form action="{{ route('storeBurger') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nom du Burger</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Prix (FCFA)</label>
                <input type="number" name="prix" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock initial</label>
                <input type="number" name="stock" class="form-control" value="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <button class="btn btn-warning">Enregistrer</button>
            <a href="{{ route('burgers') }}" class="btn btn-secondary ms-2">Annuler</a>
        </form>
    </div>

@endsection
