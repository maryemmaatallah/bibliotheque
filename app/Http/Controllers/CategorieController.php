<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('livres')
            ->with('livres')
            ->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
        ]);

        Categorie::create($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie ajoutée avec succès !');
    }

    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'nom' => 'required',
        ]);

        $categorie->update($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie modifiée avec succès !');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès !');
    }

    public function show(Categorie $categorie)
    {
        $livres = $categorie->livres()->with('auteur')->get();
        return view('categories.show', compact('categorie', 'livres'));
    }
}
