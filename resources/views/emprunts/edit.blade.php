@extends('layouts.app')

@section('content')
<h2>Modifier un Emprunt</h2>

<form action="{{ route('emprunts.update', $emprunt) }}" method="POST">    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Livre</label>
        <select name="livre_id" class="form-control" required>
            @foreach($livres as $livre)
            <option value="{{ $livre->id }}" {{ $emprunt->livre_id == $livre->id ? 'selected' : '' }}>
                {{ $livre->titre }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Date de retour</label>
        <input type="date" name="date_retour" class="form-control" value="{{ $emprunt->date_retour }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Statut</label>
        <select name="statut" class="form-control" required>
            <option value="en cours" {{ $emprunt->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
            <option value="retourné" {{ $emprunt->statut == 'retourné' ? 'selected' : '' }}>Retourné</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Modifier</button>
    <a href="{{ route('emprunts.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
