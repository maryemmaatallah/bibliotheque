<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use App\Models\Avis;
use App\Models\Livre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Liste des favoris avec utilisateurs
    public function favoris()
    {
        $favoris = Favori::with('user', 'livre')
            ->orderBy('created_at', 'desc')
            ->get();

        // Grouper par livre
        $livresAvecFavoris = Livre::withCount('favoris')
            ->having('favoris_count', '>', 0)
            ->with(['favoris.user'])
            ->get();

        return view('admin.favoris', compact('livresAvecFavoris'));
    }

    // Liste des avis avec possibilité de supprimer
    public function avis()
    {
        $avis = Avis::with('user', 'livre')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.avis', compact('avis'));
    }

    // Supprimer un avis
    public function destroyAvis(Avis $avi)
    {
        $avi->delete();
        return back()->with('success', 'Avis supprimé avec succès !');
    }
}
