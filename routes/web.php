<?php

use App\Http\Controllers\AuteurController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\LivreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ChatbotController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $totalLivres = \App\Models\Livre::count();
        $totalAuteurs = \App\Models\Auteur::count();
        $totalEmprunts = \App\Models\Emprunt::where('statut', 'en cours')->count();
        return view('dashboard', compact('totalLivres', 'totalAuteurs', 'totalEmprunts'));
    })->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');
    Route::resource('livres', LivreController::class);
    Route::resource('auteurs', AuteurController::class);
    Route::resource('emprunts', EmpruntController::class);
    Route::resource('categories', CategorieController::class);
    Route::post('/livres/{livre}/avis', [AvisController::class, 'store'])->name('avis.store');
    Route::delete('/avis/{avi}', [AvisController::class, 'destroy'])->name('avis.destroy');
    Route::get('/favoris', [FavoriController::class, 'index'])->name('favoris.index');
    Route::post('/favoris/{livre}', [FavoriController::class, 'store'])->name('favoris.store');
    Route::delete('/favoris/{favori}', [FavoriController::class, 'destroy'])->name('favoris.destroy');
});

require __DIR__.'/auth.php';
