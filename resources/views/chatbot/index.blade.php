@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>🤖 Assistant Bibliothèque</h2>
        <p class="text-muted">Posez vos questions sur les livres, les emprunts, les disponibilités...</p>

        <!-- Zone de chat -->
        <div id="chat-box" class="border rounded p-3 mb-3" style="height: 400px; overflow-y: auto; background: #f8f9fa;">
            <div class="mb-3">
                <div class="bg-primary text-white p-2 rounded" style="max-width: 80%;">
                    👋 Bonjour ! Je suis l'assistant de la bibliothèque. Comment puis-je vous aider ?
                </div>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="input-group">
            <input type="text" id="user-input" class="form-control"
                   placeholder="Ex: Quels livres sont disponibles ?" />
            <button class="btn btn-primary" onclick="sendMessage()">
                Envoyer 📤
            </button>
        </div>

        <!-- Questions suggérées -->
        <div class="mt-3">
            <small class="text-muted">Questions suggérées :</small>
            <div class="mt-1">
                <button class="btn btn-outline-secondary btn-sm me-1 mb-1"
                        onclick="setQuestion('Quels livres sont disponibles ?')">
                    Livres disponibles
                </button>
                <button class="btn btn-outline-secondary btn-sm me-1 mb-1"
                        onclick="setQuestion('Combien de livres y a-t-il dans la bibliothèque ?')">
                    Nombre de livres
                </button>
                <button class="btn btn-outline-secondary btn-sm me-1 mb-1"
                        onclick="setQuestion('Quels sont les emprunts en cours ?')">
                    Emprunts en cours
                </button>
                <button class="btn btn-outline-secondary btn-sm me-1 mb-1"
                        onclick="setQuestion('Quels livres sont indisponibles ?')">
                    Livres indisponibles
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function sendMessage() {
        const input = document.getElementById('user-input');
        const message = input.value.trim();
        if (!message) return;

        // Afficher le message utilisateur
        appendMessage(message, 'user');
        input.value = '';

        // Afficher indicateur de chargement
        appendMessage('⏳ En train de réfléchir...', 'bot', 'loading');

        // Envoyer au serveur
        fetch('{{ route("chatbot.ask") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
            .then(res => res.json())
            .then(data => {
                // Supprimer indicateur de chargement
                document.getElementById('loading').remove();
                // Afficher la réponse
                appendMessage(data.reply, 'bot');
            })
            .catch(err => {
                document.getElementById('loading').remove();
                appendMessage('❌ Erreur de connexion.', 'bot');
            });
    }

    function appendMessage(text, sender, id = '') {
        const chatBox = document.getElementById('chat-box');
        const div = document.createElement('div');
        div.className = 'mb-3 d-flex ' + (sender === 'user' ? 'justify-content-end' : '');
        if (id) div.id = id;

        const bubble = document.createElement('div');
        bubble.className = sender === 'user'
            ? 'bg-success text-white p-2 rounded'
            : 'bg-primary text-white p-2 rounded';
        bubble.style.maxWidth = '80%';
        bubble.style.whiteSpace = 'pre-wrap';
        bubble.textContent = text;

        div.appendChild(bubble);
        chatBox.appendChild(div);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function setQuestion(question) {
        document.getElementById('user-input').value = question;
        sendMessage();
    }

    // Envoyer avec la touche Entrée
    document.getElementById('user-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });
</script>
@endsection
