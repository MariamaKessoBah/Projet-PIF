@extends('layouts.template')

@section('title', 'Liste_Candidats')

@section('content')
<div class="container">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Liste des candidats</h1>
                    </div>
                </div>
                <hr class="border-primary">
            </div>
        </div>

        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-filter mr-2"></i> Filtres</h3>
                    </div>
                    <div class="card-body">
                        <form id="filtreForm" method="GET" action="{{ route('candidatures.filtrer') }}">
                            <div class="row align-items-end">
                                <!-- Type de structure -->
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label><i class="fas fa-building mr-1"></i> Type de structure</label>
                                        <select name="type_structure" class="form-control">
                                            <option value="">Tous</option>
                                            <option value="IMF" {{ request('type_structure') == 'IMF' ? 'selected' : '' }}>IMF</option>
                                            <option value="FinTech" {{ request('type_structure') == 'FinTech' ? 'selected' : '' }}>FinTech</option>
                                            <option value="PTF" {{ request('type_structure') == 'PTF' ? 'selected' : '' }}>PTF</option>
                                            <option value="ONG" {{ request('type_structure') == 'ONG' ? 'selected' : '' }}>ONG</option>
                                            <option value="Banque" {{ request('type_structure') == 'Banque' ? 'selected' : '' }}>Banques</option>
                                            <option value="Assurance" {{ request('type_structure') == 'Assurance' ? 'selected' : '' }}>Compagnies d'assurance</option>
                                            <option value="Social" {{ request('type_structure') == 'Social' ? 'selected' : '' }}>Entreprises sociales</option>
                                            <option value="Société Coopérative" {{ request('type_structure') == 'Société Coopérative' ? 'selected' : '' }}>Sociétés coopératives</option>
                                            <option value="Structure publique" {{ request('type_structure') == 'Structure publique' ? 'selected' : '' }}>Structures publiques</option>
                                        </select>
                                    </div>
                                </div>
    
                                <!-- Zone d'intervention -->
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label><i class="fas fa-map-marker-alt mr-1"></i> Zone d'intervention</label>
                                        <select name="zone_intervention" class="form-control">
                                            <option value="">Tous</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->nom_region }}" {{ request('zone_intervention') == $region->nom_region ? 'selected' : '' }}>
                                                    {{ $region->nom_region }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
    
                                <!-- Bouton de recherche -->
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search mr-1"></i> Rechercher
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-header d-flex justify-content-between align-items-center">
                @if(Auth::user()->role === 'evaluateur' || Auth::user()->role === 'DMIF')
                <div class="card-tools">
                    <a id="btnReceived" class="btn btn-sm btn-outline-primary" href="#" onclick="showForm('receivedForm', 'btnReceived')">
                        <i class="fa fa-clock"></i> Candidatures en attente de validation
                    </a>
                </div>
                <div class="card-tools">
                    <a id="btnRejected" class="btn btn-sm btn-outline-danger" href="#" onclick="showForm('rejectedForm', 'btnRejected')">
                        <i class="fa fa-times-circle"></i> Candidatures rejetées
                    </a>
                </div>
                <div class="card-tools">
                    <a id="btnValidated" class="btn btn-sm btn-outline-success" href="#" onclick="showForm('validatedForm', 'btnValidated')">
                        <i class="fa fa-check-circle"></i> Candidatures validées
                    </a>
                </div>
                @endif

                @if(Auth::user()->role === 'evaluateur' || Auth::user()->role === 'jury')
                <div class="card-tools">
                    <a id="btnEvaluated" class="btn btn-sm btn-outline-info" href="#" onclick="showForm('evaluatedForm', 'btnEvaluated')">
                        <i class="fa fa-pencil-alt"></i> Candidatures évaluées
                    </a>
                </div>
                @endif
            </div>
        </div>

    
        {{-- Liste des candidatures en attente de validation --}}

        <div class="card-body">
            @if(Auth::user()->role === 'evaluateur' || Auth::user()->role === 'DMIF')
            <div id="receivedForm" class="form-section">
                <h3 class="card-title">Liste des candidatures en attente de validation</h3>
        
                @if($candidaturesEnAttente->isEmpty())
                    <p class="text-muted text-center">Aucune candidature en attente trouvée.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="w-50">Activité</th>
                                    <th class="w-15">Date début</th>
                                    <th class="w-15">Date fin</th>
                                    <th class="w-10">État</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($candidaturesEnAttente as $candidature)
                                    <tr id="row-{{ $candidature->id }}">
                                        <td>{{ $candidature->intitule_activite ?? '--' }}</td>
                                        <td>{{ $candidature->date_debut_intervention ?? '--' }}</td>
                                        <td>{{ $candidature->date_fin_intervention ?? '--' }}</td>
                                        <td class="etat">
                                            <span class="badge bg-warning">{{ ucfirst($candidature->etat) ?? 'En attente' }}</span>
                                        </td>
                                        <td class="text-center">
                                            {{-- Bouton de détails --}}
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsCandidatureModal"
                                                data-nom-structure="{{ $candidature->structure->nom_structure ?? '--' }}"
                                                data-num-dossier="{{ $candidature->num_dossier }}"
                                                data-intitule-activite="{{ $candidature->intitule_activite }}"
                                                data-description-activite="{{ $candidature->description_activite }}"
                                                data-effet-impact="{{ $candidature->effet_impact }}"
                                                data-date-debut-intervention="{{ $candidature->date_debut_intervention }}"
                                                data-date-fin-intervention="{{ $candidature->date_fin_intervention }}"
                                                data-zone-intervention="{{ $candidature->zone_intervention }}"
                                                data-fichier-ninea="{{ $candidature->fichier_ninea }}"
                                                data-rapport-activite="{{ $candidature->rapport_activite }}"
                                                data-fichier-rccm="{{ $candidature->fichier_rccm }}"
                                                data-fichier-agrement="{{ $candidature->fichier_agrement }}"
                                                data-nbr-homme-toucher="{{ $candidature->nbr_homme_toucher }}"
                                                data-nbr-femme-toucher="{{ $candidature->nbr_femme_toucher }}"
                                                data-nbr-jeune-toucher="{{ $candidature->nbr_jeune_toucher }}"
                                                data-nbr-handicape-toucher="{{ $candidature->nbr_handicape_toucher }}"
                                                data-regions="{{ $candidature->regions->pluck('nom_region')->implode(', ') }}"
                                                data-departements="{{ $candidature->departements->pluck('nom_departement')->implode(', ') }}"
                                                data-communes="{{ $candidature->communes->pluck('nom_commune')->implode(', ') }}"
                                                data-cibles="{{ $candidature->cibles->pluck('designation_cible')->implode(', ') }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
        
                                            {{-- Actions pour DMIF --}}
                                            @if(Auth::user()->role === 'DMIF')
                                                <button class="btn btn-success btn-sm btn-valider" title="Valider" data-id="{{ $candidature->id }}" data-toggle="modal" data-target="#confirmationModal">
                                                    <i class="fas fa-check"></i>
                                                </button>
        
                                                <button class="btn btn-danger btn-sm btn-rejeter" title="Rejeter" data-id="{{ $candidature->id }}">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
        
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end">
                        {{ $candidaturesEnAttente->links('pagination.custom') }}
                    </div>
                @endif
            </div>
           
            @endif
        </div>

        

        <!-- Modal Détails dossier candidature -->
        <div class="modal fade" id="detailsCandidatureModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title">
                            <i class="fas fa-info-circle text-primary mr-2"></i>
                            <span id="modalTitle">Détails de votre dossier de candidature</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                        
                    <div class="modal-body" id="printCandidatureModal">
                        <table class="table table-bordered table-hover table-glow">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Informations Générales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Nom structure:</strong></td>
                                    <td id="modal_nom_structure" style="text-align: justify;"></td>
                                </tr>
                                    
                                <tr>
                                    <td><strong>Numéro de dossier:</strong></td>
                                    <td id="modal_num_dossier" style="text-align: justify;"></td>
                                </tr>
                                <tr>
                                    <td><strong>Intitulé activité:</strong></td>
                                    <td id="modal_intitule_activite" style="text-align: justify;"></td>
                                </tr>
                                <tr>
                                    <td><strong>Description de l'activité:</strong></td>
                                    <td id="modal_description_activite" style="text-align: justify;"></td>
                                </tr>
                                <tr>
                                    <td><strong>Effet/Impact :</strong></td>
                                    <td id="modal_effet_impact" style="text-align: justify;"></td>
                                </tr>
                            </tbody>
                        </table>


                        <table class="table table-bordered table-hover table-glow">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Dates d'Intervention</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Date début de l'intervention:</strong></td>
                                    <td id="modal_date_debut_intervention"></td>
                                </tr>
                                <tr>
                                    <td><strong>Date de fin de l'intervention:</strong></td>
                                    <td id="modal_date_fin_intervention"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-hover table-glow">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Zones d'Intervention</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Régions :</strong></td>
                                    <td id="modal_regions"></td>
                                </tr>
                                <tr>
                                    <td><strong>Départements :</strong></td>
                                    <td id="modal_departements"></td>
                                </tr>
                                <tr>
                                    <td><strong>Communes :</strong></td>
                                    <td id="modal_communes"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-hover table-glow">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Documents</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>NINEA:</strong></td>
                                    <td id="modal_ninea"></td>
                                </tr>
                                <tr>
                                    <td><strong>Rapport activité :</strong></td>
                                    <td id="modal_rapport_activite"></td>
                                </tr>
                                <tr>
                                    <td><strong>RCCM:</strong></td>
                                    <td id="modal_rccm"></td>
                                </tr>
                                <tr>
                                    <td><strong>AGREEMENT:</strong></td>
                                    <td id="modal_agrement"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered table-hover table-glow">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Cibles</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><strong>Nombre d'hommes touchés:</strong></td>
                                <td id="modal_nbr_homme_toucher"></td>
                            </tr>
                            <tr>
                                <td><strong>Nombre de femmes touchées:</strong></td>
                                <td id="modal_nbr_femme_toucher"></td>
                            </tr>
                            <tr>
                                <td><strong>Nombre de jeunes touchés :</strong></td>
                                <td id="modal_nbr_jeune_toucher"></td>
                            </tr>
                            <tr>
                                <td><strong>Nombre de personnes handicapées touchées:</strong></td>
                                <td id="modal_nbr_handicape_toucher"></td>
                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Fermer
                        </button>
                        <button type="button" class="btn btn-primary" onclick="imprimerModal();">
                            <i class="fas fa-print"></i> Imprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>




        {{-- Liste des candidatures validées --}}
        <div id="validatedForm" class="form-section" style="display: none;">
            <h3 class="card-title">Liste des candidatures validées</h3>

            @if($candidaturesValidees->isEmpty())
                <p class="text-muted text-center">Aucune candidature validée trouvée.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="w-50">Activité</th>
                                <th class="w-15">Date début</th>
                                <th class="w-15">Date fin</th>
                                <th class="w-10">État</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidaturesValidees as $candidature)
                            <tr id="row-{{ $candidature->id }}">
                                <td>{{ $candidature->intitule_activite ?? '--' }}</td>
                                <td>{{ $candidature->date_debut_intervention ?? '--' }}</td>
                                <td>{{ $candidature->date_fin_intervention ?? '--' }}</td>
                                <td>
                                    <span class="badge badge-success">{{ ucfirst($candidature->etat) ?? 'Validée' }}</span>
                                </td>
                                <td class="text-center">
                                    {{-- Bouton de détails --}}
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsCandidatureModal"
                                            data-nom-structure="{{ $candidature->structure->nom_structure ?? '--' }}"
                                            data-num-dossier="{{ $candidature->num_dossier }}"
                                            data-intitule-activite="{{ $candidature->intitule_activite }}"
                                            data-description-activite="{{ $candidature->description_activite }}"
                                            data-effet-impact="{{ $candidature->effet_impact }}"
                                            data-date-debut-intervention="{{ $candidature->date_debut_intervention }}"
                                            data-date-fin-intervention="{{ $candidature->date_fin_intervention }}"
                                            data-zone-intervention="{{ $candidature->zone_intervention }}"
                                            data-fichier-ninea="{{ $candidature->fichier_ninea }}"
                                            data-rapport-activite="{{ $candidature->rapport_activite }}"
                                            data-fichier-rccm="{{ $candidature->fichier_rccm }}"
                                            data-fichier-agrement="{{ $candidature->fichier_agrement }}"
                                            data-nbr-homme-toucher="{{ $candidature->nbr_homme_toucher }}"
                                            data-nbr-femme-toucher="{{ $candidature->nbr_femme_toucher }}"
                                            data-nbr-jeune-toucher="{{ $candidature->nbr_jeune_toucher }}"
                                            data-nbr-handicape-toucher="{{ $candidature->nbr_handicape_toucher }}"
                                            data-regions="{{ $candidature->regions->pluck('nom_region')->implode(', ') }}"
                                            data-departements="{{ $candidature->departements->pluck('nom_departement')->implode(', ') }}"
                                            data-communes="{{ $candidature->communes->pluck('nom_commune')->implode(', ') }}"
                                            data-cibles="{{ $candidature->cibles->pluck('designation_cible')->implode(', ') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                        
                                    {{-- Bouton d'évaluation pour l'évaluateur --}}
                                    @if(Auth::user()->role === 'evaluateur')
                                        <button class="btn btn-primary btn-sm btn-evaluer" title="Évaluer"
                                                data-id="{{ $candidature->id }}" data-toggle="modal" data-target="#evaluationModal"
                                                id="evaluateButton-{{ $candidature->id }}" 
                                                @if($candidature->isDisabled) disabled @endif>
                                            <i class="fa fa-check-circle"></i>
                                        </button>
                                        
                                    @endif
                                    {{-- Bouton de restauration pour DMIF --}}
                                    @if(Auth::user()->role === 'DMIF')
                                    <button class="btn btn-success btn-sm btn-restaurer" title="Restaurer" data-id="{{ $candidature->id }}">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                    
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-end">
                    {{ $candidaturesValidees->links('pagination.custom') }}
                </div>
            @endif
        </div>

        
       {{-- Liste des candidatures rejetées --}}
        <div id="rejectedForm" class="form-section" style="display: none;">
            <h3 class="card-title">Liste des candidatures rejetées</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="w-40">Activité</th>
                            <th class="w-15">Date début</th>
                            <th class="w-15">Date fin</th>
                            <th class="w-15">Motif du rejet</th>
                            <th>État</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($candidaturesRejetees as $candidature)
                            <tr id="row-{{ $candidature->id }}">
                                <td>{{ $candidature->intitule_activite ?? '--' }}</td>
                                <td>{{ $candidature->date_debut_intervention ?? '--' }}</td>
                                <td>{{ $candidature->date_fin_intervention ?? '--' }}</td>
                                <td>{{ $candidature->motif_rejet ?? '--' }}</td>
                                <td>
                                    <span class="badge badge-danger">{{ ucfirst($candidature->etat) ?? 'Rejeté' }}</span>
                                </td>
                                <td class="text-center">
                                    {{-- Bouton de détails --}}
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsCandidatureModal"
                                        data-nom-structure="{{ $candidature->structure->nom_structure ?? '--' }}"
                                        data-num-dossier="{{ $candidature->num_dossier }}"
                                        data-intitule-activite="{{ $candidature->intitule_activite }}"
                                        data-description-activite="{{ $candidature->description_activite }}"
                                        data-effet-impact="{{ $candidature->effet_impact }}"
                                        data-date-debut-intervention="{{ $candidature->date_debut_intervention }}"
                                        data-date-fin-intervention="{{ $candidature->date_fin_intervention }}"
                                        data-zone-intervention="{{ $candidature->zone_intervention }}"
                                        data-fichier-ninea="{{ $candidature->fichier_ninea }}"
                                        data-rapport-activite="{{ $candidature->rapport_activite }}"
                                        data-fichier-rccm="{{ $candidature->fichier_rccm }}"
                                        data-fichier-agrement="{{ $candidature->fichier_agrement }}"
                                        data-nbr-homme-toucher="{{ $candidature->nbr_homme_toucher }}"
                                        data-nbr-femme-toucher="{{ $candidature->nbr_femme_toucher }}"
                                        data-nbr-jeune-toucher="{{ $candidature->nbr_jeune_toucher }}"
                                        data-nbr-handicape-toucher="{{ $candidature->nbr_handicape_toucher }}"
                                        data-regions="{{ $candidature->regions->pluck('nom_region')->implode(', ') }}"
                                        data-departements="{{ $candidature->departements->pluck('nom_departement')->implode(', ') }}"
                                        data-communes="{{ $candidature->communes->pluck('nom_commune')->implode(', ') }}"
                                        data-cibles="{{ $candidature->cibles->pluck('designation_cible')->implode(', ') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    {{-- Bouton de restauration pour DMIF --}}
                                    @if(Auth::user()->role === 'DMIF')
                                    <button class="btn btn-success btn-sm btn-restaurer" title="Restaurer" data-id="{{ $candidature->id }}">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                    
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucune candidature rejetée trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end">
                {{ $candidaturesRejetees->links('pagination.custom') }}
            </div>
        </div>


        

        {{-- Liste des candidatures évaluées --}}
        <div id="evaluatedForm" class="form-section" style="display: none;">
            <h3 class="card-title">Liste des candidatures évaluées</h3>

            @if($candidaturesEvaluees->isEmpty())
                <p class="text-muted text-center">Aucune candidature évaluée.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nom structure</th>
                                <th>Intitulé activité</th>
                                    <th>Note cumulée</th>
                                @if(Auth::user()->role === 'jury')

                                    <th>Moyenne</th>
                                @endif
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidaturesEvaluees as $candidature)
                                <tr id="row-{{ $candidature->id }}">
                                    <td>{{ $candidature->structure->nom_structure ?? '--' }}</td>
                                    <td>{{ $candidature->intitule_activite ?? '--' }}</td>
                                        <td><strong>{{ $candidature->note_totale ?? '--' }}</strong></td>
                                    @if(Auth::user()->role === 'jury')
                                        <td><strong id="moyenne-{{ $candidature->id }}">--</strong></td>
                                    @endif
                                    <td class="text-center">
                                        {{-- Bouton de détails --}}
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsCandidatureModal"
                                            data-nom-structure="{{ $candidature->structure->nom_structure ?? '--' }}"
                                            data-num-dossier="{{ $candidature->num_dossier }}"
                                            data-intitule-activite="{{ $candidature->intitule_activite }}"
                                            data-description-activite="{{ $candidature->description_activite }}"
                                            data-effet-impact="{{ $candidature->effet_impact }}"
                                            data-date-debut-intervention="{{ $candidature->date_debut_intervention }}"
                                            data-date-fin-intervention="{{ $candidature->date_fin_intervention }}"
                                            data-zone-intervention="{{ $candidature->zone_intervention }}"
                                            data-fichier-ninea="{{ $candidature->fichier_ninea }}"
                                            data-rapport-activite="{{ $candidature->rapport_activite }}"
                                            data-fichier-rccm="{{ $candidature->fichier_rccm }}"
                                            data-fichier-agrement="{{ $candidature->fichier_agrement }}"
                                            data-nbr-homme-toucher="{{ $candidature->nbr_homme_toucher }}"
                                            data-nbr-femme-toucher="{{ $candidature->nbr_femme_toucher }}"
                                            data-nbr-jeune-toucher="{{ $candidature->nbr_jeune_toucher }}"
                                            data-nbr-handicape-toucher="{{ $candidature->nbr_handicape_toucher }}"
                                            data-regions="{{ $candidature->regions->pluck('nom_region')->implode(', ') }}"
                                            data-departements="{{ $candidature->departements->pluck('nom_departement')->implode(', ') }}"
                                            data-communes="{{ $candidature->communes->pluck('nom_commune')->implode(', ') }}"
                                            data-cibles="{{ $candidature->cibles->pluck('designation_cible')->implode(', ') }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- Bouton de validation pour le jury --}}
                                        @if(Auth::user()->role === 'jury')
                                        <button class="btn btn-success btn-sm" 
                                                title="{{ $candidature->etat === 'terminé' ? 'Déjà validé' : 'Valider' }}" {{-- Infobulle --}}
                                                data-id="{{ $candidature->id }}"
                                                data-nom="{{ $candidature->structure->nom_structure }}"
                                                data-activite="{{ $candidature->intitule_activite }}"
                                                data-note="{{ $candidature->note_totale ?? '--' }}"
                                                data-url="{{ route('evaluateur.validation-modal', ['id' => $candidature->id]) }}"
                                                data-toggle="modal"
                                                data-target="#validationModal"
                                                {{ $candidature->etat === 'terminé' ? 'disabled' : '' }}> {{-- Désactiver si terminé --}}
                                            <i class="fa fa-check-circle"></i>
                                        </button>
                                    @endif
                                    

                                        {{-- Bouton d'évaluation pour l'évaluateur --}}
                                        @if(Auth::user()->role === 'evaluateur')

                                            @if($candidature->etat != 'terminé')
                                                <button class="btn btn-primary btn-sm btn-evaluer" title="Modifier note"
                                                    data-id="{{ $candidature->id }}"
                                                    data-zone-intervention="{{ $candidature->notes->where('id_critere', 1)->first()->note_critere ?? 0 }}"
                                                    data-cible="{{ $candidature->notes->where('id_critere', 2)->first()->note_critere ?? 0 }}"
                                                    data-secteur-activite="{{ $candidature->notes->where('id_critere', 3)->first()->note_critere ?? 0 }}"
                                                    data-approche-innovante="{{ $candidature->notes->where('id_critere', 4)->first()->note_critere ?? 0 }}"
                                                    data-effet-impact="{{ $candidature->notes->where('id_critere', 5)->first()->note_critere ?? 0 }}"
                                                    data-total="{{ $candidature->notes->sum(fn($note) => ($note->note_critere ?? 0) * ($note->critere->coefficient ?? 1)) }}"
                                                    data-commentaires="{{ $candidature->notes->pluck('observation')->filter()->implode('; ') }}"
                                                    data-toggle="modal"
                                                    data-target="#evaluationModal"
                                                    id="evaluateButton-{{ $candidature->id }}">
                                                    <i class="fa fas fa-edit"></i>
                                                </button>
                                            @endif                         
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-end">
                    {{ $candidaturesEvaluees->links('pagination.custom') }}
                </div>
            @endif
        </div>
    </div>
