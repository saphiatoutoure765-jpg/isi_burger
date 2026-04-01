@extends('template')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2> Détails Commande #{{ $commande->id }}</h2>
        <a href="{{ route('commandes') }}" class="btn btn-secondary">← Retour</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">Informations client</div>
                <div class="card-body">
                    <p><strong>Nom :</strong> {{ $commande->user->name }}</p>
                    <p><strong>Email :</strong> {{ $commande->user->email }}</p>
                    <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Montant total :</strong>
                        <span class="text-warning fw-bold">
                            {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">Changer le statut</div>
                <div class="card-body">
                    @if(!in_array($commande->statut, ['annulee', 'payee']))
                        <form action="{{ route('updateStatutCommande', $commande->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nouveau statut</label>
                                <select name="statut" class="form-control">
                                    <option value="en_attente"
                                        {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>
                                         En attente
                                    </option>
                                    <option value="en_preparation"
                                        {{ $commande->statut == 'en_preparation' ? 'selected' : '' }}>
                                         En préparation
                                    </option>
                                    <option value="prete"
                                        {{ $commande->statut == 'prete' ? 'selected' : '' }}>
                                         Prête (envoie la facture par email)
                                    </option>
                                </select>
                            </div>
                            <button class="btn btn-warning">Mettre à jour</button>
                        </form>
                    @else
                        <span class="badge bg-{{ $commande->statut == 'payee' ? 'success' : 'danger' }} fs-6">
                            {{ $commande->statut == 'payee' ? ' Payée' : ' Annulée' }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Lignes de commande --}}
    <div class="card">
        <div class="card-header bg-dark text-white">Articles commandés</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-secondary">
                    <tr>
                        <th>Burger</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->lignesCommande as $ligne)
                        <tr>
                            <td>{{ $ligne->burger->nom }}</td>
                            <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $ligne->quantite }}</td>
                            <td>{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-warning">
                        <td colspan="3" class="text-end fw-bold">TOTAL</td>
                        <td class="fw-bold">
                            {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-3">
        @if(in_array($commande->statut, ['prete', 'payee']))
            <a href="{{ route('telechargerFacture', $commande->id) }}"
               class="btn btn-success">
                 Télécharger la facture PDF
            </a>
        @endif

        @if($commande->statut == 'prete' && !$commande->paiement)
            <a href="{{ route('payerCommande', $commande->id) }}"
               class="btn btn-primary ms-2"
               onclick="return confirm('Confirmer le paiement en espèces ?')">
                 Enregistrer le paiement
            </a>
        @endif
    </div>

@endsection
