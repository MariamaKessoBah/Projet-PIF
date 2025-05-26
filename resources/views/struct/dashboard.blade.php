@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tableau de bord</h1>
            </div>
        </div>
        <hr class="border-primary">
    </div>
</div>

<!-- Main content -->
<div class="container-fluid">
    
    <!-- Message de bienvenue -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <h4 class="mb-3">Bienvenue, <strong>{{ Auth::user()->name }}</strong></h4>
                
                @if($prix)
                    <p class="text-primary font-weight-bold mb-2">{{ $prix->designation }}</p>
                    <p class="text-muted mb-3">Édition : <span class="font-weight-bold">{{ $prix->annee }}</span></p>
                @else
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

    <!-- Classement des Lauréats -->
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
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="list">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" style="min-width: 80px;">Rang</th>
                                        <th style="min-width: 200px;">Nom de structure</th>
                                        <th style="min-width: 250px;">Intitulé de l'activité</th>
                                        <th class="text-center" style="min-width: 120px;">Score Final</th>
                                        <th class="text-center" style="min-width: 100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laureats as $laureat)
                                        <tr>
                                            <td class="text-center">
                                                <span class="rank">{{ $laureat->rang }}</span>
                                                @if ($laureat->rang == 1)
                                                    <i class="fas fa-trophy text-warning"></i>
                                                @elseif ($laureat->rang == 2)
                                                    <i class="fas fa-trophy text-secondary"></i>
                                                @elseif ($laureat->rang == 3)
                                                    <i class="fas fa-trophy" style="color: #cd7f32;"></i> {{-- Bronze --}}
                                                @endif
                                            </td>
                                            <td class="fw-bold">{{ $laureat->structure_nom }}</td>
                                            <td>{{ $laureat->intitule_activite }}</td>
                                            <td class="text-center fw-bold">{{ number_format($laureat->note_finale, 1) }}/210</td>
                                            <td class="text-center">
                                                <button class="btn btn-info btn-sm" 
                                                    onclick="showLaureatDetails('{{ $laureat->id }}')" 
                                                    data-id="{{ $laureat->id }}"
                                                    title="Voir détails">
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
        </div>
    </section>

    <!-- Modal Détails du Lauréat -->
    <div class="modal fade" id="detailsLaureatModal" tabindex="-1" role="dialog" aria-labelledby="detailsLaureatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalTitle">
                        <i class="fas fa-trophy text-warning mr-2"></i>
                        Détails du Lauréat
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white text-dark">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-secondary"><strong>Informations Générales</strong></h6>
                            <hr>
                            <p><strong>Structure:</strong> <span id="modal_structure"></span></p>
                            <p><strong>Activité:</strong> <span id="modal_activite"></span></p>
                            <p><strong>Secteur:</strong> <span id="modal_secteur"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-secondary"><strong>Résultats d'Évaluation</strong></h6>
                            <hr>
                            <p><strong>Rang:</strong> <span id="modal_rang"></span></p>
                            <p><strong>Score Final:</strong> <span id="modal_score"></span></p>
                            <p><strong>Nombre d'évaluateurs:</strong> <span id="modal_evaluateurs"></span></p>
                        </div>
                    </div>

                    <h6 class="text-secondary"><strong>Détail des Notes</strong></h6>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>Critère</th>
                                    <th class="text-center">Note Moyenne</th>
                                    <th class="text-center">Coefficient</th>
                                    <th class="text-center">Nombre Total de points</th>
                                </tr>
                            </thead>
                            <tbody id="modal_notes">
                                <!-- Contenu chargé via JS -->
                            </tbody>
                        </table>
                    </div>

                    <h6 class="text-secondary mt-4"><strong>Observations du Jury</strong></h6>
                    <hr>
                    <div id="modal_observations" class="border rounded p-3 bg-light">
                        <!-- Contenu chargé via JS -->
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications et contact -->
    <div class="row mt-4">
        <!-- Section notifications -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">Dernières notifications</div>
                <div class="card-body">
                    @foreach($notifications as $notification)
                        <div class="notification-item mb-3">
                            <h5>{{ $notification['titre'] }}</h5>
                            <p>{!! $notification['message'] !!}</p>
                            <small class="text-muted">{{ $notification['date'] }}</small>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Section contact support -->
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
@endsection

@push('scripts')
<script>
    function showLaureatDetails(laureatId) {
        if (!laureatId) {
            console.error('ID du lauréat manquant');
            return;
        }

        $.ajax({
            url: '/laureat/details/' + laureatId,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#modalTitle').text('Détails du Lauréat ' + response.laureat.nom_structure);
                    $('#modal_structure').text(response.laureat.nom_structure);
                    $('#modal_activite').text(response.laureat.intitule_activite);
                    $('#modal_secteur').text(response.laureat.secteur || 'Non spécifié');
                    $('#modal_rang').text(response.laureat.rang + 'ème');
                    $('#modal_score').text(parseFloat(response.laureat.note_finale).toFixed(1) + '/210');
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
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', error);
                alert('Une erreur est survenue lors de la récupération des détails du lauréat.');
            }
        });
    }
</script>
@endpush

@push('styles')
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
.info-box {
    display: flex;
    align-items: center;
    background-color: #f7f7f7;
    padding: 1rem;
    border-radius: 0.25rem;
}
.info-box-icon {
    font-size: 2rem;
    padding: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 1rem;
    border-radius: 0.25rem;
}
.info-box-content {
    flex: 1;
}
.timeline i {
    font-size: 1.5rem;
    margin-right: 0.5rem;
}
.timeline-item {
    display: inline-block;
    font-weight: 600;
}
.rank {
    font-weight: 700;
    font-size: 1.1rem;
}
</style>
@endpush
