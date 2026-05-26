<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Livre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request, Livre $livre)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
        ]);

        // Vérifier si l'utilisateur a déjà donné un avis
        $existingAvis = Avis::where('user_id', Auth::id())
            ->where('livre_id', $livre->id)
            ->first();

        if ($existingAvis) {
            $existingAvis->update([
                'note' => $request->note,
                'commentaire' => $request->commentaire,
            ]);
        } else {
            Avis::create([
                'user_id' => Auth::id(),
                'livre_id' => $livre->id,
                'note' => $request->note,
                'commentaire' => $request->commentaire,
            ]);
        }

        return redirect()->route('livres.show', $livre)
            ->with('success', 'Votre avis a été enregistré !');
    }

    public function destroy(Avis $avi)
    {
        $avi->delete();
        return back()->with('success', 'Avis supprimé !');
    }
}
