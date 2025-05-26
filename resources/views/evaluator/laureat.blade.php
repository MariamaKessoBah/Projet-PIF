@extends('layouts.template')

@section('title', 'Liste des Utilisateurs')

@section('content')
<div class="container">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white"></div>
    </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Liste des Lauréats</h1>
                </div>
            </div>
            <hr class="border-primary">
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
    <div class="col-lg-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-trophy text-warning mr-2"></i>
                    Classement des Lauréats
                </h3>
            </div>
            <div class="card-body">

                <!-- Wrap table inside a div with class "table-responsive" -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="list">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width: 100px;">Rang</th>
                                <th>Nom de structure</th>
                                <th>Intitulé de l'activité</th>
                                <th class="text-center">Score Final</th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laureats as $laureat)
                                <tr>
                                    <td>
                                        <span class="rank">{{ $laureat->rang }}</span>
                                        @if ($laureat->rang == 1)
                                            <i class="fas fa-trophy text-warning"></i>
                                        @elseif ($laureat->rang == 2)
                                            <i class="fas fa-trophy text-secondary"></i>
                                        @elseif ($laureat->rang == 3)
                                            <i class="fas fa-trophy text-brown"></i>
                                        @endif
                                    </td>
                                    <td class="font-weight-bold">{{ $laureat->structure_nom }}</td>
                                    <td>{{ $laureat->intitule_activite }}</td>
                                    <td class="text-center font-weight-bold">{{ number_format($laureat->note_finale, 1) }}/210</td>
                                    <td class="text-center">
                                        <button class="btn btn-info btn-sm" 
                                                onclick="showLaureatDetails('{{ $laureat->id }}')" 
                                                data-id="{{ $laureat->id }}"
                                                title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.table-responsive -->

                <div class="d-flex justify-content-between mb-3">
                    @if(auth()->user()->role === 'DMIF')
                        @if($etatNote === 'publiée')
                            <button class="btn btn-success" disabled>
                                Notes déjà publiées
                            </button>
                        @else
                            <button class="btn btn-primary" id="btnPublier">
                                <i class="fas fa-upload"></i> Publier la Liste
                            </button>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>


       <!-- Modal Détails du Lauréat -->
    <div class="modal fade" id="detailsLaureatModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">
                        <i class="fas fa-trophy text-warning mr-2"></i>
                        <span id="modalTitle">Détails du Lauréat</span>
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white text-dark">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-secondary"><strong>Informations Générales</strong></h6>
                            <hr>
                            <p><strong>Structure:</strong> <span id="modal_structure"></span></p>
                            <p><strong>Activité:</strong> <span id="modal_activite"></span></p>
                            <p><strong>Secteur:</strong> <span id="modal_secteur"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-secondary"><strong>Résultats d'Évaluation</strong></h6>
                            <hr>
                            <p><strong>Rang:</strong> <span id="modal_rang"></span></p>
                            <p><strong>Score Final:</strong> <span id="modal_score"></span></p>
                            <p><strong>Nombre d'évaluateurs:</strong> <span id="modal_evaluateurs"></span></p>
                        </div>
                    </div>

                    <h6 class="text-secondary"><strong>Détail des Notes</strong></h6>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Critère</th>
                                    <th class="text-center">Note Moyenne</th>
                                    <th class="text-center">Coefficient</th>
                                    <th class="text-center">Nombre Total de points</th>
                                </tr>
                            </thead>
                            <tbody id="modal_notes">
                            </tbody>
                        </table>
                    </div>

                    <h6 class="text-secondary mt-4"><strong>Observations du Jury</strong></h6>
                    <hr>
                    <div id="modal_observations" class="border rounded p-3 bg-light">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function showLaureatDetails(laureatId) {
    console.log('ID du lauréat:', laureatId); // Pour débogage

    if (!laureatId) {
        console.error('ID du lauréat manquant');
        return;
    }

    $.ajax({
        url: '/evaluator/laureat/details/' + laureatId,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                // Remplir les informations de base
                $('#modal_structure').text(response.laureat.nom_structure);
                $('#modal_activite').text(response.laureat.intitule_activite);
                $('#modal_secteur').text(response.laureat.secteur || 'Non spécifié');
                let rang = response.laureat.rang;
                let suffixe = (rang == 1) ? 'er' : 'ème'; // "1er" pour 1, "2ème", "3ème", "4ème"...
                $('#modal_rang').text(rang + suffixe);
                $('#modal_score').text(response.laureat.note_finale ? 
                    parseFloat(response.laureat.note_finale).toFixed(2) + '/210' : 'Non disponible');
                $('#modal_evaluateurs').text(response.laureat.nb_evaluateurs || '0');

                // Remplir le tableau des notes
                let notesHtml = '';
                if (response.notes && response.notes.length > 0) {
                    response.notes.forEach(function(note) {
                        notesHtml += `
                            <tr>
                                <td>${note.critere}</td>
                                <td class="text-center">${parseFloat(note.note_moyenne).toFixed(2)}/10</td>
                                <td class="text-center">${note.coefficient}</td>
                                <td class="text-center">${parseFloat(note.total_points).toFixed(2)}</td>
                            </tr>
                        `;
                    });
                } else {
                    notesHtml = '<tr><td colspan="4" class="text-center">Aucune note disponible</td></tr>';
                }
                $('#modal_notes').html(notesHtml);

                // Afficher les observations
                $('#modal_observations').text(response.laureat.observation_jury || 'Aucune observation');

                // Afficher le modal
                $('#detailsLaureatModal').modal('show');
            } else {
                alert(response.message || 'Erreur lors de la récupération des détails');
            }
        },
        error: function(xhr, status, error) {
            console.error('Erreur complète:', {
                status: status,
                error: error,
                response: xhr.responseText
            });
            alert('Une erreur est survenue lors de la récupération des détails du lauréat');
        }
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Vérifier si l'état de la note est "publiée" au chargement de la page
        checkEtatNote();

        $('#btnPublier').click(function() {
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous êtes sur le point de publier la liste. Assurez-vous que toutes les notes ont été validées par le jury avant de publier.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Oui, publier !",
                cancelButtonText: "Annuler",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("notes.publier") }}',  // Route pour la publication
                        method: 'POST',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Succès !",
                                    text: response.message,
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    // Mettre à jour l'état de la note
                                    $('#btnPublier').prop('disabled', true);
                                    $('#btnPublier').addClass('disabled');
                                    location.reload(); // Rafraîchir la page après publication
                                });
                            } else {
                                Swal.fire({
                                    title: "Erreur !",
                                    text: response.message,
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: "Erreur !",
                                text: "Une erreur est survenue. Veuillez réessayer.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

        // Fonction pour vérifier l'état de la note
        function checkEtatNote() {
            var etatNote = '{{ $etatNote }}';  // Vérifiez que cette variable est bien définie
            if (etatNote === 'publiée') {
                $('#btnPublier').prop('disabled', true);
                $('#btnPublier').addClass('disabled');
            }
        }
    });

    // Fonction pour afficher les détails du lauréat
    function showLaureatDetails(laureatId) {
        if (!laureatId) {
            console.error('ID du lauréat manquant');
            return;
        }

        $.ajax({
            url: '/evaluator/laureat/details/' + laureatId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#modal_structure').text(response.laureat.nom_structure);
                    $('#modal_activite').text(response.laureat.intitule_activite);
                    $('#modal_secteur').text(response.laureat.secteur || 'Non spécifié');
                    let rang = response.laureat.rang;
                    let suffixe = (rang == 1) ? 'er' : 'ème';
                    $('#modal_rang').text(rang + suffixe);
                    $('#modal_score').text(response.laureat.note_finale ? parseFloat(response.laureat.note_finale).toFixed(2) + '/210' : 'Non disponible');
                    $('#modal_evaluateurs').text(response.laureat.nb_evaluateurs || '0');

                    let notesHtml = '';
                    if (response.notes && response.notes.length > 0) {
                        response.notes.forEach(function(note) {
                            notesHtml += `
                                <tr>
                                    <td>${note.critere}</td>
                                    <td class="text-center">${parseFloat(note.note_moyenne).toFixed(2)}/10</td>
                                    <td class="text-center">${note.coefficient}</td>
                                    <td class="text-center">${parseFloat(note.total_points).toFixed(2)}</td>
                                </tr>
                            `;
                        });
                    } else {
                        notesHtml = '<tr><td colspan="4" class="text-center">Aucune note disponible</td></tr>';
                    }
                    $('#modal_notes').html(notesHtml);
                    $('#modal_observations').text(response.laureat.observation_jury || 'Aucune observation');
                    $('#detailsLaureatModal').modal('show');
                } else {
                    alert(response.message || 'Erreur lors de la récupération des détails');
                }
            },
            error: function(xhr) {
                alert('Une erreur est survenue lors de la récupération des détails du lauréat');
            }
        });
    }
</script>

@endpush