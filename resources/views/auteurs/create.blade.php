@extends('layouts.app')

@section('content')
<h2>Ajouter un Auteur</h2>

<form action="{{ route('admin.auteurs.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nationalité</label>
        <input type="text" name="nationalite" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Biographie</label>
        <textarea name="biographie" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Enregistrer</button>
    <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
