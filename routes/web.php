<?php

use App\Http\Controllers\AuteurController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return view('welcome');
});

// Routes pour tous les utilisateurs connectés
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $totalLivres = \App\Models\Livre::count();
        $totalAuteurs = \App\Models\Auteur::count();
        $totalEmprunts = \App\Models\Emprunt::where('statut', 'en cours')->count();
        return view('dashboard', compact('totalLivres', 'totalAuteurs', 'totalEmprunts'));
    })->name('dashboard');

    // Livres (lecture pour tous)
    Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
    Route::get('/livres/{livre}', [LivreController::class, 'show'])->name('livres.show');

    // Auteurs (lecture pour tous)
    Route::get('/auteurs', [AuteurController::class, 'index'])->name('auteurs.index');
    Route::get('/auteurs/{auteur}', [AuteurController::class, 'show'])->name('auteurs.show');

    // Catégories (lecture pour tous)
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');

    // Emprunts
    Route::resource('emprunts', EmpruntController::class);

    // Avis
    Route::post('/livres/{livre}/avis', [AvisController::class, 'store'])->name('avis.store');
    Route::delete('/avis/{avi}', [AvisController::class, 'destroy'])->name('avis.destroy');

    // Favoris
    Route::get('/favoris', [FavoriController::class, 'index'])->name('favoris.index');
    Route::post('/favoris/{livre}', [FavoriController::class, 'store'])->name('favoris.store');
    Route::delete('/favoris/{favori}', [FavoriController::class, 'destroy'])->name('favoris.destroy');

    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Chatbot
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');
});

// Routes Admin uniquement
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Gestion livres
    Route::get('/livres/create', [LivreController::class, 'create'])->name('livres.create');
    Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
    Route::get('/livres/{livre}/edit', [LivreController::class, 'edit'])->name('livres.edit');
    Route::put('/livres/{livre}', [LivreController::class, 'update'])->name('livres.update');
    Route::delete('/livres/{livre}', [LivreController::class, 'destroy'])->name('livres.destroy');

    // Gestion auteurs
    Route::get('/auteurs/create', [AuteurController::class, 'create'])->name('auteurs.create');
    Route::post('/auteurs', [AuteurController::class, 'store'])->name('auteurs.store');
    Route::get('/auteurs/{auteur}/edit', [AuteurController::class, 'edit'])->name('auteurs.edit');
    Route::put('/auteurs/{auteur}', [AuteurController::class, 'update'])->name('auteurs.update');
    Route::delete('/auteurs/{auteur}', [AuteurController::class, 'destroy'])->name('auteurs.destroy');

    // Gestion catégories
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    // Favoris et Avis Admin
    Route::get('/favoris', [AdminController::class, 'favoris'])->name('favoris');
    Route::get('/avis', [AdminController::class, 'avis'])->name('avis');
    Route::delete('/avis/{avi}', [AdminController::class, 'destroyAvis'])->name('avis.destroy.admin');
});

require __DIR__.'/auth.php';
