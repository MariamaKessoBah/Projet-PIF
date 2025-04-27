@extends('layouts.template')

@section('title', 'Enregistrer Evaluateur')

@section('content')
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

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('registerEvaluator') }}" class="btn btn-success btn-glow">
            <i class="fas fa-plus me-2"></i> Ajouter un évaluateur
        </a>
    </div>

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
                                                <button type="button" class="btn btn-outline-warning btn-sm btn-glow" data-bs-toggle="modal" data-bs-target="#editModal{{ $evaluateur->id }}">
                                                    <i class="fas fa-pen"></i>
                                                </button>

                                                <form action="{{ route('deleteEvaluator', $evaluateur->id) }}" method="POST" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-glow" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Modal de modification -->
                                            <div class="modal fade" id="editModal{{ $evaluateur->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $evaluateur->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $evaluateur->id }}">Modifier l'évaluateur</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('editEvaluator', $evaluateur->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="name{{ $evaluateur->id }}" class="form-label">Nom</label>
                                                                        <input type="text" class="form-control glow" id="name{{ $evaluateur->id }}" name="name" value="{{ $evaluateur->user->name }}" required>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="email{{ $evaluateur->id }}" class="form-label">Email</label>
                                                                        <input type="email" class="form-control glow" id="email{{ $evaluateur->id }}" name="email" value="{{ $evaluateur->user->email }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="structure{{ $evaluateur->id }}" class="form-label">Structure</label>
                                                                        <input type="text" class="form-control glow" id="structure{{ $evaluateur->id }}" name="structure" value="{{ $evaluateur->structure }}">
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="fonction{{ $evaluateur->id }}" class="form-label">Fonction</label>
                                                                        <input type="text" class="form-control glow" id="fonction{{ $evaluateur->id }}" name="fonction" value="{{ $evaluateur->fonction }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="tel{{ $evaluateur->id }}" class="form-label">Téléphone</label>
                                                                        <input type="text" class="form-control glow" id="tel{{ $evaluateur->id }}" name="tel" value="{{ $evaluateur->tel }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-primary btn-glow">Mettre à jour</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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

<!-- Script pour confirmation SweetAlert2 -->
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

@endsection
