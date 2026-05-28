<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Auteur;
use App\Models\Categorie;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index(Request $request)
    {
        $livres = Livre::with('auteur', 'categorie')
            ->when($request->search, function($query) use ($request) {
                $query->where('titre', 'like', '%' . $request->search . '%');
            })
            ->get();
        return view('livres.index', compact('livres'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('livres.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'      => 'required',
            'stock'      => 'required|integer',
            'nom_auteur' => 'required',
        ]);

        $auteur = Auteur::firstOrCreate(['nom' => $request->nom_auteur]);

        Livre::create([
            'titre'        => $request->titre,
            'description'  => $request->description,
            'stock'        => $request->stock,
            'auteur_id'    => $auteur->id,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('livres.index')
            ->with('success', 'Livre ajouté avec succès !');
    }

    public function edit(Livre $livre)
    {
        $categories = Categorie::all();
        return view('livres.edit', compact('livre', 'categories'));
    }

    public function update(Request $request, Livre $livre)
    {
        $request->validate([
            'titre'      => 'required',
            'stock'      => 'required|integer',
            'nom_auteur' => 'required',
        ]);

        $auteur = Auteur::firstOrCreate(['nom' => $request->nom_auteur]);

        $livre->update([
            'titre'        => $request->titre,
            'description'  => $request->description,
            'stock'        => $request->stock,
            'auteur_id'    => $auteur->id,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('livres.index')
            ->with('success', 'Livre modifié avec succès !');
    }

    public function destroy(Livre $livre)
    {
        $livre->delete();
        return redirect()->route('livres.index')
            ->with('success', 'Livre supprimé avec succès !');
    }

    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }
}
