@extends('template')

@section('content')

    <h2> Toutes les Commandes</h2>
    <hr>

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>N°</th>
                <th>Client</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($commandes as $commande)
                <tr>
                    <td>#{{ $commande->id }}</td>
                    <td>{{ $commande->user->name }}</td>
                    <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</td>
                    <td>
                        @if($commande->statut == 'en_attente')
                            <span class="badge bg-secondary"> En attente</span>
                        @elseif($commande->statut == 'en_preparation')
                            <span class="badge bg-warning text-dark"> En préparation</span>
                        @elseif($commande->statut == 'prete')
                            <span class="badge bg-info"> Prête</span>
                        @elseif($commande->statut == 'payee')
                            <span class="badge bg-success"> Payée</span>
                        @elseif($commande->statut == 'annulee')
                            <span class="badge bg-danger"> Annulée</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('showCommande', $commande->id) }}"
                           class="btn btn-info btn-sm"> Détails</a>

                        @if(!in_array($commande->statut, ['annulee', 'payee']))
                            <a href="{{ route('annulerCommande', $commande->id) }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Annuler cette commande ?')"> Annuler</a>
                        @endif

                        @if($commande->statut == 'prete' && !$commande->paiement)
                            <a href="{{ route('payerCommande', $commande->id) }}"
                               class="btn btn-success btn-sm"
                               onclick="return confirm('Confirmer le paiement en espèces ?')">
                                 Encaisser
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucune commande trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $commandes->links() }}

@endsection
