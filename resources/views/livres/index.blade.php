@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📚 Liste des Livres</h2>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.livres.create') }}" class="btn btn-primary">+ Ajouter</a>
    @endif
</div>

<!-- Barre de recherche -->
<form action="{{ route('livres.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control"
               placeholder="Rechercher un livre par titre..."
               value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">🔍 Rechercher</button>
        @if(request('search'))
        <a href="{{ route('livres.index') }}" class="btn btn-secondary">✖ Effacer</a>
        @endif
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
    <tr>
        <th>Titre</th>
        <th>Catégorie</th>
        <th>Auteur</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($livres as $livre)
    <tr>
        <td>{{ $livre->titre }}</td>
        <td>{{ $livre->categorie->nom ?? 'Non définie' }}</td>
        <td>{{ $livre->auteur->nom }}</td>
        <td>
            @if($livre->stock > 0)
            <span class="badge bg-success">{{ $livre->stock }} disponible(s)</span>
            @else
            <span class="badge bg-danger">Indisponible</span>
            @endif
        </td>
        <td>
            <a href="{{ route('livres.show', $livre) }}" class="btn btn-info btn-sm">👁 Voir</a>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.livres.edit', $livre) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
            <form action="{{ route('admin.livres.destroy', $livre) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">🗑</button>
            </form>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Aucun livre trouvé</td>
    </tr>
    @endforelse
    </tbody>
</table>
@endsection
