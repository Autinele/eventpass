@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Événements Expirés</h2>
        @if ($evenements->isEmpty())
            <p>Aucun événement expiré trouvé.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th>Titre</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evenements as $evenement)
                        <tr>

                            <td>{{ $evenement->titre }}</td>
                            <td>{{ $evenement->date_debut }}</td>
                            <td>{{ $evenement->date_fin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
