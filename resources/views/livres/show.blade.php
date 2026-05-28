@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h2>{{ $livre->titre }}</h2>
        <p><strong>✍️ Auteur :</strong> {{ $livre->auteur->nom }}</p>
        <p><strong>📂 Catégorie :</strong> {{ $livre->categorie->nom ?? 'Non définie' }}</p>
        <p><strong>📝 Description :</strong> {{ $livre->description }}</p>
        <p><strong>📦 Stock :</strong>
            @if($livre->stock > 0)
            <span class="badge bg-success">{{ $livre->stock }} disponible(s)</span>
            @else
            <span class="badge bg-danger">Indisponible</span>
            @endif
        </p>
        @if($livre->avis->count() > 0)
        <p><strong>⭐ Note moyenne :</strong>
            {{ number_format($livre->avis->avg('note'), 1) }}/5
            ({{ $livre->avis->count() }} avis)
        </p>
        @endif

        <!-- Bouton Favori uniquement pour les membres -->
        @if(Auth::user()->role !== 'admin')
        <form action="{{ route('favoris.store', $livre) }}" method="POST" style="display:inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger mt-2">❤️ Ajouter aux favoris</button>
        </form>
        @endif
    </div>
</div>

<!-- Formulaire avis uniquement pour les membres -->
@if(Auth::user()->role !== 'admin')
<div class="card mb-4">
    <div class="card-body">
        <h4>⭐ Donner un avis</h4>
        <form action="{{ route('avis.store', $livre) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Note</label>
                <select name="note" class="form-control" required>
                    <option value="1">⭐ 1</option>
                    <option value="2">⭐⭐ 2</option>
                    <option value="3">⭐⭐⭐ 3</option>
                    <option value="4">⭐⭐⭐⭐ 4</option>
                    <option value="5">⭐⭐⭐⭐⭐ 5</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Commentaire</label>
                <textarea name="commentaire" class="form-control" rows="3" placeholder="Votre commentaire..."></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Envoyer mon avis</button>
        </form>
    </div>
</div>
@endif

<!-- Liste des avis -->
<h4>💬 Avis des lecteurs</h4>
@forelse($livre->avis as $avis)
<div class="card mb-2">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <strong>👤 {{ $avis->user->name }}</strong>
            <span>
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= $avis->note ? '⭐' : '☆' }}
                @endfor
            </span>
        </div>
        <p class="mt-2">{{ $avis->commentaire }}</p>
        @if($avis->user_id == Auth::id())
        <form action="{{ route('avis.destroy', $avis) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">🗑 Supprimer</button>
        </form>
        @endif
    </div>
</div>
@empty
<p class="text-muted">Aucun avis pour ce livre.</p>
@endforelse

<a href="{{ route('livres.index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
