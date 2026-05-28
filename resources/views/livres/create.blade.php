@extends('layouts.app')

@section('content')
<h2>➕ Ajouter un Livre</h2>

<form action="{{ route('admin.livres.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" name="titre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" value="1" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nom de l'auteur</label>
        <input type="text" name="nom_auteur" class="form-control" placeholder="Entrez le nom de l'auteur" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Catégorie</label>
        <select name="categorie_id" class="form-control">
            <option value="">-- Sans catégorie --</option>
            @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Enregistrer</button>
    <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
