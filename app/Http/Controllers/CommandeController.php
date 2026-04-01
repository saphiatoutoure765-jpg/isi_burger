<?php

namespace App\Http\Controllers;

use App\Mail\CommandeConfirmation;
use App\Mail\FacturePrete;
use App\Models\Burger;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    // ===== CÔTÉ CLIENT =====

    // Afficher les commandes du client connecté
    public function mesCommandes()
    {
        $commandes = Commande::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('commande.mes_commandes', ['commandes' => $commandes]);
    }

    // Afficher le formulaire de commande
    public function create()
    {
        $burgers = Burger::where('archive', false)->where('stock', '>', 0)->get();
        return view('commande.create', ['burgers' => $burgers]);
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        $montantTotal = 0;

        // Créer la commande
        $commande = new Commande();
        $commande->user_id      = Auth::id();
        $commande->statut       = 'en_attente';
        $commande->montant_total = 0;
        $commande->save();

        // Ajouter les lignes de commande
        foreach ($request['burgers'] as $burgerId => $quantite) {
            if ($quantite > 0) {
                $burger = Burger::find($burgerId);

                $ligne = new LigneCommande();
                $ligne->commande_id   = $commande->id;
                $ligne->burger_id     = $burgerId;
                $ligne->quantite      = $quantite;
                $ligne->prix_unitaire = $burger->prix;
                $ligne->save();

                $montantTotal += $burger->prix * $quantite;

                // Décrémenter le stock
                $burger->stock -= $quantite;
                $burger->save();
            }
        }

        // Mettre à jour le montant total
        $commande->montant_total = $montantTotal;
        $commande->save();

        // Envoyer email de confirmation
        Mail::to(Auth::user()->email)->send(new CommandeConfirmation($commande));

        return to_route('mesCommandes');
    }

    // ===== CÔTÉ GESTIONNAIRE =====

    // Lister toutes les commandes
    public function index()
    {
        $commandes = Commande::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('commande.index', ['commandes' => $commandes]);
    }

    // Voir les détails d'une commande
    public function show(string $id)
    {
        $commande = Commande::with(['user', 'lignesCommande.burger'])->find($id);
        return view('commande.show', ['commande' => $commande]);
    }

    // Annuler une commande
    public function annuler(string $id)
    {
        $commande = Commande::find($id);
        $commande->statut = 'annulee';
        $commande->save();

        return to_route('commandes');
    }

    // Modifier le statut d'une commande
    public function updateStatut(Request $request, string $id)
    {
        $commande = Commande::with(['user', 'lignesCommande.burger'])->find($id);
        $commande->statut = $request['statut'];
        $commande->save();

        // Si la commande est prête → envoyer la facture PDF par email
        if ($request['statut'] === 'prete') {
            Mail::to($commande->user->email)->send(new FacturePrete($commande));
        }

        return to_route('commandes');
    }

    // Enregistrer un paiement (gestionnaire)
    public function payer(string $id)
    {
        $commande = Commande::find($id);

        // Vérifier qu'il n'y a pas déjà un paiement
        if ($commande->paiement) {
            return to_route('commandes');
        }

        $paiement = new Paiement();
        $paiement->commande_id   = $commande->id;
        $paiement->montant       = $commande->montant_total;
        $paiement->date_paiement = now();
        $paiement->save();

        $commande->statut = 'payee';
        $commande->save();

        return to_route('commandes');
    }
}
