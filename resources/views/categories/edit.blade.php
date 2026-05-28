@extends('layouts.app')

@section('content')
<h2>✏️ Modifier une Catégorie</h2>

<form action="{{ route('admin.categories.update', $categorie) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ $categorie->nom }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $categorie->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Modifier</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
