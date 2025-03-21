@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="mb-4">Liste des participants pour tous les événements</h2>

            <!-- Liste des événements avec leurs participants -->
            @foreach ($evenements as $evenement)
                <div class="mb-4">
                    <h4>Événement : {{ $evenement->titre }}</h4>
                    <p><strong>Description :</strong> {{ $evenement->description }}</p>
                    <p><strong>Date de début :</strong> {{ $evenement->date_debut }}</p>
                    <p><strong>Date de fin :</strong> {{ $evenement->date_fin }}</p>
                    <p><strong>Statut :</strong> {{ $evenement->statut }}</p>

                    <!-- Liste des participants pour cet événement -->
                    <div>
                        <h5>Liste des participants :</h5>
                        @if ($evenement->participants->isEmpty())
                            <p>Aucun participant inscrit pour cet événement.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Inscrit le</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evenement->participants as $participant)
                                        <tr>
                                            <td>{{ $participant->user->name }}</td>
                                            <td>{{ $participant->user->email }}</td>
                                            <td>{{ $participant->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
