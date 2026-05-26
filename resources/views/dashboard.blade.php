@extends('layouts.app')

@section('content')
<h2>Bienvenue {{ Auth::user()->name }} ! 👋</h2>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body text-center">
                <h1>📚</h1>
                <h5 class="card-title">Livres</h5>
                <h2>{{ $totalLivres }}</h2>
                <a href="{{ route('livres.index') }}" class="btn btn-light btn-sm">Voir les livres</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body text-center">
                <h1>✍️</h1>
                <h5 class="card-title">Auteurs</h5>
                <h2>{{ $totalAuteurs }}</h2>
                <a href="{{ route('auteurs.index') }}" class="btn btn-light btn-sm">Voir les auteurs</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body text-center">
                <h1>📖</h1>
                <h5 class="card-title">Emprunts en cours</h5>
                <h2>{{ $totalEmprunts }}</h2>
                <a href="{{ route('emprunts.index') }}" class="btn btn-light btn-sm">Voir les emprunts</a>
            </div>
        </div>
    </div>
</div>
@endsection
