<?php

namespace Tests\Feature;

use App\Models\Auteur;
use App\Models\Livre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivreFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_utilisateur_peut_voir_liste_livres(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/livres');

        $response->assertStatus(200);
    }

    public function test_utilisateur_peut_voir_formulaire_ajout_livre(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/livres/create');

        $response->assertStatus(200);
    }

    public function test_utilisateur_peut_ajouter_livre(): void
    {
        $user = User::factory()->create();

        $auteur = Auteur::create([
            'nom' => 'Victor Hugo',
            'nationalite' => 'Française',
        ]);

        $response = $this->actingAs($user)->post('/livres', [
            'titre' => 'Les Misérables',
            'genre' => 'Roman',
            'stock' => 3,
            'nom_auteur' => 'Victor Hugo',
        ]);

        $response->assertRedirect('/livres');
        $this->assertDatabaseHas('livres', ['titre' => 'Les Misérables']);
    }

    public function test_utilisateur_non_connecte_redirige_vers_login(): void
    {
        $response = $this->get('/livres');
        $response->assertRedirect('/login');
    }
}
