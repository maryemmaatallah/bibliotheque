@extends('layouts.app')

@section('content')
<h2>Modifier un Livre</h2>

<form action="{{ route('livres.update', $livre) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" name="titre" class="form-control" value="{{ $livre->titre }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Genre</label>
        <input type="text" name="genre" class="form-control" value="{{ $livre->genre }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $livre->description }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" value="{{ $livre->stock }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nom de l'auteur</label>
        <input type="text" name="nom_auteur" class="form-control" value="{{ $livre->auteur->nom }}" required>
    </div>
    <button type="submit" class="btn btn-success">Modifier</button>
    <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
