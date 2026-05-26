@extends('layouts.app')

@section('content')
<h2>Nouvel Emprunt</h2>

<form action="{{ route('emprunts.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Livre</label>
        <select name="livre_id" class="form-control" required>
            @foreach($livres as $livre)
            <option value="{{ $livre->id }}">{{ $livre->titre }} ({{ $livre->stock }} dispo)</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Date d'emprunt</label>
        <input type="date" name="date_emprunt" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Date de retour prévue</label>
        <input type="date" name="date_retour" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Enregistrer</button>
    <a href="{{ route('emprunts.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
