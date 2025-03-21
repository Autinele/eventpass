@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Liste des Utilisateurs</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($utilisateurs as $utilisateur)
                    <tr>
                        <td>{{ $utilisateur->name }}</td>
                        <td>{{ $utilisateur->last_name }}</td>
                        <td>{{ $utilisateur->email }}</td>
                        <td>{{ $utilisateur->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