</div>


<!-- Modal d'évaluation -->
<div class="modal fade" id="evaluationModal" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- En-tête du modal -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="evaluationModalLabel">Évaluation de la candidature</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Corps du modal -->
            <div class="modal-body">
                <form id="evaluationForm">
                    <input type="hidden" id="candidatureId" name="candidature_id">


                    <!-- Critères avec étoiles -->
                    <div class="form-group">
                        <label for="zone_intervention">Zone d'intervention :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="zone_intervention"></div>
                            <span class="ml-2 score" id="score_zone_intervention">0</span>/10
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cible">Cible :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="cible"></div>
                            <span class="ml-2 score" id="score_cible">0</span>/10
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="secteur_activite">Secteur d'activité :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="secteur_activite"></div>
                            <span class="ml-2 score" id="score_secteur_activite">0</span>/10
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="approche_innovante">Approche innovante :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="approche_innovante"></div>
                            <span class="ml-2 score" id="score_approche_innovante">0</span>/10
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="effets_impacts">Effets/impacts :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="effet_impact"></div>
                            <span class="ml-2 score" id="score_effet_impact">0</span>/10
                        </div>
                    </div>
                    
                    

                    <!-- Score total -->
                    <div class="form-group">
                        <label for="totalScore">Score total :</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="totalScore" class="font-weight-bold">0</span> / 210
                            <div class="progress w-50" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" id="scoreProgressBar" style="width: 0%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Commentaires supplémentaires -->
                    <div class="form-group">
                        <label for="comments">Observations :</label>
                        <textarea id="comments" class="form-control" rows="4" placeholder="Ajouter des commentaires..."></textarea>
                    </div>

                </form>
            </div>
            <!-- Pied de page du modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="submitEvaluationButton" onclick="submitEvaluation()">
                    <span id="submitButtonText">Soumettre</span>
                    <span id="submitButtonSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                </button>
                            
            </div>
        </div>
    </div>
