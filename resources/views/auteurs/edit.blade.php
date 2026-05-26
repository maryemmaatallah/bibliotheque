@extends('layouts.app')

@section('content')
<h2>Modifier un Auteur</h2>

<form action="{{ route('auteurs.update', $auteur) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ $auteur->nom }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nationalité</label>
        <input type="text" name="nationalite" class="form-control" value="{{ $auteur->nationalite }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Biographie</label>
        <textarea name="biographie" class="form-control" rows="3">{{ $auteur->biographie }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Modifier</button>
    <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
