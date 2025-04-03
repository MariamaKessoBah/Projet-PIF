@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
        <hr class="border-primary">
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <!-- Message de bienvenue -->
        <div class="col-12 mb-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <!-- Titre de bienvenue -->
                    <h4 class="mb-3">Bienvenue, <strong>{{ Auth::user()->name }}</strong></h4>
                    
                    @if($prix)
                        <!-- Affichage du prix si disponible -->
                        <p class="text-primary font-weight-bold mb-2">{{ $prix->designation }}</p>
                        <p class="text-muted mb-3">Édition : <span class="font-weight-bold">{{ $prix->annee }}</span></p>
                    @else
                        <!-- Message alternatif si aucune information de prix n'est disponible -->
                        <p class="text-warning mb-0">Aucun prix disponible.</p>
                    @endif
                </div>
            </div>
        </div>

        <hr>

        <!-- Résumé du dossier -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="info-box mb-4">
                    <span class="info-box-icon bg-info"><i class="fas fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">État de votre candidature</span>
                        <span class="info-box-number">
                            @forelse($candidatures as $candidature)
                                @if (is_null($candidature->etat))
                                    Non soumis
                                @elseif ($candidature->etat === 'en_attente')
                                    Soumis
                                @else
                                    {{ $candidature->etat }}
                                @endif
                            @empty
                                Non soumis
                            @endforelse
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box mb-4">
                    <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Date limite</span>
                        <span class="info-box-number">
                            @if($prix)
                                {{ \Carbon\Carbon::parse($prix->date_cloture_depot_dossier)->format('d/m/Y') }}
                            @else
                                Aucune date limite définie.
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Informations et Progression du dossier -->
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Informations du dossier</h3>
                    </div>
                    <div class="card-body">
                        @forelse($candidatures as $candidature)
                            <p><strong>N° Dossier: #</strong> {{ $candidature->num_dossier }}</p>
                            <p><strong>Date de soumission:</strong> {{ \Carbon\Carbon::parse($candidature->created_at)->format('d/m/Y') }}</p>
                            <p><strong>Statut actuel:</strong>
                            <span class="info-box-number">
                                @php
                                    $statusMap = [
                                        'en_attente' => ['badge' => 'badge-warning', 'label' => 'En cours de validation'],
                                        'validé' => ['badge' => 'badge-warning', 'label' => 'En cours d\'évaluation'],
                                        'évalué' => ['badge' => 'badge-warning', 'label' => 'Délibération en cours'],
                                        'terminé' => ['badge' => 'badge-success', 'label' => 'Terminé'],
                                        'rejeté' => ['badge' => 'badge-danger', 'label' => 'Rejeté']
                                    ];
                                @endphp
                                
                                @if (is_null($candidature->etat))
                                    <span class="badge badge-secondary">Non soumis</span>
                                @else
                                    <span class="badge {{ $statusMap[$candidature->etat]['badge'] }}">
                                        {{ $statusMap[$candidature->etat]['label'] }}
                                    </span>
                                @endif
                            </span>
                            </p>
                            <p><strong>Dernière mise à jour:</strong> {{ \Carbon\Carbon::parse($candidature->updated_at)->format('d/m/Y') }}</p>
                        @empty
                            <p>Aucune candidature trouvée.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Progression du dossier</h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @forelse($candidatures as $candidature)
                                @php
                                    $steps = ['Soumission du dossier', 'Validation du dossier', 'Évaluation technique', 'Délibération finale'];
                                    
                                    $stateProgressMap = [
                                        'en_attente' => 1,
                                        'validé' => 2,
                                        'évalué' => 3,
                                        'terminé' => 4,
                                        'rejeté' => 1
                                    ];

                                    $currentStep = $stateProgressMap[$candidature->etat] ?? 0;
                                @endphp
                                
                                @foreach($steps as $index => $step)
                                    <div>
                                        <i class="fas fa-{{ 
                                            $index < $currentStep ? 'check-circle text-success' : 
                                            ($index === $currentStep ? 'spinner text-warning' : 'clock text-secondary') 
                                        }}"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">{{ $step }}</h3>
                                        </div>
                                    </div>
                                @endforeach
                            @empty
                                <p>Aucune candidature trouvée</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-trophy text-warning mr-2"></i>
                        Classement des Lauréats
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered" id="list">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width: 100px;">Rang</th>
                                <th>Nom de structure</th>
                                <th>Intitulé de l'activité</th>
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
        <hr>

    <!-- Notifications et contact -->