</div>




{{-- <!-- Modal de Modification d'Évaluation -->
<div class="modal fade" id="modificationEvaluationModal" tabindex="-1" role="dialog" aria-labelledby="modificationEvaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- En-tête du modal -->
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="modificationEvaluationModalLabel">Modification de l'Évaluation</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Corps du modal -->
            <div class="modal-body">
                <form id="modificationEvaluationForm">
                    <input type="hidden" id="modificationCandidatureId" name="candidature_id">
                    <input type="hidden" id="modificationEvaluationId" name="evaluation_id">

                    <!-- Critères modifiables -->
                    <div class="form-group">
                        <label for="zone_intervention_modification">Zone d'intervention :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="zone_intervention_modification"></div>
                            <span class="ml-2 score" id="score_zone_intervention_modification">0</span>/10
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cible_modification">Cible :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="cible_modification"></div>
                            <span class="ml-2 score" id="score_cible_modification">0</span>/10
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="secteur_activite_modification">Secteur d'activité :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="secteur_activite_modification"></div>
                            <span class="ml-2 score" id="score_secteur_activite_modification">0</span>/10
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="approche_innovante_modification">Approche innovante :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="approche_innovante_modification"></div>
                            <span class="ml-2 score" id="score_approche_innovante_modification">0</span>/10
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="effets_impacts_modification">Effets/impacts :</label>
                        <div class="d-flex align-items-center">
                            <div class="rating" data-criterion="effet_impact_modification"></div>
                            <span class="ml-2 score" id="score_effet_impact_modification">0</span>/10
                        </div>
                    </div>


                    <!-- Commentaires supplémentaires -->
                    <div class="form-group">
                        <label for="commentsModification">Observations :</label>
                        <textarea id="commentsModification" class="form-control" rows="4" placeholder="Modifier les observations..."></textarea>
                    </div>

                </form>
            </div>
            
            <!-- Pied de page du modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="submitModificationButton">
                    <span id="submitModificationButtonText">Enregistrer les modifications</span>
                    <span id="submitModificationButtonSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                </button>
            </div>
        </div>
    </div>
</div> --}}



