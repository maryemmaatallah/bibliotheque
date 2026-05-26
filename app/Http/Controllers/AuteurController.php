<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    public function index()
    {
        $auteurs = Auteur::all();
        return view('auteurs.index', compact('auteurs'));
    }

    public function create()
    {
        return view('auteurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'nationalite' => 'nullable',
            'biographie' => 'nullable',
        ]);

        Auteur::create($request->all());
        return redirect()->route('auteurs.index')
            ->with('success', 'Auteur ajouté avec succès !');
    }

    public function edit(Auteur $auteur)
    {
        return view('auteurs.edit', compact('auteur'));
    }

    public function update(Request $request, Auteur $auteur)
    {
        $request->validate([
            'nom' => 'required',
        ]);

        $auteur->update($request->all());
        return redirect()->route('auteurs.index')
            ->with('success', 'Auteur modifié avec succès !');
    }

    public function destroy(Auteur $auteur)
    {
        $auteur->delete();
        return redirect()->route('auteurs.index')
            ->with('success', 'Auteur supprimé avec succès !');
    }

    public function show(Auteur $auteur)
    {
        return view('auteurs.show', compact('auteur'));
    }
}
