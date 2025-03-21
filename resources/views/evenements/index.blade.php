@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="mb-4">Liste des Évènements</h2>

            <!-- Notifications de succès et d'erreur -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Bouton d'ajout d'évènement -->
            <div>
                <a href="{{ route('evenements.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus-circle"></i> Ajouter un évènement
                </a>
            </div>

            <!-- Tableau des évènements -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            {{-- <th>Description</th> --}}
                            <th>Date de début</th>
                            {{-- <th>Date de fin</th> --}}
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evenements as $evenement)
                            <tr>
                                <td>{{ $evenement->titre }}</td>
                                {{-- <td>{{ $evenement->description }}</td> --}}
                                <td>{{ $evenement->date_debut }}</td>
                                {{-- <td>{{ $evenement->date_fin }}</td> --}}
                                <td>
                                    @if ($evenement->statut == 'actif')
                                        <span class="badge bg-success">{{ $evenement->statut }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $evenement->statut }}</span>
                                    @endif
                                </td>

                                <td>
                                    <!-- Bouton Voir -->
                                    <a href="{{ route('evenements.show', $evenement->id) }}" class="btn btn-info btn-sm" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('evenements.edit', $evenement->id) }}" class="btn btn-primary btn-sm" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Bouton Supprimer -->
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $evenement->id }})" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet évènement ?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" style="width: 100%;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            document.getElementById('deleteForm').action = '/evenements/' + id;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Fermeture auto des alertes après 3 secondes
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => alert.classList.remove('show'));
            }, 3000);
        });
    </script>
@endsection