<!-- Modal des jury -->
<div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <!-- En-tête du modal -->
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="evaluationModalLabel">
                    <i class="fas fa-clipboard-check mr-2"></i>
                    Détails de l'évaluation
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Corps du modal -->
            <div class="modal-body">
             <input type="hidden" id="candidatureId" name="candidature_id">
                <!-- Carte d'information de la structure -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-building mr-2"></i>
                            Informations de la structure
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="info-group">
                                    <label class="text-muted">Nom de la Structure</label>
                                    <p class="h6" id="nomStructure">{{ $candidature->structure->nom_structure ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-group">
                                    <label class="text-muted">Activité</label>
                                    <p class="h6" id="activiteStructure">{{ $candidature->intitule_activite ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="info-group">
                                    <label class="text-muted">Note cumulée</label>
                                    <p class="h6">
                                        <p id="noteGlobale" class="badge badge-info ">{{ $candidature->note_totale ?? '--' }}</p>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-group">
                                    <label class="text-muted">Moyenne globale (/210)</label>
                                    <p class="h6">
                                        <p id="moyenneGlobale" class="badge badge-primary">{{ $candidature->moyenne_totale ?? '--' }}</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Critères d'évaluation -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white">
                            <h6 class="card-title mb-0">
                            <i class="fas fa-clipboard-list mr-2"></i>
                                Critères d'évaluation
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Critères</th>
                                            <th class="text-center">Zone d'intervention</th>
                                            <th class="text-center">Innovation</th>
                                            <th class="text-center">Cible</th>
                                            <th class="text-center">Effets</th>
                                            <th class="text-center">Secteur d'activité</th>
                                        </tr>
                                    </thead>
                                    <tbody id="criteresTableBody">
                                        <tr>
                                            <td class="font-weight-bold">Note maximale</td>
                                            <td class="text-center">10</td>
                                            <td class="text-center">10</td>
                                            <td class="text-center">10</td>
                                            <td class="text-center">10</td>
                                            <td class="text-center">10</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Coefficient</td>
                                            <td class="text-center" id="coef1">--</td>
                                            <td class="text-center" id="coef2">--</td>
                                            <td class="text-center" id="coef3">--</td>
                                            <td class="text-center" id="coef4">--</td>
                                            <td class="text-center" id="coef5">--</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <!-- Tableau des évaluations -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-star mr-2"></i>
                                Notes des évaluateurs
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Évaluateur</th>
                                            <th class="text-center">Zone d'intervention</th>
                                            <th class="text-center">Cible</th>
                                            <th class="text-center">Secteur d'activité</th>
                                            <th class="text-center">Innovation</th>
                                            <th class="text-center">Effets/impacts</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="evaluationsTableBody">
                                      
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Section des observations -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-comments mr-2"></i>
                                Observations des évaluateurs
                            </h6>
                        </div>
                        <div class="card-body">
                            <div id="observationsContainer" class="observation-list">
                            </div>  
                        </div>
                    </div>

                <!-- Section observations du jury -->
                <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-comments mr-2"></i>
                                Appréciations du jury
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea 
                                    id="juryObservation" 
                                    class="form-control" 
                                    rows="4" 
                                    placeholder="Donnez votre appréciation ici..."
                                ></textarea> 
                            </div>
                        </div>
                    </div>

                <!-- Section validation du jury -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-gavel mr-2"></i>
                            Décision du jury
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Statut de validation</label>
                            <select class="form-control" id="validationStatus">
                                <option value="">Sélectionner un statut</option>
                                <option value="valide" class="text-success">✓ Valider toutes les évaluations</option>
                                <option value="revision" class="text-warning">⟲ Demander une révision</option>
                                {{-- <option value="rejete" class="text-danger">✕ Rejeter les évaluations</option> --}}
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Pied de page du modal -->
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Fermer
                </button>
                <button type="button" class="btn btn-primary" onclick="submitJuryValidation()">
                    <i class="fas fa-save mr-1"></i> Soumettre la décision
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour le modal */
.modal-xl {
    max-width: 1200px;
}

.modal-body {
    padding: 1.5rem;
    background-color: #f8f9fa;
}

.card {
    border: none;
    border-radius: 0.5rem;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,.125);
    padding: 1rem;
}

.info-group {
    margin-bottom: 0;
}

.info-group label {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.table th {
    font-weight: 600;
    font-size: 0.875rem;
}

.observation-list .card {
    margin-bottom: 0.75rem;
}

.observation-list .card:last-child {
    margin-bottom: 0;
}

.badge-primary {
    font-size: 1rem;
    padding: 0.5rem 0.75rem;
}

/* Animation pour le hover des lignes du tableau */
.table-hover tbody tr:hover {
    background-color: rgba(0,123,255,.075);
    transition: background-color 0.2s ease;
}

/* Style pour le select de validation */
#validationStatus {
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
}

#validationStatus option {
    padding: 0.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .modal-xl {
        margin: 0.5rem;
    }
    
    .card {
        margin-bottom: 1rem;
    }
    
    .info-group {
        margin-bottom: 1rem;
    }
}


.card-tools a.active {
        background-color: #007bff;
        color: white;
    }
    .icon-small {
        font-size: 5px !important; /* Force la taille des icônes */
    }

    .table-glow {
box-shadow: 0 0 15px #059652;
border-radius: 10px;
border: 1px solid #ccc;
}

.table-glow th,
.table-glow td {
padding: 10px;
text-align: left;
}

.table-glow th {
background-color: #f8f9fa;
color: #495057;
}

.table-glow tbody tr:nth-child(even) {
background-color: #f2f2f2;
}

.table-glow tbody tr:hover {
background-color: #e9ecef;
}

.modal-content {
box-shadow: 0 0 20px #059652; /* Effet lumineux bleu */
border-radius: 10px;
transition: all 0.3s ease-in-out;
}

.modal-header {
background: linear-gradient(135deg, #059652, #059652); /* Dégradé lumineux */
color: white;
box-shadow: 0 0 10px #059652;
}

.modal-footer {
background-color: #f8f9fa;
box-shadow: 0 0 10px #059652;
}

#downloadPdf {
background: linear-gradient(45deg, #dc3545, #ff073a);
border: none;
color: white;
transition: 0.3s;
}

#downloadPdf:hover {
box-shadow: 0 0 15px rgba(255, 7, 58, 0.8);
transform: scale(1.05);
}

button.close {
color: white;
font-size: 24px;
}

@keyframes glowEffect {
0% {
    box-shadow: 0 0 5px #059652;
}
50% {
    box-shadow: 0 0 20px #059652;
}
100% {
    box-shadow: 0 0 5px #059652;
}
}

.modal-content {
animation: glowEffect 1.5s infinite alternate;
}

/* Animation de disparition du toast */
.toast {
transition: opacity 0.5s ease-out;
}

/* Lorsque le toast disparaît */
.toast.fade {
opacity: 0;
}


.rating {
        display: inline-block;
        font-size: 1.5rem;
        color: #ddd;
        cursor: pointer;
    }

    .rating span {
        margin: 0 3px;
    }

    .rating span:hover,
    .rating span.selected {
        color: gold;
    }

    .score {
        font-weight: bold;
        font-size: 1.2rem;
        color: #333;
    }

    .progress-bar {
        background-color: #28a745;
    }

    .modal-header {
        border-bottom: 2px solid #ddd;
    }

    .modal-footer {
        border-top: 2px solid #ddd;
    }

    .pagination .page-link {
    font-size: 0.8rem; /* Réduit la taille du texte */
    padding: 5px 8px; /* Réduit l'espacement */
}

.pagination .page-item .page-link svg {
    width: 12px; /* Ajuste la taille des flèches */
    height: 12px;
}


.table-fixed {
    table-layout: fixed;
    width: 100%;
}

.table-fixed th, .table-fixed td {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.w-10 { width: 10%; }
.w-20 { width: 20%; }
.w-30 { width: 30%; }
.w-40 { width: 40%; }



</style>

<!-- Voir détails évaluateur et donner une decision coté Jury -->
<script>
$('#validationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    
    // Stocker l'ID dans le champ caché
    $('#candidatureId').val(id);
    
    $.ajax({
        url: window.location.origin + '/evaluator/validation-modal/' + id,
        method: 'GET',
        success: function(response) {
            if (response.success) {
                // Remplir les informations de base
                $('#nomStructure').text(response.candidature.nom_structure);
                $('#activiteStructure').text(response.candidature.activite);

                // Afficher la note globale (somme totale)
                $('#noteGlobale').text(response.candidature.note_totale);

                // Calculer et afficher la moyenne globale
                let nombreEvaluateurs = response.evaluateurNotes.length;
                let moyenneGlobale = nombreEvaluateurs > 0 
                    ? (response.candidature.note_totale / nombreEvaluateurs).toFixed(2) 
                    : '0.00';
                
                // Afficher la moyenne globale
                $('#moyenneGlobale').text(moyenneGlobale);
                
                // Mettre à jour la moyenne dans le tableau principal
                $(`#moyenne-${id}`).text(moyenneGlobale);

                // Remplir les coefficients des critères
                if (response.criteres) {
                    Object.keys(response.criteres).forEach(function(critereId) {
                        $(`#coef${critereId}`).text('×' + response.criteres[critereId].coefficient);
                    });
                }

               // Vider les conteneurs
               var tbody = $('#evaluationsTableBody');
               var observationsContainer = $('#observationsContainer');
               tbody.empty();
               observationsContainer.empty();

               if (!response.evaluateurNotes || response.evaluateurNotes.length === 0) {
                   tbody.html('<tr><td colspan="7" class="text-center">Aucune évaluation disponible</td></tr>');
                   return;
               }

               // Trier les évaluateurs par note totale décroissante
               response.evaluateurNotes.sort((a, b) => b.total - a.total);

               // Ajouter les lignes pour chaque évaluateur
               response.evaluateurNotes.forEach(function(evaluateur) {
                   // Ajouter ligne dans le tableau des notes
                   var row = $('<tr>');
                   row.append($('<td>').addClass('text-center font-weight-bold').text(evaluateur.nom));
                   
                   // Notes par critère
                   for (let i = 1; i <= 5; i++) {
                       let note = evaluateur.notes[i] || 0;
                       row.append($('<td>').addClass('text-center').text(note + '/10'));
                   }
                   
                   // Total de l'évaluateur
                   row.append($('<td>').addClass('text-center font-weight-bold')
                       .text(evaluateur.total + '/210'));
                   
                   tbody.append(row);

                   // Ajouter l'observation si elle existe
                   if (evaluateur.observation) {
                       var observationCard = `
                           <div class="card mb-3">
                               <div class="card-body">
                                   <div class="d-flex justify-content-between align-items-center mb-2">
                                       <h6 class="card-subtitle text-muted mb-0">
                                           <i class="fas fa-user mr-1"></i> ${evaluateur.nom}
                                       </h6>
                                       <small class="text-muted">
                                           <i class="fas fa-calendar-alt mr-1"></i> ${evaluateur.date}
                                       </small>
                                   </div>
                                   <p class="card-text mb-0">${evaluateur.observation}</p>
                               </div>
                           </div>
                       `;
                       observationsContainer.append(observationCard);
                   }
               });
           }
       },
       error: function(xhr) {
           console.error('Erreur lors de la récupération des notes:', xhr);
           $('#evaluationsTableBody').html(
               '<tr><td colspan="7" class="text-center text-danger">Une erreur est survenue lors du chargement des données</td></tr>'
           );
           $('#observationsContainer').html(
               '<div class="alert alert-danger">Une erreur est survenue lors du chargement des observations</div>'
           );
       }
   });
});

// Gestion du changement de statut
$('#validationStatus').on('change', function() {
   const submitButton = $('#submitJuryValidation');
   submitButton.prop('disabled', !$(this).val());
});


// Fonction de soumission de la décision du jury
function submitJuryValidation() {
    let observationJury = document.getElementById("juryObservation").value;
    let candidatureId = document.getElementById("candidatureId").value;
    let status = document.getElementById("validationStatus").value;
    let moyenneGlobale = document.getElementById("moyenneGlobale").textContent.trim(); // Récupérer la moyenne affichée

    console.log({
        candidatureId,
        status,
        observationJury,
        moyenneGlobale,
        csrf: $('meta[name="csrf-token"]').attr('content')
    });

    Swal.fire({
        title: "Êtes-vous sûr ?",
        text: "Cette action soumettra la décision du jury !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Oui, soumettre",
        cancelButtonText: "Annuler"
    }).then(function(result) {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route('evaluator.jury-validation') }}',
                method: 'POST',
                data: {
                    candidature_id: candidatureId,
                    status: status,
                    observation_jury: observationJury,
                    moyenne_finale: moyenneGlobale, // Envoi de la moyenne
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: "Succès",
                        text: response.message + "\nMoyenne finale enregistrée : " + response.note_finale,
                        icon: "success",
                        confirmButtonColor: "#28a745"
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Erreur",
                        text: xhr.responseJSON.message,
                        icon: "error",
                        confirmButtonColor: "#d33"
                    });
                }
            });
        }
    });
}



