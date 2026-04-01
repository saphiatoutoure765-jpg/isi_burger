@extends('template')

@section('content')

    <h2>🛒 Passer une Commande</h2>
    <hr>

    @if($burgers->isEmpty())
        <div class="alert alert-warning">Aucun burger disponible en stock pour le moment.</div>
    @else
        <form action="{{ route('storeCommande') }}" method="POST">
            @csrf

            <div class="table-responsive">
                <table class="table table-bordered bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>Burger</th>
                            <th>Prix unitaire</th>
                            <th>Stock</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($burgers as $burger)
                            <tr>
                                <td>
                                    @if($burger->image)
                                        <img src="{{ asset('storage/' . $burger->image) }}"
                                             width="50" height="50"
                                             style="object-fit:cover; border-radius:5px;" class="me-2">
                                    @endif
                                    {{ $burger->nom }}
                                </td>
                                <td>{{ number_format($burger->prix, 0, ',', ' ') }} FCFA</td>
                                <td><span class="badge bg-success">{{ $burger->stock }}</span></td>
                                <td>
                                    <input type="number"
                                           name="burgers[{{ $burger->id }}]"
                                           class="form-control quantite"
                                           value="0"
                                           min="0"
                                           max="{{ $burger->stock }}"
                                           data-prix="{{ $burger->prix }}"
                                           style="width: 100px;">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="alert alert-info">
                <strong>Total estimé : <span id="totalEstime">0</span> FCFA</strong>
            </div>

            <button class="btn btn-warning btn-lg" id="btnCommander" disabled>
                 Valider la commande
            </button>
            <a href="{{ route('catalogue') }}" class="btn btn-secondary ms-2">Annuler</a>
        </form>
    @endif

@endsection

@section('scripts')
<script>
    // Calcul du total en temps réel
    document.querySelectorAll('.quantite').forEach(function(input) {
        input.addEventListener('input', calculerTotal);
    });

    function calculerTotal() {
        let total = 0;
        document.querySelectorAll('.quantite').forEach(function(input) {
            const quantite = parseInt(input.value) || 0;
            const prix = parseFloat(input.dataset.prix) || 0;
            total += quantite * prix;
        });

        document.getElementById('totalEstime').textContent = total.toLocaleString('fr-FR');

        // Activer le bouton si au moins un burger sélectionné
        document.getElementById('btnCommander').disabled = (total === 0);
    }
</script>
@endsection
