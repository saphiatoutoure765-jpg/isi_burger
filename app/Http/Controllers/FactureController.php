<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactureController extends Controller
{
    // Télécharger la facture PDF d'une commande
    public function telecharger(string $id)
    {
        $commande = Commande::with(['user', 'lignesCommande.burger'])->find($id);

        // Un client ne peut voir que ses propres factures
        if (Auth::user()->isClient() && $commande->user_id !== Auth::id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('facture.pdf', ['commande' => $commande]);

        return $pdf->download('facture_commande_' . $commande->id . '.pdf');
    }
}