</script>

<script>
 document.addEventListener("DOMContentLoaded", function () {
    const lastActiveForm = localStorage.getItem("activeForm");
    const lastActiveButton = localStorage.getItem("activeButton");
    const hasReloaded = localStorage.getItem("hasReloaded");

    if (lastActiveForm) {
        showForm(lastActiveForm, lastActiveButton, false);
    }

    // Réinitialiser le flag après le chargement pour éviter la boucle
    localStorage.removeItem("hasReloaded");
});

function showForm(formId, buttonId, shouldReload = true) {
    if (!formId) return; // Évite les erreurs si formId est null

    localStorage.setItem("activeForm", formId);
    localStorage.setItem("activeButton", buttonId);

    // Cacher tous les formulaires
    document.querySelectorAll('.form-section').forEach(form => {
        form.style.display = 'none';
    });

    // Afficher le formulaire sélectionné
    const selectedForm = document.getElementById(formId);
    if (selectedForm) {
        selectedForm.style.display = 'block';
    }

    // Désactiver tous les boutons
    document.querySelectorAll('.card-tools a').forEach(button => {
        button.classList.remove('active');
    });

    // Activer le bouton sélectionné (si trouvé)
    if (buttonId) {
        const selectedButton = document.getElementById(buttonId);
        if (selectedButton) {
            selectedButton.classList.add('active');
        }
    }

    // Rafraîchir la page si on passe à "validatedForm" ou "evaluatedForm"
    if (["validatedForm", "evaluatedForm"].includes(formId) && shouldReload && !localStorage.getItem("hasReloaded")) {
        localStorage.setItem("hasReloaded", "true"); // Évite le rechargement en boucle
        location.reload();
    }
}


