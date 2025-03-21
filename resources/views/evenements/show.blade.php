@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="mb-4">Détails de l'Evènement</h2>

            <div class="card">
                <div class="card-body">
                    <p><strong>Titre:</strong> {{ $evenement->titre }}</p>
                    <p><strong>Description:</strong> {{ $evenement->description }}</p>
                    <p><strong>Date de début de l'évènement:</strong> {{ $evenement->date_debut }}</p>
                    <p><strong>Date de fin de l'évènement:</strong> {{ $evenement->date_fin }}</p>
                    <p><strong>Statut:</strong> {{ $evenement->statut }}</p>
                </div>
            </div>

            <a href="{{ route('evenements.index') }}" class="btn btn-secondary mt-3">Retour</a>
        </div>
    </div>
@endsection
