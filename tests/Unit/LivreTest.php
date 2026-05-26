<?php

namespace Tests\Unit;

use App\Models\Livre;
use App\Models\Auteur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivreTest extends TestCase
{
    use RefreshDatabase;

    public function test_livre_est_disponible_si_stock_positif(): void
    {
        $auteur = Auteur::create([
            'nom' => 'Victor Hugo',
            'nationalite' => 'Française',
        ]);

        $livre = Livre::create([
            'titre' => 'Les Misérables',
            'genre' => 'Roman',
            'stock' => 5,
            'auteur_id' => $auteur->id,
        ]);

        $this->assertTrue($livre->stock > 0);
    }

    public function test_livre_est_indisponible_si_stock_zero(): void
    {
        $auteur = Auteur::create([
            'nom' => 'Victor Hugo',
            'nationalite' => 'Française',
        ]);

        $livre = Livre::create([
            'titre' => 'Les Misérables',
            'genre' => 'Roman',
            'stock' => 0,
            'auteur_id' => $auteur->id,
        ]);

        $this->assertTrue($livre->stock == 0);
    }

    public function test_livre_a_un_titre(): void
    {
        $auteur = Auteur::create([
            'nom' => 'Victor Hugo',
            'nationalite' => 'Française',
        ]);

        $livre = Livre::create([
            'titre' => 'Les Misérables',
            'genre' => 'Roman',
            'stock' => 3,
            'auteur_id' => $auteur->id,
        ]);

        $this->assertEquals('Les Misérables', $livre->titre);
    }
}
