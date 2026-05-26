@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Liste des Emprunts</h2>
    <a href="{{ route('emprunts.create') }}" class="btn btn-primary">+ Nouvel Emprunt</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
    <tr>
        <th>Membre</th>
        <th>Livre</th>
        <th>Date Emprunt</th>
        <th>Date Retour</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($emprunts as $emprunt)
    <tr>
        <td>{{ $emprunt->user->name }}</td>
        <td>{{ $emprunt->livre->titre }}</td>
        <td>{{ $emprunt->date_emprunt }}</td>
        <td>{{ $emprunt->date_retour ?? 'Non définie' }}</td>
        <td>
            @if($emprunt->statut == 'en cours')
            <span class="badge bg-warning">En cours</span>
            @else
            <span class="badge bg-success">Retourné</span>
            @endif
        </td>
        <td>
            <a href="{{ route('emprunts.edit', $emprunt) }}" class="btn btn-warning btn-sm">Modifier</a>
            <form action="{{ route('emprunts.destroy', $emprunt) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
