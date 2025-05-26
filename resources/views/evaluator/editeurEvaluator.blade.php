@extends('layouts.template')

@section('title', 'Enregistrer Evaluateur')

@section('content')
<!-- Style global -->
<style>
    .form-control.glow:focus {
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.8);
        border-color: #0d6efd;
    }

    .btn-glow:hover {
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.8), 0 0 20px rgba(13, 110, 253, 0.6);
        transform: scale(1.02);
        transition: 0.3s;
    }

    .modal-content {
        border-radius: 1rem;
    }

    .table thead th {
        background-color: #0d6efd;
        color: white;
    }
</style>

<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Liste des évaluateurs</h1>
                </div>
            </div>
            <hr class="border-primary">
        </div>
    </div>

    <!-- Gestion des messages de succès ou d'erreur -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: "{{ session('success') }}",
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('error') }}",
            });
        </script>
    @endif

    <!-- Bouton d'ajout d'évaluateur -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('registerEvaluator') }}" class="btn btn-success btn-glow">
            <i class="fas fa-plus me-2"></i> Ajouter un évaluateur
        </a>
    </div>

    <!-- Tableau des évaluateurs -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card shadow-sm border-light rounded">
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Structure</th>
                                    <th>Fonction</th>
                                    <th>Téléphone</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($evaluateurs as $evaluateur)
                                    <tr>
                                        <td>{{ $evaluateur->user->name }}</td>
                                        <td>{{ $evaluateur->user->email }}</td>
                                        <td>{{ $evaluateur->structure }}</td>
                                        <td>{{ $evaluateur->fonction }}</td>
                                        <td>{{ $evaluateur->tel }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-3">
                                                <!-- Bouton pour modifier l'évaluateur -->
                                                <button type="button" class="btn btn-outline-warning btn-sm btn-glow" data-bs-toggle="modal" data-bs-target="#editModal{{ $evaluateur->id }}">
                                                    <i class="fas fa-pen"></i>
                                                </button>

                                                <!-- Formulaire pour supprimer l'évaluateur -->
                                                <form action="{{ route('deleteEvaluator', $evaluateur->id) }}" method="POST" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-glow" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun évaluateur trouvé.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modals de modification de l'évaluateur -->
@foreach($evaluateurs as $evaluateur)
    <div class="modal fade" id="editModal{{ $evaluateur->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $evaluateur->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('updateEvaluator', $evaluateur->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $evaluateur->id }}">Modifier l'évaluateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Colonne gauche -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name{{ $evaluateur->id }}" class="form-label">Nom</label>
                                    <input type="text" class="form-control glow" id="name{{ $evaluateur->id }}" name="name" value="{{ $evaluateur->user->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email{{ $evaluateur->id }}" class="form-label">Email</label>
                                    <input type="email" class="form-control glow" id="email{{ $evaluateur->id }}" name="email" value="{{ $evaluateur->user->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tel{{ $evaluateur->id }}" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="tel{{ $evaluateur->id }}" name="tel" value="{{ $evaluateur->tel }}" required>
                                </div>
                            </div>

                            <!-- Colonne droite -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="structure{{ $evaluateur->id }}" class="form-label">Structure</label>
                                    <input type="text" class="form-control" id="structure{{ $evaluateur->id }}" name="structure" value="{{ $evaluateur->structure }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fonction{{ $evaluateur->id }}" class="form-label">Fonction</label>
                                    <input type="text" class="form-control" id="fonction{{ $evaluateur->id }}" name="fonction" value="{{ $evaluateur->fonction }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Script pour la confirmation de suppression avec SweetAlert2 -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.form-delete');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action est irréversible !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