</script>


<script>
$('#detailsCandidatureModal').on('show.bs.modal', function (event) {
    // Récupérer le bouton qui a déclenché l'événement
    var button = $(event.relatedTarget);

    // Récupérer les valeurs des attributs data-* du bouton
    var nomStructure = button.data('nom-structure');
    var numDossier = button.data('num-dossier');
    var intituleActivite = button.data('intitule-activite');
    var descriptionActivite = button.data('description-activite');
    var effetImpact = button.data('effet-impact');
    var dateDebutIntervention = button.data('date-debut-intervention');
    var dateFinIntervention = button.data('date-fin-intervention');
    var zone_intervention = button.data('zone_intervention');

    // Récupération des fichiers
    var fichierNinea = button.data('fichier-ninea');
    var rapportActivite = button.data('rapport-activite');
    var fichierRccm = button.data('fichier-rccm');
    var fichierAgrement = button.data('fichier-agrement');

    // Récupération des nombres de personnes touchées
    var nbrHommeToucher = button.data('nbr-homme-toucher');
    var nbrFemmeToucher = button.data('nbr-femme-toucher');
    var nbrJeuneToucher = button.data('nbr-jeune-toucher');
    var nbrHandicapeToucher = button.data('nbr-handicape-toucher');

    // Récupération des zones d'intervention
    var regions = button.data('regions');
    var departements = button.data('departements');
    var communes = button.data('communes');

    // Récupération des cibles
    var cibles = button.data('cibles');

    // Remplir les champs du modal avec ces données
    $(this).find('#modal_nom_structure').text(nomStructure || '--');
    $(this).find('#modal_num_dossier').text(numDossier || '--');
    $(this).find('#modal_intitule_activite').text(intituleActivite || '--');
    $(this).find('#modal_description_activite').text(descriptionActivite || '--');
    $(this).find('#modal_effet_impact').text(effetImpact || '--');
    $(this).find('#modal_date_debut_intervention').text(dateDebutIntervention || '--');
    $(this).find('#modal_date_fin_intervention').text(dateFinIntervention || '--');
    $(this).find('#modal_zone_intervention').text(zone_intervention || '--');
    
    // Remplir les zones d'intervention
    $(this).find('#modal_regions').text(regions || '--');
    $(this).find('#modal_departements').text(departements || '--');
    $(this).find('#modal_communes').text(communes || '--');

    // Remplir les nombres de personnes touchées
    $(this).find('#modal_nbr_homme_toucher').text(nbrHommeToucher || '--');
    $(this).find('#modal_nbr_femme_toucher').text(nbrFemmeToucher || '--');
    $(this).find('#modal_nbr_jeune_toucher').text(nbrJeuneToucher || '--');
    $(this).find('#modal_nbr_handicape_toucher').text(nbrHandicapeToucher || '--');
    
    // Gestion des cibles (création de badges)
    var ciblesHtml = '';
    if (cibles) {
        // Split par ', ' pour gérer plusieurs cibles
        var ciblesArray = cibles.split(', ');
        ciblesArray.forEach(function(cible) {
            // Trim pour enlever les espaces potentiels
            cible = cible.trim();
            if (cible) {
                ciblesHtml += '<span class="badge badge-info mr-1">' + cible + '</span>';
            }
        });
    } 
    
    // Si aucune cible ou ciblesHtml vide
    if (!cibles || ciblesHtml.trim() === '') {
        ciblesHtml = '--';
    }

    // Trouver le tableau des cibles et supprimer toute ligne de cibles existante
    var tabCibles = $(this).find('table').last();
    
    // Supprimer l'ancienne ligne de populations ciblées si elle existe
    tabCibles.find('tr').each(function() {
        if ($(this).find('td:first').text().trim() === 'Populations Ciblées:') {
            $(this).remove();
        }
    });

    // Insérer la nouvelle ligne juste après l'en-tête
    var ciblesRow = $('<tr><td><strong>Populations Ciblées:</strong></td><td style="text-align: justify;">' + ciblesHtml + '</td></tr>');
    tabCibles.find('thead').next().prepend(ciblesRow);
    
// Fonction pour extraire le nom du fichier
function getFilename(filepath) {
    if (!filepath) return '';
    return filepath.split('/').pop();
}

// Mettre à jour les cellules du tableau avec les liens des fichiers
$('#modal_ninea').html(fichierNinea 
    ? `<a href="/evaluator/telecharger/ninea/${getFilename(fichierNinea)}" class="btn btn-sm btn-outline-primary" target="_blank">Télécharger</a>` 
    : 'Aucun fichier');

$('#modal_rapport_activite').html(rapportActivite 
    ? `<a href="/evaluator/telecharger/rapport/${getFilename(rapportActivite)}" class="btn btn-sm btn-outline-primary" target="_blank">Télécharger</a>` 
    : 'Aucun fichier');

$('#modal_rccm').html(fichierRccm 
    ? `<a href="/evaluator/telecharger/rccm/${getFilename(fichierRccm)}" class="btn btn-sm btn-outline-primary" target="_blank">Télécharger</a>` 
    : 'Aucun fichier');

$('#modal_agrement').html(fichierAgrement 
    ? `<a href="/evaluator/telecharger/agrement/${getFilename(fichierAgrement)}" class="btn btn-sm btn-outline-primary" target="_blank">Télécharger</a>` 
    : 'Aucun fichier');
});
</script>

