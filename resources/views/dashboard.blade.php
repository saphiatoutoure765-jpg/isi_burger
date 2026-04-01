@extends('template')

@section('content')

    <h2> Dashboard - ISI Burger</h2>
    <hr>

    {{-- Statistiques du jour --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body text-center">
                    <h3>{{ $commandesEnCours }}</h3>
                    <p class="mb-0">Commandes en cours aujourd'hui</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body text-center">
                    <h3>{{ $commandesValidees }}</h3>
                    <p class="mb-0">Commandes validées aujourd'hui</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body text-center">
                    <h3>{{ number_format($recettesJour, 0, ',', ' ') }} FCFA</h3>
                    <p class="mb-0">Recettes journalières</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Graphique commandes par mois --}}
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Nombre de commandes par mois ({{ now()->year }})
                </div>
                <div class="card-body">
                    <canvas id="chartCommandes"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Actions rapides
                </div>
                <div class="card-body">
                    <a href="{{ route('burgers') }}" class="btn btn-outline-warning w-100 mb-2">
                         Gérer les Burgers
                    </a>
                    <a href="{{ route('commandes') }}" class="btn btn-outline-success w-100 mb-2">
                         Voir les Commandes
                    </a>
                    <a href="{{ route('addBurger') }}" class="btn btn-warning w-100">
                         Ajouter un Burger
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const moisLabels = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];

    // Préparer les données depuis Laravel
    const commandesData = @json($commandesParMois);
    const totaux = Array(12).fill(0);
    commandesData.forEach(function(item) {
        totaux[item.mois - 1] = item.total;
    });

    const ctx = document.getElementById('chartCommandes').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: moisLabels,
            datasets: [{
                label: 'Nombre de commandes',
                data: totaux,
                backgroundColor: 'rgba(255, 107, 53, 0.7)',
                borderColor: '#ff6b35',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
