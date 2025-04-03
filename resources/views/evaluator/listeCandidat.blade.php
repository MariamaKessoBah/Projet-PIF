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
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h3 class="card-title">Filtres</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                <div class="form-group">
                        <label>Type de structure</label>
                        <select class="form-control select2">
                            <option>Tous</option>
                            <option>IMF</option> 
                            <option>FinTech</option>
                            <option>PTF</option>
                            <option>ONG</option>
                            <option>Banques</option>
                            <option>Compagnies d'assurance</option>
                            <option>Entreprises sociales</option>
                            <option>Sociétés coopératives</option>
                            <option>Structures publiques</option>
                        </select>
                        </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Zone d'intervention</label>
                        <select class="form-control select2">
                            <option>Tous</option>
                            <option>Dakar</option>
                            <option>Thiès</option> 
                            <option>Fatick</option>
                            <option>Kaffrine</option>
                            
                        </select>               
                    </div>
                </div>
                <div class="col-md-3">
                        <div class="form-group d-flex justify-content-end align-items-end h-150">
                            <button class="btn btn-primary">
                                <i class="fas fa-search mr-1"></i> Rechercher
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- Liens vers les formulaires des actions, extrants et activités -->
    <!-- Boutons pour afficher les différents formulaires -->
    <div class="card-header d-flex justify-content-between align-items-center">
        @if(Auth::user()->role === 'evaluateur' || Auth::user()->role === 'DMIF')
        <div class="card-tools">
            <a id="btnReceived" 
            class="btn btn-block btn-sm btn-default btn-flat border-primary" 
            href="#" 
            onclick="showForm('receivedForm', 'btnReceived')">
                <i class="fa fa-plus"></i> Liste des candidatures reçues
            </a>
        </div>
        <div class="card-tools">
            <a id="btnRejected" 
            class="btn btn-block btn-sm btn-default btn-flat border-primary" 
            href="#" 
            onclick="showForm('rejectedForm', 'btnRejected')">
                <i class="fa fa-plus"></i> Liste des candidatures rejetées
            </a>
        </div>
        <div class="card-tools">
            <a id="btnValidated" 
            class="btn btn-block btn-sm btn-default btn-flat border-primary" 
            href="#" 
            onclick="showForm('validatedForm', 'btnValidated')">
                <i class="fa fa-plus"></i> Liste des candidatures validées
            </a>
        </div>
        @endif
        @if(Auth::user()->role === 'evaluateur' || Auth::user()->role === 'jury')
        <div class="card-tools">
            <a id="btnEvaluated" 
               class="btn btn-block btn-sm btn-default btn-flat border-primary" 
               href="#" 
               onclick="showForm('evaluatedForm', 'btnEvaluated')">
                <i class="fa fa-plus"></i> Liste des candidatures évaluées
            </a>
        </div>
    @endif
    
    </div>

    <!-- Formulaires / Tables -->
    <div class="card-body">
        @if(Auth::user()->role === 'evaluateur' || Auth::user()->role === 'DMIF')
            <div id="receivedForm" class="form-section">
                <h3 class="card-title">Liste des candidatures reçues</h3>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nom de structure</th>
                            <th>Intitulé de l'activité</th>
                            <th>Secteur</th>
                            {{-- <th>Date soumission</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>FINTECH Group SA</td>
                            <td>Digital Banking Solutions</td>
                            <td>Services Financiers</td>
                            {{-- <td>15/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if(Auth::user()->role === 'DMIF')

                                    <button class="btn btn-success btn-sm" title="Valider">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title="Rejeter">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>AquaPêche SARL</td>
                            <td>Aquaculture Moderne</td>
                            <td>Pêche et Aquaculture</td>
                            {{-- <td>20/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if(Auth::user()->role === 'DMIF')

                                <button class="btn btn-success btn-sm" title="Valider">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" title="Rejeter">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>AgriTech Innovation</td>
                            <td>Système d'Irrigation Intelligente</td>
                            <td>Agriculture et Agroalimentaire</td>
                            {{-- <td>25/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if(Auth::user()->role === 'DMIF')

                                <button class="btn btn-success btn-sm" title="Valider">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" title="Rejeter">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        

            <div id="validatedForm" class="form-section" style="display: none;">
                <h3 class="card-title">Liste des candidatures validées</h3>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Validée</th>
                            <th>Nom de structure</th>
                            <th>Intitulé de l'activité</th>
                            <th>Secteur</th>
                            {{-- <th>Date soumission</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <i class="fas fa-check-circle text-success" title="Validée"></i>
                            </td>
                            <td>FINTECH Group SA</td>
                            <td>Digital Banking Solutions</td>
                            <td>Services Financiers</td>
                            {{-- <td>15/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if(Auth::user()->role === 'evaluateur')
                                <button class="btn btn-primary btn-sm" title="Évaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-star"></i>
                                </button>
                                @endif
                                
                                {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                    <i class="fas fa-history"></i>
                                {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                    <i class="fas fa-history"></i>
                                </button> --}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fas fa-check-circle text-success" title="Validée"></i>
                            </td>
                            <td>AquaPêche SARL</td>
                            <td>Aquaculture Moderne</td>
                            <td>Pêche et Aquaculture</td>
                            {{-- <td>20/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if(Auth::user()->role === 'evaluateur')
                                <button class="btn btn-primary btn-sm" title="Évaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-star"></i>
                                </button>
                                @endif
                                
                                {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                    <i class="fas fa-history"></i>
                                
                                {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                    <i class="fas fa-history"></i>
                                </button> --}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fas fa-check-circle text-success" title="Validée"></i>
                            </td>
                            <td>AgriTech Innovation</td>
                            <td>Système d'Irrigation Intelligente</td>
                            <td>Agriculture et Agroalimentaire</td>
                            {{-- <td>25/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if(Auth::user()->role === 'evaluateur')
                                <button class="btn btn-primary btn-sm" title="Évaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-star"></i>
                                </button>
                                @endif
                                
                                {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                    <i class="fas fa-history"></i>
                                </button> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        

            <div id="rejectedForm" class="form-section" style="display: none;">
                <h3 class="card-title">Liste des candidatures rejetées</h3>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Rejetée</th>
                            <th>Nom de structure</th>
                            <th>Intitulé de l'activité</th>
                            <th>Motif rejet</th>
                            {{-- <th>Date soumission</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <i class="fas fa-times-circle text-danger" title="Rejetée"></i>
                            </td>
                            <td>FINTECH Group SA</td>
                            <td>Digital Banking Solutions</td>
                            <td>Services Financiers</td>
                            {{-- <td>15/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                {{-- <button class="btn btn-primary btn-sm" title="Évaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-star"></i>
                                </button> --}}
                                
                                {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                    <i class="fas fa-history"></i>
                                </button> --}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fas fa-times-circle text-danger" title="Rejetée"></i>
                            </td>
                            <td>AquaPêche SARL</td>
                            <td>Aquaculture Moderne</td>
                            <td>Pêche et Aquaculture</td>
                            {{-- <td>20/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                {{-- <button class="btn btn-primary btn-sm" title="Évaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-star"></i>
                                </button> --}}
                                
                                {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                    <i class="fas fa-history"></i>
                                </button> --}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="fas fa-times-circle text-danger" title="Rejetée"></i>
                            </td>
                            <td>AgriTech Innovation</td>
                            <td>Système d'Irrigation Intelligente</td>
                            <td>Agriculture et Agroalimentaire</td>
                            {{-- <td>25/01/2025</td> --}}
                            <td>
                                <button class="btn btn-info btn-sm" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </button>
                                {{-- <button class="btn btn-primary btn-sm" title="Évaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-star"></i>
                                </button> --}}
                                
                                {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                    <i class="fas fa-history"></i>
                                </button> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

        <div id="evaluatedForm" class="form-section" style="display: none;">
            <h3 class="card-title">Liste des candidatures évaluées</h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nom de structure</th>
                        <th>Intitulé de l'activité</th>
                        <th>Secteur</th>
                        <th>Evaluateurs</th>
                        {{-- <th>Nombre de points</th> --}}
                        {{-- <th>Date soumission</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>FINTECH Group SA</td>
                        <td>Digital Banking Solutions</td>
                        <td>Services Financiers</td>
                        <td>100</td>
                        {{-- <td>15/01/2025</td> --}}
                        <td>
                            <button class="btn btn-info btn-sm" title="Voir détails">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if(Auth::user()->role === 'jury')
                                <button class="btn btn-primary btn-sm" title="Valider" data-toggle="modal" data-target="#validationModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                            @if(Auth::user()->role === 'evaluateur')
                                <button class="btn btn-primary btn-sm" title="Evaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                            {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                <i class="fas fa-history"></i>
                            </button> --}}
                        </td>
                    </tr>
                    <tr>
        
                        <td>AquaPêche SARL</td>
                        <td>Aquaculture Moderne</td>
                        <td>Pêche et Aquaculture</td>
                        <td>109</td>
                        {{-- <td>20/01/2025</td> --}}
                        <td>
                            <button class="btn btn-info btn-sm" title="Voir détails">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if(Auth::user()->role === 'jury')
                                <button class="btn btn-primary btn-sm" title="Valider" data-toggle="modal" data-target="#validationModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                            @if(Auth::user()->role === 'evaluateur')
                                <button class="btn btn-primary btn-sm" title="Evaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                            
                            {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                <i class="fas fa-history"></i>
                            </button> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>AgriTech Innovation</td>
                        <td>Système d'Irrigation Intelligente</td>
                        <td>Agriculture et Agroalimentaire</td>
                        <td>99</td>
                        {{-- <td>25/01/2025</td> --}}
                        <td>
                            <button class="btn btn-info btn-sm" title="Voir détails">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if(Auth::user()->role === 'jury')
                                <button class="btn btn-primary btn-sm" title="Valider" data-toggle="modal" data-target="#validationModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                            @if(Auth::user()->role === 'evaluateur')
                                <button class="btn btn-primary btn-sm" title="Evaluer" data-toggle="modal" data-target="#evaluationModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                            
                            {{-- <button class="btn btn-secondary btn-sm" title="Historique">
                                <i class="fas fa-history"></i>
                            </button> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Modal d'évaluation -->
<div class="modal fade" id="evaluationModal" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- En-tête du modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="evaluationModalLabel">Évaluation de la candidature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Corps du modal -->
            <div class="modal-body">
                <form id="evaluationForm">
                    <!-- Critère : Zone d'intervention -->
                    <div class="form-group">
                        <label for="zone_intervention">Zone d'intervention</label>
                        <input type="number" id="zone_intervention" class="form-control" min="1" max="10" placeholder="Entrez une note entre 1 et 10">
                    </div>
                    
                    <!-- Critère : Cible -->
                    <div class="form-group">
                        <label for="cible">Cible</label>
                        <input type="number" id="cible" class="form-control" min="1" max="10" placeholder="Entrez une note entre 1 et 10">
                    </div>
                    
                    <!-- Critère : Secteur d'activité -->
                    <div class="form-group">
                        <label for="secteur_activite">Secteur d'activité</label>
                        <input type="number" id="secteur_activite" class="form-control" min="1" max="10" placeholder="Entrez une note entre 1 et 10">
                    </div>
                    
                    <!-- Critère : Innovation -->
                    <div class="form-group">
                        <label for="innovation">Approche innovante</label>
                        <input type="number" id="innovation" class="form-control" min="1" max="10" placeholder="Entrez une note entre 1 et 10">
                    </div>
                    
                    <div class="form-group">
                        <label>Effets/impacts<span class="text-danger"></span></label>
                        <input type="number" id="innovation" class="form-control" min="1" max="10" placeholder="Entrez une note entre 1 et 10">
                    </div>
     
                    <!-- Commentaires supplémentaires -->
                    <div class="form-group">
                        <label for="comments">Observations</label>
                        <textarea id="comments" class="form-control" rows="3" placeholder="Ajouter des commentaires..."></textarea>
                    </div>
                     
                    
                </form>
            </div>
            <!-- Pied de page du modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="submitEvaluation()">Soumettre</button>
            </div>
        </div>
    </div>
</div>

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
                            <div class="col-md-4">
                                <div class="info-group">
                                    <label class="text-muted">Nom de la Structure</label>
                                    <p class="h6" id="nomStructure">-</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-group">
                                    <label class="text-muted">Activité</label>
                                    <p class="h6" id="activiteStructure">-</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-group">
                                    <label class="text-muted">Moyenne globale</label>
                                    <p class="h6">
                                        <span id="moyenneGlobale" class="badge badge-primary">-</span>/10
                                    </p>
                                </div>
                            </div>
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
                                        <tr>
                                            <td class="text-center font-weight-bold">Dr. Amadou Diallo</td>
                                            <td class="text-center">8/10</td>
                                            <td class="text-center">7/10</td>
                                            <td class="text-center">9/10</td>
                                            <td class="text-center">8/10</td>
                                            <td class="text-center">7/10</td>
                                            <td class="text-center font-weight-bold">39/50</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center font-weight-bold">Pr. Fatou Sall</td>
                                            <td class="text-center">9/10</td>
                                            <td class="text-center">8/10</td>
                                            <td class="text-center">8/10</td>
                                            <td class="text-center">9/10</td>
                                            <td class="text-center">8/10</td>
                                            <td class="text-center font-weight-bold">42/50</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center font-weight-bold">M. Omar Ndiaye</td>
                                            <td class="text-center">7/10</td>
                                            <td class="text-center">8/10</td>
                                            <td class="text-center">9/10</td>
                                            <td class="text-center">7/10</td>
                                            <td class="text-center">8/10</td>
                                            <td class="text-center font-weight-bold">39/50</td>
                                        </tr>
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
                                <!-- Observation Évaluateur 1 -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="card-subtitle text-muted mb-0">
                                                <i class="fas fa-user mr-1"></i> Dr. Amadou Diallo
                                            </h6>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt mr-1"></i> 15/01/2025
                                            </small>
                                        </div>
                                        <p class="card-text mb-0">
                                            Projet prometteur avec une bonne approche innovante. La zone d'intervention est bien définie et les objectifs sont clairs. Quelques ajustements mineurs pourraient être nécessaires concernant l'impact à long terme.
                                        </p>
                                    </div>
                                </div>

                                <!-- Observation Évaluateur 2 -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="card-subtitle text-muted mb-0">
                                                <i class="fas fa-user mr-1"></i> Pr. Fatou Sall
                                            </h6>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt mr-1"></i> 16/01/2025
                                            </small>
                                        </div>
                                        <p class="card-text mb-0">
                                            Excellente proposition avec une forte composante d'innovation. Le projet répond parfaitement aux besoins du secteur et présente un bon potentiel de scaling. La méthodologie est bien structurée et les résultats attendus sont réalistes.
                                        </p>
                                    </div>
                                </div>

                                <!-- Observation Évaluateur 3 -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="card-subtitle text-muted mb-0">
                                                <i class="fas fa-user mr-1"></i> M. Omar Ndiaye
                                            </h6>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt mr-1"></i> 17/01/2025
                                            </small>
                                        </div>
                                        <p class="card-text mb-0">
                                            Bon projet avec des objectifs alignés sur les priorités du secteur. Le ciblage est pertinent et la stratégie d'intervention est cohérente. Suggestion d'amélioration sur l'aspect innovation qui pourrait être renforcé.
                                        </p>
                                    </div>
                                </div>
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
                                <option value="rejete" class="text-danger">✕ Rejeter les évaluations</option>
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
</style>

<script>
// Le script JavaScript reste le même, juste ajoutez ces classes dans le HTML généré
function updateEvaluationRow(eval) {
    // Définition des coefficients pour chaque critère
    const coefficients = {
        zone_intervention: 4 ,
        cible: 5,
        secteur_activite: 3,
        innovation: 6,
        impacts: 5
    };

    // Calcul du total pondéré
    const totalPondere = (
        (parseFloat(eval.zone_intervention) * coefficients.zone_intervention) +
        (parseFloat(eval.cible) * coefficients.cible) +
        (parseFloat(eval.secteur_activite) * coefficients.secteur_activite) +
        (parseFloat(eval.innovation) * coefficients.innovation) +
        (parseFloat(eval.impacts) * coefficients.impacts)
    );

    // Formatage du total avec 2 décimales
    const formattedTotal = totalPondere.toFixed(2);

    return `
        <tr>
            <td class="text-center font-weight-bold">${eval.evaluateur}</td>
            <td class="text-center">
                ${eval.zone_intervention}/10
                <small class="text-muted d-block">Coef: ${coefficients.zone_intervention * 100}%</small>
            </td>
            <td class="text-center">
                ${eval.cible}/10
                <small class="text-muted d-block">Coef: ${coefficients.cible * 100}%</small>
            </td>
            <td class="text-center">
                ${eval.secteur_activite}/10
                <small class="text-muted d-block">Coef: ${coefficients.secteur_activite * 100}%</small>
            </td>
            <td class="text-center">
                ${eval.innovation}/10
                <small class="text-muted d-block">Coef: ${coefficients.innovation * 100}%</small>
            </td>
            <td class="text-center">
                ${eval.impacts}/10
                <small class="text-muted d-block">Coef: ${coefficients.impacts * 100}%</small>
            </td>
            <td class="text-center font-weight-bold">${formattedTotal}/10</td>
            <td class="text-center">
                <span class="badge ${getStatusBadgeClass(eval.statut)}">
                    ${eval.statut || 'En attente'}
                </span>
            </td>
        </tr>
    `;
}

// Fonction pour calculer la moyenne globale en tenant compte des coefficients
function calculateGlobalAverage(evaluations) {
    if (!evaluations || evaluations.length === 0) return 0;

    const coefficients = {
        zone_intervention: 4 ,
        cible: 5,
        secteur_activite: 3,
        innovation: 6,
        impacts: 5
    };

    const sum = evaluations.reduce((acc, eval) => {
        const evalTotal = (
            (parseFloat(eval.zone_intervention) * coefficients.zone_intervention) +
            (parseFloat(eval.cible) * coefficients.cible) +
            (parseFloat(eval.secteur_activite) * coefficients.secteur_activite) +
            (parseFloat(eval.innovation) * coefficients.innovation) +
            (parseFloat(eval.impacts) * coefficients.impacts)
        );
        return acc + evalTotal;
    }, 0);

    return (sum / evaluations.length).toFixed(2);
}

// Fonction auxiliaire pour les badges de statut
function getStatusBadgeClass(statut) {
    switch(statut?.toLowerCase()) {
        case 'validé':
            return 'badge-success';
        case 'rejeté':
            return 'badge-danger';
        case 'en révision':
            return 'badge-warning';
        default:
            return 'badge-secondary';
    }
}

function updateObservation(eval) {
    return `
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="card-subtitle text-muted mb-0">
                        <i class="fas fa-user mr-1"></i> ${eval.evaluateur}
                    </h6>
                    <small class="text-muted">
                        <i class="fas fa-calendar-alt mr-1"></i> ${eval.date_evaluation}
                    </small>
                </div>
                <p class="card-text mb-0">${eval.observation}</p>
            </div>
        </div>
    `;
}
</script>
<script>
  function showForm(formId, buttonId) {
        // Cache all form sections
        const forms = document.querySelectorAll('.form-section');
        forms.forEach((form) => {
            form.style.display = 'none'; // Hide all forms
        });

        // Show the selected form
        const selectedForm = document.getElementById(formId);
        if (selectedForm) {
            selectedForm.style.display = 'block';
        }

        // Deactivate all buttons
        const buttons = document.querySelectorAll('.card-tools a');
        buttons.forEach((button) => {
            button.classList.remove('active');
        });

        // Activate the clicked button
        const selectedButton = document.getElementById(buttonId);
        if (selectedButton) {
            selectedButton.classList.add('active');
        }
    }

    function submitEvaluation() {
    const zone_intervention = document.getElementById('zone_intervention').value;
    const cible = document.getElementById('cible').value;
    const secteur_activite = document.getElementById('secteur_activite').value;
    const innovation = document.getElementById('innovation').value;
    const comments = document.getElementById('comments').value;

    // Ajouter la logique d'envoi des données au serveur ici
    console.log(`Zone d'intervention: ${zone_intervention}`);
    console.log(`Cible: ${cible}`);
    console.log(`Secteur d'activité: ${secteur_activite}`);
    console.log(`Innovation: ${innovation}`);
    console.log(`Commentaires: ${comments}`);

    // Fermer le modal après soumission
    $('#evaluationModal').modal('hide');
}

document.querySelectorAll('.btn-success').forEach(button => {
    button.addEventListener('click', function() {
        alert("Candidature validée !");
    });
});

document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function() {
        alert("Candidature rejetée !");
    });
});


</script>
@endsection
<!-- CSS -->
<style>
    .card-tools a.active {
        background-color: #007bff;
        color: white;
    }
    .icon-small {
        font-size: 5px !important; /* Force la taille des icônes */
    }
</style>
