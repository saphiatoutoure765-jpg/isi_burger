<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    // Afficher le catalogue des burgers disponibles
    public function index(Request $request)
    {
        $query = Burger::where('archive', false)->where('stock', '>', 0);

        // Filtre par libellé
        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request['nom'] . '%');
        }

        // Filtre par prix max
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request['prix_max']);
        }

        $burgers = $query->paginate(8);

        return view('catalogue.index', ['burgers' => $burgers]);
    }

    // Voir les détails d'un burger
    public function show(string $id)
    {
        $burger = Burger::find($id);
        return view('catalogue.show', ['burger' => $burger]);
    }
}
