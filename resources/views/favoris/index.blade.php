@extends('layouts.app')

@section('content')
<h2>❤️ Mes Favoris</h2>

<div class="row mt-4">
    @forelse($favoris as $favori)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $favori->livre->titre }}</h5>
                <p class="text-muted">✍️ {{ $favori->livre->auteur->nom }}</p>
                <p>{{ $favori->livre->description }}</p>
                @if($favori->livre->stock > 0)
                <span class="badge bg-success">Disponible</span>
                @else
                <span class="badge bg-danger">Indisponible</span>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('livres.show', $favori->livre) }}" class="btn btn-info btn-sm">👁 Voir</a>
                <form action="{{ route('favoris.destroy', $favori) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">🗑 Retirer</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p class="text-center text-muted">Vous n'avez pas encore de favoris 😊</p>
        <div class="text-center">
            <a href="{{ route('livres.index') }}" class="btn btn-primary">Parcourir les livres</a>
        </div>
    </div>
    @endforelse
</div>
@endsection
