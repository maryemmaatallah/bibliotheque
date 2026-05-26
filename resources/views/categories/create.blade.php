@extends('layouts.app')

@section('content')
<h2>➕ Ajouter une Catégorie</h2>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" placeholder="Ex: Roman, Informatique..." required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Description de la catégorie..."></textarea>
    </div>
    <button type="submit" class="btn btn-success">Enregistrer</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
