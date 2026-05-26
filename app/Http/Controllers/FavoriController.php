<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriController extends Controller
{
    public function index()
    {
        $favoris = Favori::with('livre.auteur')
            ->where('user_id', Auth::id())
            ->get();
        return view('favoris.index', compact('favoris'));
    }

    public function store(Livre $livre)
    {
        $existingFavori = Favori::where('user_id', Auth::id())
            ->where('livre_id', $livre->id)
            ->first();

        if (!$existingFavori) {
            Favori::create([
                'user_id' => Auth::id(),
                'livre_id' => $livre->id,
            ]);
            return back()->with('success', 'Livre ajouté aux favoris !');
        }

        return back()->with('info', 'Ce livre est déjà dans vos favoris !');
    }

    public function destroy(Favori $favori)
    {
        $favori->delete();
        return back()->with('success', 'Livre retiré des favoris !');
    }
}
