<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Emprunt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Récupérer les données métier
        $livres = Livre::with('auteur', 'categorie')->get();
        $livresInfo = $livres->map(function($livre) {
            return "- {$livre->titre} par {$livre->auteur->nom}, genre: {$livre->genre}, stock: {$livre->stock}";
        })->join("\n");

        $emprunts = Emprunt::with('livre', 'user')
            ->where('statut', 'en cours')
            ->get();
        $empruntsInfo = $emprunts->map(function($emprunt) {
            return "- {$emprunt->livre->titre} emprunté par {$emprunt->user->name} le {$emprunt->date_emprunt}";
        })->join("\n");

        // Construire le prompt
        $prompt = "Tu es l'assistant intelligent de la Bibliothèque Numérique.
Tu dois répondre aux questions des utilisateurs en te basant sur les données réelles de la bibliothèque.
Réponds toujours en français de manière claire et concise.

Voici les livres disponibles dans la bibliothèque :
{$livresInfo}

Voici les emprunts en cours :
{$empruntsInfo}

Question de l'utilisateur : {$request->message}";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'max_tokens' => 500,
            ]);

            $data = $response->json();

            if (isset($data['choices'][0]['message']['content'])) {
                $reply = $data['choices'][0]['message']['content'];
            } else {
                $reply = 'Erreur API : ' . json_encode($data);
            }

        } catch (\Exception $e) {
            $reply = 'Erreur de connexion : ' . $e->getMessage();
        }

        return response()->json(['reply' => $reply]);
    }
}
