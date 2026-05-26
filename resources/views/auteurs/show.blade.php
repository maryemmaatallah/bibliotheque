@extends('layouts.app')

@section('content')
<h2>Détail de l'Auteur</h2>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $auteur->nom }}</h5>
        <p><strong>Nationalité :</strong> {{ $auteur->nationalite }}</p>
        <p><strong>Biographie :</strong> {{ $auteur->biographie }}</p>
    </div>
</div>

<a href="{{ route('auteurs.index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
