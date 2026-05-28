@extends('layouts.app')

@section('content')
<h2>❤️ Gestion des Favoris</h2>
<p class="text-muted">Liste des livres mis en favoris par les membres</p>

<div class="row mt-4">
    @forelse($livresAvecFavoris as $livre)
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white d-flex justify-content-between">
                <strong>📚 {{ $livre->titre }}</strong>
                <span class="badge bg-white text-danger">❤️ {{ $livre->favoris_count }} favori(s)</span>
            </div>
            <div class="card-body">
                <h6>👥 Membres qui ont mis ce livre en favori :</h6>
                <ul class="list-group list-group-flush">
                    @foreach($livre->favoris as $favori)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>👤 {{ $favori->user->name }}</span>
                        <span class="text-muted small">{{ $favori->created_at->format('d/m/Y') }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p class="text-center text-muted">Aucun livre en favori pour le moment</p>
    </div>
    @endforelse
</div>
@endsection
