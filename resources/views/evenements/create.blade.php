@extends('layouts.app')

@section('content')
    @php
        $currentYear = date('Y');
    @endphp

    <div class="main-content">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h2>Créer un évènement</h2>
                </div>
                <div class="card-body">
                    <form  action="{{ route('evenements.store') }}" method="POST">
                        @csrf

                        <!-- Champ Titre -->
                        <div class="form-group">
                            <label for="titre">Titre:</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre"
                                name="titre" value="{{ old('titre') }}" required>
                            @error('titre')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Champ Description -->
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" required>{{ old('description') }}</textarea>
                            @error('description')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Date de début -->
                        <div class="form-group">
                            <label for="date_debut">Date de début de l'évènement:</label>
                            <input type="datetime-local" class="form-control @error('date_debut') is-invalid @enderror"
                                id="date_debut" name="date_debut" value="{{ old('date_debut') }}" required>
                            @error('date_debut')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Date de fin -->
                        <div class="form-group">
                            <label for="date_fin">Date de fin de l'évènement:</label>
                            <input type="datetime-local" class="form-control @error('date_fin') is-invalid @enderror"
                                id="date_fin" name="date_fin" value="{{ old('date_fin') }}" required>
                            @error('date_fin')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('evenements.index') }}" class="btn btn-secondary">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