<div class="row mt-4">
    <!-- Section des notifications -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">Dernières notifications</div>
            <div class="card-body">
                @foreach($notifications as $notification)
                    <div class="notification-item mb-3">
                        <h5>{{ $notification['titre'] }}</h5>
                        <!-- Affichage du message avec le contenu HTML -->
                        <p>{!! $notification['message'] !!}</p>
                        <small class="text-muted">{{ $notification['date'] }}</small>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Section du contact support -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">Contact support</h3>
            </div>
            <div class="card-body">
                <p><i class="fas fa-envelope"></i> prixmmess@microfinance-ess.gouv.sn</p>
                <p><i class="fas fa-phone"></i> 33 889 80 33</p>
                <a href="mailto:prixmmess@microfinance-ess.gouv.sn?subject=Support Request&body=Bonjour, je souhaite obtenir de l'aide concernant..." class="btn btn-primary btn-block">
                    <i class="fas fa-comment"></i> Envoyer un message
                </a>
            </div>
        </div>
    </div>
    
</div>

    </div>
</section>
@endsection


<script>
function showEtatDetails(dossierID) {
    // Récupérer les données du dossier (simulation)
    // Dans un cas réel, vous feriez un appel AJAX ici
    const dossierData = {
        numero: 'DPC-2024-001',
        activite: 'Digital Banking Solutions',
        dateSoumission: '20/01/2024',
        statut: 'En cours d\'évaluation',
        score: '8.5/10',
        rang: '3ème',
        derniereMaj: '22/01/2024'
    };

    // Mettre à jour les éléments du modal
    document.getElementById('numeroDossier').textContent = dossierData.numero;
    document.getElementById('activiteNom').textContent = dossierData.activite;
    document.getElementById('dateSoumission').textContent = dossierData.dateSoumission;
    document.getElementById('statutActuel').textContent = dossierData.statut;
    document.getElementById('scoreTotal').innerHTML = <span class="badge badge-success">${dossierData.score}</span>;
    document.getElementById('rangActuel').innerHTML = <span class="badge badge-info">${dossierData.rang}</span>;
    document.getElementById('derniereMaj').textContent = dossierData.derniereMaj;

    // Afficher le modal
    $('#etatDetailsModal').modal('show');
}


$(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function showLaureatDetails(laureatId) {
    console.log("ID reçu : ", laureatId); // Log de l'ID pour débogage
    laureatId = parseInt(laureatId, 10); // Assurer que l'ID est un entier
    if (!laureatId || isNaN(laureatId)) {
        console.error("ID du lauréat invalide.");
        return;
    }

    // Requête AJAX pour récupérer les détails du lauréat
    $.ajax({
        url: `/laureat/details/${laureatId}`,
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(response) {
            console.log('Réponse de la requête:', response); // Afficher la réponse

            // Vérifier si les données sont valides
            if (!response.laureat) {
                console.error("Les détails du lauréat ne sont pas disponibles.");
                return;
            }

            // Remplir les données dans le modal
            $('#modalTitle').text('Détails du Lauréat ' + response.laureat.nom_structure);
            $('#modal_structure').text(response.laureat.nom_structure);
            $('#modal_activite').text(response.laureat.intitule_activite);
            $('#modal_secteur').text(response.laureat.secteur);
            $('#modal_rang').text(response.laureat.rang);
            $('#modal_score').text(response.laureat.note_finale);
            $('#modal_evaluateurs').text(response.laureat.nb_evaluateurs);

            // Remplir le détail des notes
            var notesHtml = '';
            response.notes.forEach(function(note) {
                notesHtml += `
                    <tr>
                        <td>${note.critere}</td>
                        <td class="text-center">${note.note_moyenne}</td>
                        <td class="text-center">${note.coefficient}</td>
                        <td class="text-center">${note.total_points}</td>
                    </tr>
                `;
            });
            $('#modal_notes').html(notesHtml);

            // Remplir les observations du jury
            $('#modal_observations').text(response.laureat.observation_jury);

            // Afficher le modal
            $('#detailsLaureatModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors de la récupération des détails du lauréat :", error);
        }
    });
}

</script>

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
                $('#modal_rang').text(response.laureat.rang + 'ème');
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
@endpush

<style>
.modal-lg {
    max-width: 900px;
}

.table th {
    width: 40%;
}

.badge {
    font-size: 0.9rem;
    padding: 0.5em 1em;
}

.table-sm td, .table-sm th {
    padding: 0.5rem;
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>