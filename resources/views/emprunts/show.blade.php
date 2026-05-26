@extends('layouts.app')

@section('content')
<h2>Détail de l'Emprunt</h2>

<div class="card">
    <div class="card-body">
        <p><strong>Membre :</strong> {{ $emprunt->user->name }}</p>
        <p><strong>Livre :</strong> {{ $emprunt->livre->titre }}</p>
        <p><strong>Date d'emprunt :</strong> {{ $emprunt->date_emprunt }}</p>
        <p><strong>Date de retour :</strong> {{ $emprunt->date_retour ?? 'Non définie' }}</p>
        <p><strong>Statut :</strong>
            @if($emprunt->statut == 'en cours')
            <span class="badge bg-warning">En cours</span>
            @else
            <span class="badge bg-success">Retourné</span>
            @endif
        </p>
    </div>
</div>

<a href="{{ route('emprunts.index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
