@extends('layouts.app')

@section('content')
<h2>✏️ Modifier un Livre</h2>

<form action="{{ route('admin.livres.update', $livre) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" name="titre" class="form-control" value="{{ $livre->titre }}" required>
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
    <div class="mb-3">
        <label class="form-label">Catégorie</label>
        <select name="categorie_id" class="form-control">
            <option value="">-- Sans catégorie --</option>
            @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}" {{ $livre->categorie_id == $categorie->id ? 'selected' : '' }}>
                {{ $categorie->nom }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Modifier</button>
    <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