<script>
   $(document).ready(function() {
    $('.btn-valider').on('click', function() {
        var candidatureId = $(this).data('id');
        console.log('ID de la candidature:', candidatureId);  // Vérifie l'ID

        // Affichage de la boîte de confirmation avec SweetAlert2
        Swal.fire({
            title: "Êtes-vous sûr ?",
            text: "Cette action validera la candidature !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Oui, valider",
            cancelButtonText: "Annuler"
        }).then(function(result) {
            if (result.isConfirmed) {
                // Si l'utilisateur confirme la validation, envoie la requête AJAX
                $.ajax({
                    url: '{{ route('candidatures.valider') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',  // Envoie le token CSRF
                        id: candidatureId,             // ID de la candidature
                        etat: 'validé'                 // Statut de la candidature à 'validé'
                    },
                    success: function(response) {
                        console.log(response); // Affiche la réponse du serveur dans la console
                        if (response.success) {
                            // Si la validation est réussie, affiche une notification et recharge la page
                            Swal.fire({
                                title: "Succès",
                                text: "Candidature validée avec succès !",
                                icon: "success",
                                confirmButtonColor: "#28a745"
                            }).then(function() {
                                location.reload(); // Recharge la page pour afficher les mises à jour
                            });
                        } else {
                            Swal.fire("Erreur", "Erreur lors de la validation.", "error");
                        }
                    },
                    error: function() {
                        // Affiche une erreur si la requête AJAX échoue
                        Swal.fire("Erreur", "Une erreur est survenue lors de la requête AJAX.", "error");
                    }
                });
            }
        });
    });



   
    $('.btn-rejeter').on('click', function() {
    var candidatureId = $(this).data('id');
    console.log('ID de la candidature à rejeter:', candidatureId);  // Vérifie l'ID

    // Affichage de la boîte de confirmation avec SweetAlert2
    Swal.fire({
        title: "Êtes-vous sûr ?",
        text: "Veuillez saisir un motif de rejet.",
        icon: "warning",
        input: 'textarea',  // Champ pour saisir le motif
        inputPlaceholder: 'Motif du rejet...',
        inputAttributes: {
            'style': 'height: 150px; width: 80%;'  // Ajuste la taille du textarea
        },
        showCancelButton: true,
        confirmButtonColor: "#d33",  // Couleur pour confirmer (rouge)
        cancelButtonColor: "#28a745",  // Couleur pour annuler (vert)
        confirmButtonText: "Oui, rejeter",
        cancelButtonText: "Annuler",
        preConfirm: function(motifRejet) {
            if (!motifRejet.trim()) {
                Swal.showValidationMessage('Le motif du rejet est obligatoire.');
            }
            return motifRejet.trim();
        }
    }).then(function(result) {
        if (result.isConfirmed) {
            var motifRejet = result.value;

            // Si le motif est valide, envoie la requête AJAX
            $.ajax({
                url: '{{ route('candidatures.rejeter') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  // Envoie le token CSRF
                    id: candidatureId,             // ID de la candidature
                    etat: 'rejeté',                // Statut de la candidature à 'rejeté'
                    motif_rejet: motifRejet        // Motif du rejet
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Succès",
                            text: "Candidature rejetée avec succès !",
                            icon: "success",
                            confirmButtonColor: "#d33"
                        }).then(function() {
                            location.reload(); // Recharge la page pour afficher les mises à jour
                        });
                    } else {
                        Swal.fire("Erreur", "Erreur lors du rejet de la candidature.", "error");
                    }
                },
                error: function() {
                    Swal.fire("Erreur", "Une erreur est survenue lors de la requête AJAX.", "error");
                }
            });
        }
    });
});

});

</script>

