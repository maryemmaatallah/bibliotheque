@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <h1>👤</h1>
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <p class="text-muted">Membre depuis {{ $user->created_at->format('d/m/Y') }}</p>
                <a href="{{ route('profil.edit') }}" class="btn btn-primary btn-sm">✏️ Modifier le profil</a>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>📊 Mes statistiques</h5>
                <p>📖 Emprunts total : <strong>{{ $emprunts->count() }}</strong></p>
                <p>⏳ En cours : <strong>{{ $emprunts->where('statut', 'en cours')->count() }}</strong></p>
                <p>✅ Retournés : <strong>{{ $emprunts->where('statut', 'retourné')->count() }}</strong></p>
                <p>❤️ Favoris : <strong>{{ $favoris->count() }}</strong></p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Historique emprunts -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>📖 Historique des emprunts</h5>
                @forelse($emprunts as $emprunt)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div>
                        <strong>{{ $emprunt->livre->titre }}</strong>
                        <br>
                        <small class="text-muted">Emprunté le {{ $emprunt->date_emprunt }}</small>
                    </div>
                    @if($emprunt->statut == 'en cours')
                    <span class="badge bg-warning">En cours</span>
                    @else
                    <span class="badge bg-success">Retourné</span>
                    @endif
                </div>
                @empty
                <p class="text-muted">Aucun emprunt</p>
                @endforelse
            </div>
        </div>

        <!-- Favoris -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>❤️ Mes Favoris</h5>
                @forelse($favoris as $favori)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div>
                        <strong>{{ $favori->livre->titre }}</strong>
                        <br>
                        <small class="text-muted">✍️ {{ $favori->livre->auteur->nom }}</small>
                    </div>
                    <a href="{{ route('livres.show', $favori->livre) }}" class="btn btn-info btn-sm">👁 Voir</a>
                </div>
                @empty
                <p class="text-muted">Aucun favori</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
