@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Liste des Auteurs</h2>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.auteurs.create') }}" class="btn btn-primary">+ Ajouter</a>
    @endif
</div>

<table class="table table-bordered">
    <thead class="table-dark">
    <tr>
        <th>Nom</th>
        <th>Nationalité</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($auteurs as $auteur)
    <tr>
        <td>{{ $auteur->nom }}</td>
        <td>{{ $auteur->nationalite }}</td>
        <td>
            <a href="{{ route('auteurs.show', $auteur) }}" class="btn btn-info btn-sm">👁 Voir</a>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.auteurs.edit', $auteur) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
            <form action="{{ route('admin.auteurs.destroy', $auteur) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">🗑</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
