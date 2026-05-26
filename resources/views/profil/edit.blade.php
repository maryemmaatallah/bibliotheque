@extends('layouts.app')

@section('content')
<h2>✏️ Modifier mon profil</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <button type="submit" class="btn btn-success">💾 Enregistrer</button>
            <a href="{{ route('profil.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
