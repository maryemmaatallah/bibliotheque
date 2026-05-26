@extends('layouts.app')

@section('content')
<h2>📂 {{ $categorie->nom }}</h2>
<p class="text-muted">{{ $categorie->description }}</p>

<hr>

<h4>📚 Livres dans cette catégorie</h4>

<div class="row mt-3">
    @forelse($livres as $livre)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $livre->titre }}</h5>
                <p class="text-muted">✍️ {{ $livre->auteur->nom }}</p>
                <p>{{ $livre->description }}</p>
                @if($livre->stock > 0)
                <span class="badge bg-success">{{ $livre->stock }} disponible(s)</span>
                @else
                <span class="badge bg-danger">Indisponible</span>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('livres.show', $livre) }}" class="btn btn-info btn-sm">👁 Voir</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p class="text-center text-muted">Aucun livre dans cette catégorie</p>
    </div>
    @endforelse
</div>

<a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
