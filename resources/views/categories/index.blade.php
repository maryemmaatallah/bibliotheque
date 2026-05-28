@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📂 Catégories</h2>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Ajouter</a>
    @endif
</div>

<div class="row">
    @forelse($categories as $categorie)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <h1>📚</h1>
                <h5 class="card-title">{{ $categorie->nom }}</h5>
                <p class="text-muted">{{ $categorie->description }}</p>
                <span class="badge bg-primary">{{ $categorie->livres_count }} livre(s)</span>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('categories.show', $categorie) }}" class="btn btn-info btn-sm">👁 Voir</a>
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.categories.edit', $categorie) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
                <form action="{{ route('admin.categories.destroy', $categorie) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">🗑</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p class="text-center text-muted">Aucune catégorie trouvée</p>
    </div>
    @endforelse
</div>
@endsection
