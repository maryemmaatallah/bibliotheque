@extends('layouts.app')

@section('content')
<h2>⭐ Gestion des Avis</h2>
<p class="text-muted">Liste de tous les avis — vous pouvez supprimer les commentaires inappropriés</p>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead class="table-dark">
    <tr>
        <th>Membre</th>
        <th>Livre</th>
        <th>Note</th>
        <th>Commentaire</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse($avis as $avi)
    <tr>
        <td>👤 {{ $avi->user->name }}</td>
        <td>📚 {{ $avi->livre->titre }}</td>
        <td>
            @for($i = 1; $i <= 5; $i++)
            {{ $i <= $avi->note ? '⭐' : '☆' }}
            @endfor
        </td>
        <td>{{ $avi->commentaire ?? 'Aucun commentaire' }}</td>
        <td>{{ $avi->created_at->format('d/m/Y') }}</td>
        <td>
            <form action="{{ route('admin.avis.destroy.admin', $avi) }}" method="POST">                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet avis ?')">
                    🗑 Supprimer
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center text-muted">Aucun avis pour le moment</td>
    </tr>
    @endforelse
    </tbody>
</table>
@endsection
