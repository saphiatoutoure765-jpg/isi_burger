<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // Commandes en cours du jour
        $commandesEnCours = Commande::whereDate('created_at', $today)
            ->whereIn('statut', ['en_attente', 'en_preparation'])
            ->count();

        // Commandes validées du jour (prête ou payée)
        $commandesValidees = Commande::whereDate('created_at', $today)
            ->whereIn('statut', ['prete', 'payee'])
            ->count();

        // Recettes journalières
        $recettesJour = Paiement::whereDate('date_paiement', $today)->sum('montant');

        // Nombre de commandes par mois (pour Chart JS)
        $commandesParMois = Commande::select(
            DB::raw('EXTRACT(MONTH FROM created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        return view('dashboard', [
            'commandesEnCours'   => $commandesEnCours,
            'commandesValidees'  => $commandesValidees,
            'recettesJour'       => $recettesJour,
            'commandesParMois'   => $commandesParMois,
        ]);
    }
}
