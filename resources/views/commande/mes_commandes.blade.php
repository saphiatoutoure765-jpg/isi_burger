@extends('template')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2> Mes Commandes</h2>
        <a href="{{ route('commander') }}" class="btn btn-warning">
             Nouvelle commande
        </a>
    </div>

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>N° Commande</th>
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
                        @if(in_array($commande->statut, ['prete', 'payee']))
                            <a href="{{ route('maFacture', $commande->id) }}"
                               class="btn btn-success btn-sm">
                                 Télécharger facture
                            </a>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Vous n'avez pas encore de commande.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $commandes->links() }}

@endsection
