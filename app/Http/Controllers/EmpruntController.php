<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpruntController extends Controller
{
    public function index()
    {
        $emprunts = Emprunt::with(['user', 'livre'])->get();
        return view('emprunts.index', compact('emprunts'));
    }

    public function create()
    {
        $livres = Livre::where('stock', '>', 0)->get();
        return view('emprunts.create', compact('livres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livre_id' => 'required|exists:livres,id',
            'date_emprunt' => 'required|date',
            'date_retour' => 'nullable|date',
        ]);

        Emprunt::create([
            'user_id' => Auth::id(),
            'livre_id' => $request->livre_id,
            'date_emprunt' => $request->date_emprunt,
            'date_retour' => $request->date_retour,
            'statut' => 'en cours',
        ]);

        // Réduire le stock du livre
        $livre = Livre::find($request->livre_id);
        $livre->stock -= 1;
        $livre->save();

        return redirect()->route('emprunts.index')
            ->with('success', 'Emprunt ajouté avec succès !');
    }

    public function show(Emprunt $emprunt)
    {
        return view('emprunts.show', compact('emprunt'));
    }

    public function edit(Emprunt $emprunt)
    {
        $livres = Livre::all();
        return view('emprunts.edit', compact('emprunt', 'livres'));
    }

    public function update(Request $request, Emprunt $emprunt)
    {
        $request->validate([
            'statut' => 'required',
            'date_retour' => 'nullable|date',
        ]);

        $emprunt->update($request->all());
        return redirect()->route('emprunts.index')
            ->with('success', 'Emprunt modifié avec succès !');
    }

    public function destroy(Emprunt $emprunt)
    {
        $emprunt->delete();
        return redirect()->route('emprunts.index')
            ->with('success', 'Emprunt supprimé avec succès !');
    }
}
