<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BurgerController extends Controller
{
    // Afficher la liste des burgers (gestionnaire)
    public function index()
    {
        $burgers = Burger::paginate(8);
        return view('burger.index', ['burgers' => $burgers]);
    }

    // Afficher le formulaire d'ajout
    public function create()
    {
        return view('burger.add');
    }

    // Enregistrer un burger
    public function store(Request $request)
    {
        $burger = new Burger();
        $burger->nom         = $request['nom'];
        $burger->prix        = $request['prix'];
        $burger->description = $request['description'];
        $burger->stock       = $request['stock'];
        $burger->archive     = false;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('burgers', 'public');
            $burger->image = $imagePath;
        }

        $burger->save();

        return to_route('burgers');
    }

    // Afficher le formulaire de modification
    public function edit(string $id)
    {
        $burger = Burger::find($id);
        return view('burger.edit', ['burger' => $burger]);
    }

    // Mettre à jour un burger
    public function update(Request $request, string $id)
    {
        $burger = Burger::find($id);
        $burger->nom         = $request['nom'];
        $burger->prix        = $request['prix'];
        $burger->description = $request['description'];
        $burger->stock       = $request['stock'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('burgers', 'public');
            $burger->image = $imagePath;
        }

        $burger->save();

        return to_route('burgers');
    }

    // Archiver un burger
    public function archiver(string $id)
    {
        $burger = Burger::find($id);
        $burger->archive = !$burger->archive;
        $burger->save();

        return to_route('burgers');
    }

    // Supprimer un burger
    public function destroy(string $id)
    {
        $burger = Burger::find($id);
        $burger->delete();

        return to_route('burgers');
    }
}
