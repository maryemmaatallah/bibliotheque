<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Auteur;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index(Request $request)
    {
        $livres = Livre::with('auteur')
            ->when($request->search, function($query) use ($request) {
                $query->where('titre', 'like', '%' . $request->search . '%');
            })
            ->get();
        return view('livres.index', compact('livres'));
    }
    public function create()
    {
        $categories = \App\Models\Categorie::all();
        return view('livres.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'genre' => 'required',
            'stock' => 'required|integer',
            'nom_auteur' => 'required',
        ]);

        $auteur = Auteur::firstOrCreate(['nom' => $request->nom_auteur]);

        Livre::create([
            'titre' => $request->titre,
            'genre' => $request->genre,
            'description' => $request->description,
            'stock' => $request->stock,
            'auteur_id' => $auteur->id,
        ]);

        return redirect()->route('livres.index')
            ->with('success', 'Livre ajouté avec succès !');
    }

    public function edit(Livre $livre)
    {
        return view('livres.edit', compact('livre'));
    }

    public function update(Request $request, Livre $livre)
    {
        $request->validate([
            'titre' => 'required',
            'genre' => 'required',
            'stock' => 'required|integer',
            'nom_auteur' => 'required',
        ]);

        $auteur = Auteur::firstOrCreate(['nom' => $request->nom_auteur]);

        $livre->update([
            'titre' => $request->titre,
            'genre' => $request->genre,
            'description' => $request->description,
            'stock' => $request->stock,
            'auteur_id' => $auteur->id,
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