<!-- Script pour la gestion des étoiles et de la progress bar -->
<script>
    let isSubmitting = false; // Variable pour suivre l'état de soumission

    // Ajout d'étoiles aux critères
    document.querySelectorAll('.rating').forEach(function(ratingElement) {
        for (let i = 1; i <= 10; i++) {
            let star = document.createElement('span');
            star.textContent = '★';
            star.dataset.value = i;
            star.classList.add('star');
            star.addEventListener('click', function() {
                updateRating(ratingElement, i);
            });
            ratingElement.appendChild(star);
        }
    });

    function updateRating(ratingElement, value) {
        let stars = ratingElement.querySelectorAll('span');
        let criterion = ratingElement.dataset.criterion;
        let coefficient = getCoefficient(criterion);

        stars.forEach(function(star) {
            star.classList.remove('selected');
            if (parseInt(star.dataset.value) <= value) {
                star.classList.add('selected');
            }
        });

        let scoreElement = document.getElementById('score_' + criterion);
        if (scoreElement) {
            scoreElement.textContent = value;
        }

        // Retirer le contour rouge si une note a été sélectionnée
        ratingElement.style.border = '';

        updateTotalScore();
    }

    function getCoefficient(criterion) {
        const coefficients = {
            "zone_intervention": 4,
            "approche_innovante": 4,
            "cible": 5,
            "effet_impact": 5,
            "secteur_activite": 3
        };
        return coefficients[criterion] || 0;  // Par défaut, un coefficient de 1
    }

    function updateTotalScore() {
        let total = 0;
        let maxScore = 0;

        document.querySelectorAll('.rating').forEach(function(ratingElement) {
            let criterion = ratingElement.dataset.criterion;
            let selectedStars = ratingElement.querySelectorAll('span.selected').length;
            let coefficient = getCoefficient(criterion);
            total += selectedStars * coefficient;
            maxScore += 10 * coefficient;
        });

        document.getElementById('totalScore').textContent = total;
        let progress = (total / maxScore) * 100;
        document.getElementById('scoreProgressBar').style.width = progress + '%';
    }

    window.submitEvaluation = function() {
    // Vérifier si une soumission est déjà en cours
    if (isSubmitting) {
        toastr.warning('Une soumission est déjà en cours.');
        return;
    }

    isSubmitting = true; // Marquer le début de la soumission

    let candidatureId = document.getElementById('candidatureId')?.value;
    if (!candidatureId) {
        toastr.error('ID de candidature non trouvé');
        isSubmitting = false;
        return;
    }

    let comments = document.getElementById('comments').value;
    let valid = true;
    let ratings = [];

    // Mapping des noms de critères vers leurs IDs
    const critereMappings = {
        'zone_intervention': 1,
        'cible': 3,
        'secteur_activite': 5,
        'approche_innovante': 2,
        'effet_impact': 4
    };

    // Récupérer toutes les évaluations
    document.querySelectorAll('.rating').forEach(function(ratingElement) {
        let criterion = ratingElement.dataset.criterion;
        let selectedStars = ratingElement.querySelectorAll('span.selected').length;

        if (selectedStars === 0) {
            valid = false;
            ratingElement.style.border = '2px solid red';
        } else {
            // Convertir le nom du critère en ID
            let critereId = critereMappings[criterion];
            if (!critereId) {
                console.error('Critère non trouvé dans le mapping:', criterion);
                return;
            }

            ratings.push({
                id_critere: critereId,
                note_critere: selectedStars,
                observation: comments || null
            });
        }
    });

    if (!valid) {
        toastr.warning("Veuillez évaluer tous les critères.");
        isSubmitting = false;
        return;
    }

    let evaluationData = {
        candidature_id: parseInt(candidatureId),
        ratings: ratings
    };

    // Désactiver le bouton de soumission et afficher le spinner pour éviter les soumissions multiples
    let submitButton = document.getElementById("submitEvaluationButton");
    let submitButtonText = document.getElementById("submitButtonText");
    let submitButtonSpinner = document.getElementById("submitButtonSpinner");
    
    submitButton.disabled = true;
    submitButtonText.style.display = 'none';
    submitButtonSpinner.style.display = 'inline-block';

   // Effectuer la requête fetch pour envoyer les données au serveur
    fetch('/evaluator/enregistrerNote', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(evaluationData)
    })
    .then(response => {
        return response.json().then(data => ({
            ok: response.ok,
            status: response.status,
            body: data
        }));
    })
    .then(({ok, status, body}) => {
        console.log('Réponse du serveur:', {ok, status, body});

        if (!ok) {
            throw new Error(body.message || 'Erreur serveur');
        }

        if (body.success) {
            // Si l'évaluation a été soumise avec succès, fermer le modal et afficher un message de succès
            $('#evaluationModal').modal('hide');
            // toastr.success('Notes enregistrées avec succès');

            // Désactiver également le bouton "Évaluer" dans la liste des candidatures
            let candidatureId = evaluationData.candidature_id;
            $('button[data-id="' + candidatureId + '"]').prop('disabled', true);  // Désactiver le bouton "Évaluer"

            // Afficher SweetAlert2 avec un message de succès
            Swal.fire({
                title: 'Succès',
                text: 'Les notes ont été enregistrées avec succès.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // Recharger la page après un délai pour montrer les changements
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            });
        } else {
            toastr.error(body.message || 'Une erreur est survenue');
        }
    })
    .catch(error => {
        console.error('Erreur complète:', error);

        // Si une erreur se produit, réactiver le bouton "Soumettre" et afficher un message d'erreur
        submitButton.disabled = false;
        submitButtonText.style.display = 'inline';
        submitButtonSpinner.style.display = 'none';
        toastr.error(error.message || 'Une erreur est survenue lors de l\'enregistrement');
    })
    .finally(() => {
        isSubmitting = false; // Marquer la fin de la soumission
    });

}


    // Événement de fermeture du modal (si nécessaire pour réactiver les boutons)
    $('#evaluationModal').on('hidden.bs.modal', function () {
        let submitButton = document.querySelector('.modal-footer .btn-success');
        submitButton.disabled = false;
        submitButton.innerText = "Soumettre";
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".btn-evaluer").forEach(button => {
            button.addEventListener("click", function() {
                let candidatureId = this.getAttribute("data-id");
                document.getElementById("candidatureId").value = candidatureId;
            });
        });
    });
</script>

<script>
    // Lors de la soumission du formulaire d'évaluation (si tu utilises AJAX)
    function enregistrerNote() {
        @isset($candidature)
            let candidatureId = {{ $candidature->id }};
            let formData = {
                candidature_id: candidatureId,
                ratings: getRatings() // Fonction qui retourne les notes
            };

            // Exemple d'Ajax pour enregistrer les notes
            $.ajax({
                url: '/enregistrer-note', // URL de la méthode de contrôle
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Si la réponse indique que le bouton doit être désactivé
                        if (response.disable_button) {
                            $('#evaluateButton-' + candidatureId).attr('disabled', 'disabled');
                        }
                        alert(response.message);
                    } else {
                        alert('Erreur : ' + response.message);
                    }
                },
                error: function() {
                    alert('Une erreur s\'est produite.');
                }
            });
        @else
            console.error('La variable candidature n\'est pas définie.');
        @endisset
    }
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-restaurer").forEach(button => {
        button.addEventListener("click", async function (event) {
            event.preventDefault();

            let candidatureId = this.dataset.id;
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");

            if (!csrfToken) {
                Swal.fire("Erreur", "Token CSRF manquant !", "error");
                return;
            }

            // Utilisation de SweetAlert2 pour la confirmation
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Cette action restaurera la candidature !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, restaurer",
                cancelButtonText: "Annuler"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        let response = await fetch(`/evaluator/restaurer-candidature/${candidatureId}`, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken
                            },
                            body: JSON.stringify({ id: candidatureId })
                        });

                        let data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.message || `Erreur HTTP ${response.status}`);
                        }

                        Swal.fire({
                            title: "Succès",
                            text: "Candidature restaurée avec succès !",
                            icon: "success",
                            confirmButtonColor: "#28a745",
                            confirmButtonText: "OK"
                        }).then(() => {
                            location.reload(); // 🔄 Actualisation après confirmation
                        });

                    } catch (error) {
                        console.error("Erreur:", error);
                        Swal.fire("Erreur", "Une erreur est survenue. Vérifiez les logs.", "error");
                    }
                }
            });
        });
    });
});


$(document).ready(function () {
    $('.btn-evaluer').on('click', function () {
        let candidatureId = $(this).data('id'); 
        let zoneIntervention = $(this).data('zone-intervention') || 0;
        let cible = $(this).data('cible') || 0;
        let secteurActivite = $(this).data('secteur-activite') || 0;
        let approcheInnovante = $(this).data('approche-innovante') || 0;
        let effetImpact = $(this).data('effet-impact') || 0;
        let totalScore = $(this).data('total') || 0;
        let observation = $(this).data('observation') || ''; // ✅ Utiliser `observation`

        // Mettre à jour les valeurs affichées
        $('#score_zone_intervention').text(zoneIntervention);
        $('#score_cible').text(cible);
        $('#score_secteur_activite').text(secteurActivite);
        $('#score_approche_innovante').text(approcheInnovante);
        $('#score_effet_impact').text(effetImpact);
        $('#totalScore').text(totalScore);

        // ✅ Mettre à jour le champ commentaire avec `observation`
        $('#commentaire').val(observation); // Utiliser .val() pour textarea

        // Mettre à jour la barre de progression
        let progressPercentage = (totalScore / 210) * 100;
        $('#scoreProgressBar').css('width', progressPercentage + '%');

        // Tableau associatif pour relier les critères aux valeurs récupérées
        let scores = {
            "zone_intervention": zoneIntervention,
            "cible": cible,
            "secteur_activite": secteurActivite,
            "approche_innovante": approcheInnovante,
            "effet_impact": effetImpact
        };

        // ✅ Mettre à jour les étoiles correctement
        $('.rating').each(function () {
            let criterion = $(this).data('criterion'); 
            let score = scores[criterion] || 0; // Récupérer le score du critère

            $(this).children().removeClass('selected'); // Réinitialiser les étoiles
            $(this).children(':lt(' + score + ')').addClass('selected'); // Sélectionner les bonnes étoiles
        });
    });
});



</script>

@endsection
