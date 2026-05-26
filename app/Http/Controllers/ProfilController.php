<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Emprunt;
use App\Models\Favori;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $emprunts = Emprunt::with('livre')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $favoris = Favori::with('livre.auteur')
            ->where('user_id', $user->id)
            ->get();

        return view('profil.index', compact('user', 'emprunts', 'favoris'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profil.index')
            ->with('success', 'Profil mis à jour avec succès !');
    }
}
