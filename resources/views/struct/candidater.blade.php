@extends('layouts.template')

@section('title', 'Candidature')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Candidature</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr class="border-primary">
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <section class="content">
        <div class="container-fluid">

            <!-- Message d'avertissement -->
            
            <!-- Notifications -->
            <div id="notifications">
                @if (!isset($structure->nom_structure) && !session('success'))
                    <div class="alert alert-warning text-center mt-3" id="alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        Le formulaire de candidature n'est actif qu'après avoir rempli correctement les informations de votre structure.
                    </div>
                @endif

                
            </div>


        
        

            <div class="row mb-4">
                <div class="col-12">
                    <div class="mb-3 text-right">
                        <a href="{{ asset('Fiche_Description_BP2.pdf') }}" 
                          class="btn btn-primary" 
                          target="_blank"
                          title="Télécharger le guide de candidature">
                          <i class="fas fa-file-download"></i> Télécharger le guide
                        </a>
                      </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Actions Rapides</h3>
                        </div>
                        <div class="card-body">
                            @php
                                $profilComplet = isset($structure);
                                $aucuneCandidature = $candidatures->isEmpty();
                                $candidatureDejaSoumise = $candidatures->isNotEmpty();
                            @endphp

                            <div class="btn-group w-100">
                                <!-- Bouton "Informations de votre structure" -->
                                <button type="button" 
                                        class="btn btn-info"
                                        data-toggle="{{ $profilComplet ? '' : 'modal' }}" 
                                        data-target="#inscritProfileModal"
                                        {{ $profilComplet ? 'disabled' : '' }}
                                        title="{{ $profilComplet ? 'Informations déjà renseignées' : 'Complétez d\'abord votre profil' }}">
                                    <i class="fas fa-edit"></i> 
                                    {{ $profilComplet ? 'Informations déjà renseignées' : 'Informations de votre structure' }}
                                </button>
                                
                                <button type="button" 
                                        class="btn btn-success" 
                                        data-toggle="{{ $profilComplet && $aucuneCandidature ? 'modal' : '' }}" 
                                        data-target="#newCandidatureModal"
                                        {{ !$profilComplet || !$aucuneCandidature ? 'disabled' : '' }}
                                        title="{{ !$profilComplet ? 'Complétez d\'abord votre profil' : ($candidatureDejaSoumise ? 'Candidature déjà soumise' : 'Nouvelle candidature') }}">
                                    <i class="fas fa-plus"></i>
                                    {{ !$profilComplet ? 'Complétez votre profil' : ($candidatureDejaSoumise ? 'Candidature déjà soumise' : 'Nouvelle candidature') }}
                                </button>
                        
                        

                            </div>

                        </div>
                    </div>
                </div>
            </div>        


            <!-- Modal Enregistrer Profil -->
            <div class="modal fade" id="inscritProfileModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modifier les informations</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="" id="myForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Informations Structure -->
                                        <div class="form-group">
                                            <label>Nom Structure <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nom_structure" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Type <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="type-structure" name="type" required>
                                                <option value="Entreprise sociale">Entreprise sociale</option>
                                                <option value="Société coopérative">Société coopérative</option>
                                                <option value="IMF">IMF</option>
                                                <option value="FINTECH">FINTECH</option>
                                                <option value="ONG">ONG</option>
                                                <option value="Banque">Banque</option>
                                                <option value="Compagnie d'assurance">Compagnie d'assurance</option>
                                                <option value="Structure publique">Structure publique</option>
                                                <option value="GIE">GIE</option>
                                                <option value="Association">Association</option>
                                                <option value="Fondation">Fondation</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Statut juridique <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="statut-juridique" name="statut_juridique" required>
                                                <option value="SA">SA</option>
                                                <option value="SARL">SARL</option>
                                                <option value="SAS">SAS</option>
                                                <option value="SCS">SCS</option>
                                                <option value="SCA">SCA</option>
                                                <option value="SCOP">SCOP</option>
                                                <option value="SNC">SNC</option>
                                                <option value="SCIC">SCIC</option>
                                                <option value="SCM">SCM</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Siège Social <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="siege_social" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Date Création <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="date_creation" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Téléphone <span class="text-danger">*</span></label>
                                            <input type="tel" placeholder="XXXXXXXXX" class="form-control" name="tel_structure" required maxlength="9" pattern="[0-9]{9}" title="Le numéro doit contenir exactement 9 chiffres" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        </div>
                                        <div class="form-group">
                                            <label>Numéro d'immatriculation <span class="text-danger">*</span></label>
                                            <select class="form-control select2 text-dark" id="numero_immatriculation" name="numero_immatriculation[]" multiple required>
                                                <option value="NINEA">NINEA</option>
                                                <option value="Registre de commerce">Registre de commerce</option>
                                                <option value="Agreement">Agrément</option>
                                                <option value="Decret">Decret</option>
                                            </select>
                                            <div class="mt-2">
                                                <small class="text-muted">Vous pouvez sélectionner un ou plusieurs</small>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group d-none" id="field-ninea">
                                            <label>NINEA</label>
                                            <input type="text" class="form-control" name="ninea">
                                        </div>
                                        
                                        <div class="form-group d-none" id="field-registre_commerce">
                                            <label>Registre de commerce</label>
                                            <input type="text" class="form-control" name="registre_commerce">
                                        </div>
                                        
                                        <div class="form-group d-none" id="field-agreement">
                                            <label>Agrément</label>
                                            <input type="text" class="form-control" name="agreement">
                                        </div>
                                        
                                        <div class="form-group d-none" id="field-num_decret">
                                            <label>Decret</label>
                                            <input type="text" class="form-control" name="num_decret">
                                        </div>
                                        
                                    </div>
                        
                                    <!-- Contact Principal -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nom Contact</label>
                                            <input type="text" class="form-control" name="nom_contact" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Prénom Contact</label>
                                            <input type="text" class="form-control" name="prenom_contact" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Fonction</label>
                                            <input type="text" class="form-control" name="fonction_contact" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Téléphone</label>
                                            <input type="tel" placeholder="XXXXXXXXX" class="form-control" name="tel_contact" required maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email_contact" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Enregistrer</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>

            <!-- Modal Modifier Profil -->
            <div class="modal fade" id="editProfileModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <i class="fas fa-pencil-alt"></i>
                        <h5 class="modal-title">Modifier les informations</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        </div>
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Informations Structure -->
                                        <div class="form-group">
                                            <label>Nom Structure <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nom_structure" value="{{ $structure->nom_structure ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Type <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="type-structure" name="type" required>
                                                <option value="Entreprise sociale" {{ ($structure->type ?? '') == 'Entreprise sociale' ? 'selected' : '' }}>Entreprise sociale</option>
                                                <option value="Société coopérative" {{ ($structure->type ?? '') == 'Société coopérative' ? 'selected' : '' }}>Société coopérative</option>
                                                <option value="IMF" {{ ($structure->type ?? '') == 'IMF' ? 'selected' : '' }}>IMF</option>
                                                <option value="FINTECH" {{ ($structure->type ?? '') == 'FINTECH' ? 'selected' : '' }}>FINTECH</option>
                                                <option value="ONG" {{ ($structure->type ?? '') == 'ONG' ? 'selected' : '' }}>ONG</option>
                                                <option value="Banque" {{ ($structure->type ?? '') == 'Banque' ? 'selected' : '' }}>Banque</option>
                                                <option value="Compagnie d'assurance" {{ ($structure->type ?? '') == 'Compagnie d\'assurance' ? 'selected' : '' }}>Compagnie d'assurance</option>
                                                <option value="Structure publique" {{ ($structure->type ?? '') == 'Structure publique' ? 'selected' : '' }}>Structure publique</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Statut juridique <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="statut-juridique" name="statut_juridique" required>
                                                <option value="" disabled selected>-- Sélectionner un statut --</option>
                                                <option value="SA" {{ (isset($structure) && $structure->statut_juridique == 'SA') ? 'selected' : '' }}>SA</option>
                                                <option value="SARL" {{ (isset($structure) && $structure->statut_juridique == 'SARL') ? 'selected' : '' }}>SARL</option>
                                                <option value="SAS" {{ (isset($structure) && $structure->statut_juridique == 'SAS') ? 'selected' : '' }}>SAS</option>
                                                <option value="SCS" {{ (isset($structure) && $structure->statut_juridique == 'SCS') ? 'selected' : '' }}>SCS</option>
                                                <option value="SCA" {{ (isset($structure) && $structure->statut_juridique == 'SCA') ? 'selected' : '' }}>SCA</option>
                                                <option value="SCOP" {{ (isset($structure) && $structure->statut_juridique == 'SCOP') ? 'selected' : '' }}>SCOP</option>
                                                <option value="SNC" {{ (isset($structure) && $structure->statut_juridique == 'SNC') ? 'selected' : '' }}>SNC</option>
                                                <option value="SCIC" {{ (isset($structure) && $structure->statut_juridique == 'SCIC') ? 'selected' : '' }}>SCIC</option>
                                                <option value="SCM" {{ (isset($structure) && $structure->statut_juridique == 'SCM') ? 'selected' : '' }}>SCM</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Siège Social <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="siege_social" value="{{ $structure->siege_social ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Date Création <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="date_creation" value="{{ $structure->date_creation ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Téléphone <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="tel_structure" value="{{ $structure->tel_structure ?? '' }}" required>
                                        </div>
                                        
                                       
                                        
                                        <div class="form-group">
                                            <label>NINEA</label>
                                            <input type="text" class="form-control" name="ninea" value="{{ $structure->ninea ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Registre de commerce</label>
                                            <input type="text" class="form-control" name="registre_commerce" value="{{ $structure->registre_commerce ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Agrément</label>
                                            <input type="text" class="form-control" name="agreement" value="{{ $structure->agreement ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Décret</label>
                                            <input type="text" class="form-control" name="num_decret" value="{{ $structure->num_decret ?? '' }}">
                                        </div>
                                     
                                    </div>
                    
                                    <!-- Contact Principal -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nom Contact</label>
                                            <input type="text" class="form-control" name="nom_contact" value="{{ $structure->nom_contact ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Prénom Contact</label>
                                            <input type="text" class="form-control" name="prenom_contact" value="{{ $structure->prenom_contact ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Fonction</label>
                                            <input type="text" class="form-control" name="fonction_contact" value="{{ $structure->fonction_contact ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Téléphone</label>
                                            <input type="tel" class="form-control" name="tel_contact" value="{{ $structure->tel_contact ?? '' }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email_contact" value="{{ $structure->email_contact ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>Annuler</button>
                                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        
            <!-- Modal Nouvelle Candidature -->
            <div class="modal fade" id="newCandidatureModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Renseigner votre candidature</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('structure.storeCandidature') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <!-- Étape 1 -->
                                <div class="step step-1 active">
                                    <h5>Étape 1 : Informations générales</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">*
                                                <label>Structure <span class="text-danger">*</span></label>
                                                <span class="tooltip-info" data-toggle="tooltip" title="Indiquez le type de structure (ex : entreprise, ONG, etc.). Ce champ permet de définir la catégorie de votre organisation pour mieux comprendre son rôle dans l'activité proposée.">
                                                    <i class="fas fa-info-circle info-icon" style="cursor: pointer;"></i>
                                                </span>
                                                <input type="text" class="form-control" name="type" value="{{ $structure->type ?? '' }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Intitulé de l'activité <span class="text-danger">*</span></label>
                                                <span class="tooltip-info" data-toggle="tooltip" title="Indiquez le type de structure (ex : entreprise, ONG, etc.). Ce champ permet de définir la catégorie de votre organisation pour mieux comprendre son rôle dans l'activité proposée.">
                                                    <i class="fas fa-info-circle info-icon" style="cursor: pointer;"></i>
                                                </span>
                                                <input type="text" class="form-control" name="intitule_activite" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Présentation de l'activité<span class="text-danger">*</span></label>
                                                <span class="tooltip-info" data-toggle="tooltip" title="Quel est l’objectif de la présente fiche descriptive, la destination ? Quel est le contexte (la situation de départ du dispositif), la problématique essentielle soulevée. Donnez une brève définition de la BP 
                                                        Expliquez comment elle contribue à apporter des solutions innovantes dans le secteur 
">
                                                    <i class="fas fa-info-circle info-icon" style="cursor: pointer;"></i>
                                                </span>
                                                <textarea class="form-control" name="description_activite" required></textarea>
                                                
                                            </div>
                                        </div>
                                
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Effets/Impacts <span class="text-danger">*</span></label>
                                                <span class="tooltip-info" data-toggle="tooltip" title="Indiquez le type de structure (ex : entreprise, ONG, etc.). Ce champ permet de définir la catégorie de votre organisation pour mieux comprendre son rôle dans l'activité proposée.">
                                                    <i class="fas fa-info-circle info-icon" style="cursor: pointer;"></i>
                                                </span>
                                                <textarea class="form-control" name="effet_impact" rows="4" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Innovation dans l'activité <span class="text-danger">*</span></label>
                                                <span class="tooltip-info" data-toggle="tooltip" title="Indiquez le type de structure (ex : entreprise, ONG, etc.). Ce champ permet de définir la catégorie de votre organisation pour mieux comprendre son rôle dans l'activité proposée.">
                                                    <i class="fas fa-info-circle info-icon" style="cursor: pointer;"></i>
                                                </span>
                                                <textarea class="form-control" name="innovation" rows="4" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                          <!-- Étape 2 -->
                            <div class="step step-2">
                                <h5>Étape 2 : Zone d'intervention</h5>

                                <div class="form-group">
                                    <!-- Zone d'intervention -->
                                    <label>Zone d'intervention <span class="text-danger">*</span></label>
                                    <!-- Case à cocher pour sélectionner National -->
                                    <div class="col-md-12 mt-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="national" name="national" value="1">
                                            <label class="form-check-label" for="national">Sélectionner l'intervention à l'échelle nationale</label>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Si vous cochez cette option, l'intervention sera considérée comme nationale, sans sélection spécifique des régions, départements ou communes.</small>
                                        </div>
                                    </div>

                                    <div class="row" id="zone-intervention">
                                        <!-- Colonne 1: Régions et Départements -->
                                        <div class="col-md-6" id="regions-departements">
                                            <div class="form-group">
                                                <label>Régions</label>
                                                <select class="form-control select2" name="regions[]" multiple>
                                                    @foreach($regions as $region)
                                                        <option value="{{ $region->id }}">{{ $region->nom_region }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="mt-2">
                                                    <small class="text-muted">Vous pouvez sélectionner plusieurs régions</small>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Départements</label>
                                                <select class="form-control select2" name="departements[]" multiple>
                                                    @foreach($departements as $departement)
                                                        <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="mt-2">
                                                    <small class="text-muted">Vous pouvez sélectionner plusieurs départements</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Colonne 2: Communes -->
                                        <div class="col-md-6" id="communes">
                                            <div class="form-group">
                                                <label>Communes</label>
                                                <select class="form-control select2" name="communes[]" multiple>
                                                    @foreach($communes as $commune)
                                                        <option value="{{ $commune->id }}">{{ $commune->nom_commune }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="mt-2">
                                                    <small class="text-muted">Vous pouvez sélectionner plusieurs communes</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                               <!-- Étape 3 -->
                            <div class="step step-3">
                                <h5>Étape 3 : Période et secteur d’intervention</h5>
                                <div class="row form-group p-3 border rounded shadow-sm">
                                    <!-- Première colonne : Date et Secteur -->
                                    <div class="col-md-6 pr-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Date début <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="date_debut_intervention" required min="2018-01-01">
                                            </div>
                                            <div class="col-md-12">
                                                <label>Date fin <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="date_fin_intervention" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Secteur d'activité <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="secteurs[]" id="secteur_select" multiple required>
                                                    @foreach($secteur_interventions as $secteur_intervention)
                                                        <option value="{{ $secteur_intervention->id }}">{{ $secteur_intervention->designation_secteur }}</option>
                                                    @endforeach
                                                    <option value="autre">Autre</option>
                                                </select>
                                                <div class="mt-2">
                                                    <small class="text-muted">Vous pouvez sélectionner plusieurs secteurs d'activité</small>
                                                </div>
                                                <!-- Champ de saisie caché par défaut -->
                                                <div id="autre_secteur_input" style="display: none; margin-top: 10px;">
                                                    <label for="secteur_autre">Veuillez spécifier l'autre secteur</label>
                                                    <input type="text" class="form-control" id="secteur_autre" name="secteur_autre" placeholder="Entrez le secteur">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Deuxième colonne : Cibles et Population touchée -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 form-group p-3 border rounded shadow-sm">
                                                <label>Cibles <span class="text-danger">*</span></label>
                                                <select class="form-control select2" multiple name="cibles[]" required>
                                                    @foreach($cible_activites as $cible_activite)
                                                        <option value="{{ $cible_activite->id }}">{{ $cible_activite->designation_cible }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="mt-2">
                                                    <small class="text-muted">Vous pouvez sélectionner plusieurs cibles</small>
                                                </div>
                                            </div>

                                            <label class="fw-bold">Population touchée</label>

                                            <div class="row form-group p-3 border rounded shadow-sm">
                                                <div class="col-md-6">
                                                    <div class="cible-item">
                                                        <label>Nombre d'hommes :</label>
                                                        <input type="number" name="nbr_homme" min="0" class="form-control">
                                                    </div>
                                                    <div class="cible-item">
                                                        <label>Nombre de femmes :</label>
                                                        <input type="number" name="nbr_femme" min="0" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="cible-item">
                                                        <label>Nombre de jeunes :</label>
                                                        <input type="number" name="nbr_jeune" min="0" class="form-control">
                                                    </div>
                                                    <div class="cible-item">
                                                        <label>Nombre d'handicapés :</label>
                                                        <input type="number" name="nbr_handicape" min="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- Étape 4 -->
                                <div class="step step-4">
                                    <h5>Étape 4 : Documents justificatifs</h5>
                                    <div class="form-group">
                                        <label>Pièces jointes <span class="text-danger">*</span></label>
                                        <small class="text-muted">Veuillez joindre un rapport d'activité et les documents supplémentaires (taille max : 500 Mo).</small>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Rapport d'Activité <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control-file" name="rapport" required>
                                                <small class="text-muted">Fichier max : 500 Mo</small>
                                                <br>
                                                @if($structure && in_array($structure->type, ['Entreprise sociale', 'Société coopérative']))
                                                    <label>NINEA</label>
                                                    <input type="file" class="form-control-file" name="ninea">
                                                    <small class="text-muted">Fichier max : 500 Mo</small>
                                                    <br>
                                                    <label>RCCM</label>
                                                    <input type="file" class="form-control-file" name="rccm">
                                                    <small class="text-muted">Fichier max : 500 Mo</small>
                                                    <br>
                                                    <label>Quitus fiscal</label>
                                                    <input type="file" class="form-control-file" name="quitus">
                                                    <small class="text-muted">Fichier max : 500 Mo</small>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if($structure && in_array($structure->type, ['IMF', 'FINTECH', 'ONG', 'Banque', 'Compagnie d\'assurance']))
                                                    <label>Agrément</label>
                                                    <input type="file" class="form-control-file" name="agrement">
                                                    <small class="text-muted">Fichier max : 500 Mo</small>
                                                @endif
                                                <br>
                                                @if($structure && $structure->type === 'Structure publique')
                                                    <label>Décret de création</label>
                                                    <input type="file" class="form-control-file" name="decret">
                                                    <small class="text-muted">Fichier max : 500 Mo</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary prev-step" style="display: none;">Précédent</button>
                                <button type="button" class="btn btn-primary next-step">Suivant</button>
                                <button type="submit" class="btn btn-success submit-form" style="display: none;">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
            

                               
            <!-- Affichage des informations -->
            <!-- Boutons de filtrage -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-tools" style="width: 200px;">
                    <a id="btnInfos" class="btn btn-md btn-info w-100 p-2" href="#" onclick="showForm('infosForm', 'btnInfos')">
                        <i class="fa fa-info"></i> Informations Structure
                    </a>
                </div>
                <div class="card-tools" style="width: 200px;">
                    <a id="btnDossiers" class="btn btn-md btn-success w-100 p-2" href="#" onclick="showForm('dossiersForm', 'btnDossiers')">
                        <i class="fa fa-folder"></i> Dossiers Candidature
                    </a>
                </div>
            </div>

            <!-- Tables -->
            <div class="card-body">
                <div id="infosForm" class="form-section">
                    <h3 class="card-title mb-3">Informations de la structure</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="w-20">Nom Structure</th>
                                    <th>Siège Social</th>
                                    <th>Type</th>
                                    <th>Statut juridique</th> 
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($structure))
                                    <tr>
                                        <td>{{ $structure->nom_structure ?? '--' }}</td>
                                        <td>{{ $structure->siege_social ?? '--' }}</td>
                                        <td>{{ $structure->type ?? '--' }}</td>
                                        <td>{{ $structure->statut_juridique ?? '--' }}</td>
                                        <td class="text-center">
                                            <!-- Bouton pour voir les détails -->
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsInfotModal" title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Bouton pour modifier le profil -->
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editProfileModal" title="Modifier le profil">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune structure disponible</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            
            <!-- Modal Détails informations structure -->
            <div class="modal fade" id="detailsInfotModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title">
                                <i class="fas fa-info-circle text-primary mr-2"></i>
                                <span id="modalTitle">Détails de votre structure</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-muted">Informations Générales</h6>
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th>Structure</th>
                                        <td id="modal_structure">{{ $structure->nom_structure ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td id="modal_type">{{ $structure->type ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Siège social</th>
                                        <td id="modal_siege_social">{{ $structure->siege_social ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date de création</th>
                                        <td id="modal_date_creation">{{ $structure->date_creation ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Téléphone</th>
                                        <td id="modal_tel">{{ $structure->tel_structure ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Statut juridique</th>
                                        <td id="modal_tel">{{ $structure->statut_juridique ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>NINEA</th>
                                        <td id="modal_ninea">{{ $structure->ninea ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Registre de commerce</th>
                                        <td id="modal_registre">{{ $structure->registre_commerce ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Agrément</th>
                                        <td id="modal_agrement">{{ $structure->agreement ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Décret</th>
                                        <td id="modal_decret">{{ $structure->num_decret ?? '--' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h6 class="text-muted mt-4">Informations de Contact</h6>
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th>Nom contact</th>
                                        <td id="modal_nom_contact">{{ $structure->nom_contact ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Prénom contact</th>
                                        <td id="modal_prenom_contact">{{ $structure->prenom_contact ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fonction</th>
                                        <td id="modal_fonction">{{ $structure->fonction_contact ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Téléphone</th>
                                        <td id="modal_tel_contact">{{ $structure->tel_contact ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td id="modal_email_contact">{{ $structure->email_contact ?? '--' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer bg-light">
                           
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times"></i> Fermer
                            </button>
                        </div>
                    </div>
                </div>
            </div>


          <!-- Détails Dossiers de candidature -->
            <div id="dossiersForm" class="form-section" style="display:none;">
                <h3 class="card-title mb-3">Dossiers de candidature</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="w-50">Activité</th>
                                <th>Date début intervention</th>
                                <th>Date fin intervention</th> 
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($candidatures as $candidature)
                                <tr>
                                    <td>{{ $candidature->intitule_activite ?? '--' }}</td>
                                    <td>{{ $candidature->date_debut_intervention ?? '--' }}</td>
                                    <td>{{ $candidature->date_fin_intervention ?? '--' }}</td>
                                    <td class="text-center">
                                        <!-- Bouton pour voir les détails de la candidature -->
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailsCandidatureModal" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    
                                        <!-- Bouton pour modifier la candidature (désactivé si validé, évalué ou terminé) -->
                                        @if(!in_array($candidature->etat, ['validé', 'évalué', 'terminé']))
                                            <button type="button" class="btn btn-primary btn-sm edit-btn" data-toggle="modal" data-target="#updateCandidatureModal" data-id="{{ $candidature->id }}" title="Modifier la candidature">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-secondary btn-sm" disabled title="Modification non autorisée">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                        @endif
                                    </td>
                                    
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center">Aucun dossier disponible</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>



            

<!-- Modal pour la mise à jour de la candidature -->
<div class="modal fade" id="updateCandidatureModal" tabindex="-1" role="dialog" aria-labelledby="updateCandidatureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCandidatureModalLabel">Modifier la candidature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Vérification si la candidature existe -->
                @if(isset($candidature))
                    <!-- Progression des étapes -->
                    <div class="steps-indicator mb-4">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="steps-container">
                            <div class="step-item active" data-step="1">
                                <span class="step-number">1</span>
                                <span class="step-label">Informations générales</span>
                            </div>
                            <div class="step-item" data-step="2">
                                <span class="step-number">2</span>
                                <span class="step-label">Zone d'intervention</span>
                            </div>
                            <div class="step-item" data-step="3">
                                <span class="step-number">3</span>
                                <span class="step-label">Période & Secteur</span>
                            </div>
                            <div class="step-item" data-step="4">
                                <span class="step-number">4</span>
                                <span class="step-label">Documents</span>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de mise à jour -->
                    <form id="updateCandidatureForm" method="POST" action="{{ route('candidature.update', ['id' => $candidature->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="candidatureId" name="id">

                        <!-- Étape 1 -->
                        <div id="step1">
                            <h5>Étape 1 : Informations générales</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Structure <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="type" value="{{ $structure->type ?? '' }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Intitulé de l'activité <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="intitule_activite" value="{{ $candidature->intitule_activite }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description de l'activité<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description_activite" required>{{ $candidature->description_activite }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Effets/Impacts <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="effet_impact" rows="4" required>{{ $candidature->effet_impact }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Innovation dans l'activité <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="innovation" rows="4" required>{{ $candidature->innovation }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <!-- Étape 2 -->
                        <div id="step2" style="display:none;">
                            <h5>Étape 2 : Zone d'intervention</h5>
                            <div class="form-group">
                                <label>Zone d'intervention <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="hidden" name="national" value="0"> <!-- Valeur par défaut -->
                                            <input type="checkbox" class="form-check-input" id="national" name="national" value="1"
                                                {{ $national ? 'checked' : '' }}>
                                            <label class="form-check-label" for="national">
                                                Sélectionner l'intervention à l'échelle nationale
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Régions</label>
                                        <select class="form-control select2" name="regions[]" id="regions" multiple required>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}" 
                                                    {{ in_array($region->id, $candidature->regions->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $region->nom_region }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Départements</label>
                                        <select class="form-control select2" name="departements[]" id="departements" multiple required>
                                            @foreach($departements as $departement)
                                                <option value="{{ $departement->id }}" 
                                                    {{ in_array($departement->id, $candidature->departements->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $departement->nom_departement }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Communes</label>
                                        <select class="form-control select2" name="communes[]" id="communes" multiple required>
                                            @foreach($communes as $commune)
                                                <option value="{{ $commune->id }}" 
                                                    {{ in_array($commune->id, $candidature->communes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $commune->nom_commune }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Étape 3 -->
                        <div id="step3" style="display:none;">
                            <h5>Étape 3 : Période et secteur d'intervention</h5>
                            <div class="row form-group p-3 border rounded shadow-sm">
                                <div class="col-md-6 pr-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Date début <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="date_debut_intervention" value="{{ $candidature->date_debut_intervention }}" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Date fin <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="date_fin_intervention" value="{{ $candidature->date_fin_intervention }}" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Secteur d'activité <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="secteurs[]" multiple required>
                                                @foreach($secteur_interventions as $secteur_intervention)
                                                    <option value="{{ $secteur_intervention->id }}" {{ in_array($secteur_intervention->id, $candidature->secteurs->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $secteur_intervention->designation_secteur }}</option>
                                                @endforeach
                                                {{-- <option value="autre">Autre</option> --}}

                                            </select>
                                        </div>
                                        {{-- <div id="autre_secteur_input" style="display: none; margin-top: 10px;">
                                            <label for="secteur_autre">Veuillez spécifier l'autre secteur</label>
                                            <input type="text" class="form-control" id="secteur_autre" name="secteur_autre" placeholder="Entrez le secteur">
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 form-group p-3 border rounded shadow-sm">
                                            <label>Cibles <span class="text-danger">*</span></label>
                                            <select class="form-control select2" multiple name="cibles[]" required>
                                                @foreach($cible_activites as $cible_activite)
                                                    <option value="{{ $cible_activite->id }}" {{ in_array($cible_activite->id, $candidature->cibles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $cible_activite->designation_cible }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="fw-bold">Population touchée</label>
                                        <div class="row form-group p-3 border rounded shadow-sm">
                                            <div class="col-md-6">
                                                <div class="cible-item">
                                                    <label>Nombre d'hommes :</label>
                                                    <input type="number" name="nbr_homme" min="0" class="form-control" value="{{ $candidature->nbr_homme_toucher }}">
                                                </div>
                                                <div class="cible-item">
                                                    <label>Nombre de femmes :</label>
                                                    <input type="number" name="nbr_femme" min="0" class="form-control" value="{{ $candidature->nbr_femme_toucher }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="cible-item">
                                                    <label>Nombre de jeunes :</label>
                                                    <input type="number" name="nbr_jeune" min="0" class="form-control" value="{{ $candidature->nbr_jeune_toucher }}">
                                                </div>
                                                <div class="cible-item">
                                                    <label>Nombre de personnes vivant avec un handicap :</label>
                                                    <input type="number" name="nbr_handicape" min="0" class="form-control" value="{{ $candidature->nbr_handicape_toucher }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                 <!-- Etape 4 -->
                        <div id="step4" style="display:none;">
                        <h5>Étape 4 : Documents justificatifs</h5>
                        <div class="form-group">
                            <label>Pièces jointes<span class="text-danger">*</span></label>
                            <small class="text-muted">Veuillez joindre un rapport d'activité et les documents supplémentaires. Les fichiers existants seront remplacés si vous téléchargez de nouveaux fichiers.</small>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Rapport d'activité -->
                                    <div class="form-group mb-3">
                                        <label>Rapport d'Activité<span class="text-danger">*</span></label>
                                        @if($candidature->rapport_activite)
                                            <div class="mb-2">
                                                <a href="{{ route('telecharger', ['type' => 'rapport', 'filename' => basename($candidature->rapport_activite)]) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                    <i class="fas fa-file-alt"></i> Voir le fichier actuel
                                                </a>
                                            </div>
                                        @endif
                                        <input type="file" class="form-control-file" name="rapport">
                                        <small class="form-text text-muted">Laissez vide pour conserver le fichier actuel.</small>
                                    </div>
                                    
                                    <!-- Documents spécifiques pour les entreprises sociales et coopératives -->
                                    @if($structure && in_array($structure->type, ['Entreprise sociale', 'Société coopérative']))
                                        <!-- NINEA -->
                                        <div class="form-group mb-3">
                                            <label>NINEA</label>
                                            @if($candidature->fichier_ninea)
                                                <div class="mb-2">
                                                    <a href="{{ route('telecharger', ['type' => 'ninea', 'filename' => basename($candidature->fichier_ninea)]) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                        <i class="fas fa-file-alt"></i> Voir le fichier actuel
                                                    </a>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control-file" name="ninea">
                                            <small class="form-text text-muted">Laissez vide pour conserver le fichier actuel.</small>
                                        </div>
                                        
                                        <!-- RCCM -->
                                        <div class="form-group mb-3">
                                            <label>RCCM</label>
                                            @if($candidature->fichier_rccm)
                                                <div class="mb-2">
                                                    <a href="{{ route('telecharger', ['type' => 'rccm', 'filename' => basename($candidature->fichier_rccm)]) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                        <i class="fas fa-file-alt"></i> Voir le fichier actuel
                                                    </a>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control-file" name="rccm">
                                            <small class="form-text text-muted">Laissez vide pour conserver le fichier actuel.</small>
                                        </div>
                                        
                                        <!-- Quitus fiscal -->
                                        <div class="form-group mb-3">
                                            <label>Quitus fiscal</label>
                                            @if($candidature->quitus_fiscal)
                                                <div class="mb-2">
                                                    <a href="{{ route('telecharger', ['type' => 'quitus', 'filename' => basename($candidature->quitus_fiscal)]) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                        <i class="fas fa-file-alt"></i> Voir le fichier actuel
                                                    </a>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control-file" name="quitus">
                                            <small class="form-text text-muted">Laissez vide pour conserver le fichier actuel.</small>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-6">
                                    <!-- Documents spécifiques pour IMF, FINTECH, ONG, etc. -->
                                    @if($structure && in_array($structure->type, ['IMF', 'FINTECH', 'ONG', 'Banque', 'Compagnie d\'assurance']))
                                        <div class="form-group mb-3">
                                            <label>Agrément</label>
                                            @if($candidature->fichier_agrement)
                                                <div class="mb-2">
                                                    <a href="{{ route('telecharger', ['type' => 'agrement', 'filename' => basename($candidature->fichier_agrement)]) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                        <i class="fas fa-file-alt"></i> Voir le fichier actuel
                                                    </a>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control-file" name="agrement">
                                            <small class="form-text text-muted">Laissez vide pour conserver le fichier actuel.</small>
                                        </div>
                                    @endif
                                    
                                    <!-- Documents spécifiques pour Structure publique -->
                                    @if($structure && $structure->type === 'Structure publique')
                                        <div class="form-group mb-3">
                                            <label>Décret de création</label>
                                            @if($candidature->decret_creation)
                                                <div class="mb-2">
                                                    <a href="{{ route('telecharger', ['type' => 'decret', 'filename' => basename($candidature->decret_creation)]) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                        <i class="fas fa-file-alt"></i> Voir le fichier actuel
                                                    </a>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control-file" name="decret">
                                            <small class="form-text text-muted">Laissez vide pour conserver le fichier actuel.</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>
                @else
                    <div class="alert alert-warning">Vous n'avez pas encore soumis de candidature. Veuillez d'abord soumettre votre candidature avant de pouvoir la modifier.</div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" id="prevBtn" class="btn btn-secondary" style="display:none;">Précédent</button>
                <button type="button" id="nextBtn" class="btn btn-primary">Suivant</button>
                <button type="button" id="submitBtn" class="btn btn-success" style="display:none;">Mettre à jour</button>
            </div>
        </div>
    </div>
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
                                    {{-- @forelse($structures as $structure) --}}
                                    <tr>
                                        <td><strong>Nom structure:</strong></td>
                                        <td id="modal_nom_structure" style="text-align: justify;">{{ $structure->nom_structure ?? '--' }}</td>
                                    </tr>
                                     {{-- @endforelse --}}
                                    @forelse($candidatures as $candidature)
                                        <tr>
                                            <td><strong>Numéro de dossier:</strong></td>
                                            <td id="modal_intitule_activite" style="text-align: justify;">{{ $candidature->num_dossier ?? '--' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Intitulé activité:</strong></td>
                                            <td id="modal_intitule_activite" style="text-align: justify;">{{ $candidature->intitule_activite ?? '--' }}</td>
                                        </tr>
                                    
                                        <tr>
                                            <td><strong>Description de l'activité:</strong></td>
                                            <td id="modal_description_activite" style="text-align: justify;">{{ $candidature->description_activite ?? '--' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Effet/Impact :</strong></td>
                                            <td id="modal_effet_impact" style="text-align: justify;">{{ $candidature->effet_impact ?? '--' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Innovation  :</strong></td>
                                            <td id="modal_innovation" style="text-align: justify;">{{ $candidature->innovation ?? '--' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center">Aucun dossier</td></tr>
                                    @endforelse
                                </tbody>
                                
                            </table>
                            <table class="table table-bordered table-hover table-glow">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Dates d'Intervention</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($candidatures as $candidature)

                                        <tr>
                                            <td><strong>Date début de l'intervention:</strong></td>
                                            <td id="modal_date_debut_intervention">{{ $candidature->date_debut_intervention ?? '--' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date de fin de l'intervention:</strong></td>
                                            <td id="modal_date_fin_intervention">{{ $candidature->date_fin_intervention ?? '--' }}</td>
                                        </tr>
                                        @empty
                                        <tr><td colspan="4" class="text-center">Aucun dossier</td></tr>
                                        @endforelse
    
                                </tbody>
                            </table>

                            <table class="table table-bordered table-hover table-glow">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Zone d'Intervention</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($candidature))
                                        <!-- Si c'est national, afficher uniquement cette information -->
                                        @if($candidature->pays && $candidature->pays->national)
                                            <tr>
                                                <td><strong>National:</strong></td>
                                                <td style="text-align: justify;">
                                                    <span class="badge badge-success">Oui</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-center font-italic">
                                                    <em>Intervention à l'échelle nationale (tout le territoire)</em>
                                                </td>
                                            </tr>
                                        @else
                                            <!-- Si ce n'est pas national, afficher les détails des régions sans mention du statut national -->
                                            <tr>
                                                <td><strong>Régions:</strong></td>
                                                <td style="text-align: justify;">
                                                    @php
                                                        $regions_uniques = $candidature->regions->unique('nom_region');
                                                    @endphp
                                                    @forelse($regions_uniques as $region)
                                                        {{ $region->nom_region }}@if(!$loop->last), @endif
                                                    @empty
                                                        --
                                                    @endforelse
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Départements:</strong></td>
                                                <td style="text-align: justify;">
                                                    @php
                                                        $departements_uniques = $candidature->departements->unique('nom_departement');
                                                    @endphp
                                                    @forelse($departements_uniques as $departement)
                                                        {{ $departement->nom_departement }}@if(!$loop->last), @endif
                                                    @empty
                                                        --
                                                    @endforelse
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Communes:</strong></td>
                                                <td style="text-align: justify;">
                                                    @php
                                                        $communes_uniques = $candidature->communes->unique('nom_commune');
                                                    @endphp
                                                    @forelse($communes_uniques as $commune)
                                                        {{ $commune->nom_commune }}@if(!$loop->last), @endif
                                                    @empty
                                                        --
                                                    @endforelse
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr><td colspan="2" class="text-center">Aucune zone d'intervention</td></tr>
                                    @endif
                                </tbody>
                            </table>

                            <table class="table table-bordered table-hover table-glow">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Documents</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($candidatures as $candidature)
                                        @if($candidature->fichier_ninea)
                                        <tr>
                                            <td><strong>NINEA:</strong></td>
                                            <td>
                                                <a href="{{ route('telecharger', ['type' => 'ninea', 'filename' => basename($candidature->fichier_ninea)]) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Télécharger
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        @if($candidature->rapport_activite)
                                        <tr>
                                            <td><strong>Rapport activité :</strong></td>
                                            <td>
                                                <a href="{{ route('telecharger', ['type' => 'rapport', 'filename' => basename($candidature->rapport_activite)]) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Télécharger
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        @if($candidature->fichier_rccm)
                                        <tr>
                                            <td><strong>RCCM:</strong></td>
                                            <td>
                                                <a href="{{ route('telecharger', ['type' => 'rccm', 'filename' => basename($candidature->fichier_rccm)]) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Télécharger
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        @if($candidature->fichier_agrement)
                                        <tr>
                                            <td><strong>AGREMENT:</strong></td>
                                            <td>
                                                <a href="{{ route('telecharger', ['type' => 'agrement', 'filename' => basename($candidature->fichier_agrement)]) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Télécharger
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        @if($candidature->decret_creation)
                                        <tr>
                                            <td><strong>Décret de création:</strong></td>
                                            <td>
                                                <a href="{{ route('telecharger', ['type' => 'decret', 'filename' => basename($candidature->decret_creation)]) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Télécharger
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        @if($candidature->quitus_fiscal)
                                        <tr>
                                            <td><strong>Quitus fiscal:</strong></td>
                                            <td>
                                                <a href="{{ route('telecharger', ['type' => 'quitus', 'filename' => basename($candidature->quitus_fiscal)]) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Télécharger
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                    @empty
                                        <tr><td colspan="2" class="text-center">Aucun dossier</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <table class="table table-bordered table-hover table-glow">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Cibles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Populations Ciblées:</strong></td>
                                        <td style="text-align: justify;">
                                            @if(isset($candidature))
                                                @php
                                                    $cibles_uniques = $candidature->cibles->unique('designation_cible');
                                                @endphp
                                                @forelse($cibles_uniques as $cible)
                                                    <span class="badge badge-info mr-1">
                                                        {{ $cible->designation_cible }}
                                                    </span>
                                                @empty
                                                    --
                                                @endforelse
                                            @else
                                                --
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nombre d'hommes touchés:</strong></td>
                                        <td id="modal_nbr_homme_toucher">
                                            {{ number_format($candidature->nbr_homme_toucher ?? 0, 0, ',', ' ') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nombre de femmes touchées:</strong></td>
                                        <td id="modal_nbr_femme_toucher">
                                            {{ number_format($candidature->nbr_femme_toucher ?? 0, 0, ',', ' ') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nombre de jeunes touchés:</strong></td>
                                        <td id="modal_nbr_jeune_toucher">
                                            {{ number_format($candidature->nbr_jeune_toucher ?? 0, 0, ',', ' ') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nombre de personnes handicapées touchées:</strong></td>
                                        <td id="modal_nbr_handicape_toucher">
                                            {{ number_format($candidature->nbr_handicape_toucher ?? 0, 0, ',', ' ') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times"></i> Fermer
                            </button>
                            <button type="button" class="btn btn-primary" onclick="imprimerModal();">
                                <i class="fas fa-print"></i> Enregistrer
                            </button>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            


        </div>
    </section>
@endsection

<!-- Inclure SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Script pour afficher et masquer les formulaires
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", function(event) {
                let submitBtn = this.querySelector("button[type='submit']");
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Chargement...`;
                }
            });
        });
    });

    function showForm(formId, btnId) {
        // Cacher tous les formulaires
        document.querySelectorAll('.form-section').forEach(form => {
            form.style.display = 'none';
        });

        // Afficher le formulaire demandé
        document.getElementById(formId).style.display = 'block';

        // Mise à jour des boutons actifs
        document.querySelectorAll('.card-tools a').forEach(btn => {
            btn.classList.remove('active');
        });
        document.getElementById(btnId).classList.add('active'); 
    }

    // Script pour fermer l'alerte après 5 secondes
    setTimeout(function() {
        document.querySelectorAll(".alert-success").forEach(alert => {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.style.display = "none", 500);
        });
    }, 5000); // L'alerte disparaît après 5 secondes

    // Script pour gérer les alertes en cas de succès avec SweetAlert2
    document.addEventListener("DOMContentLoaded", function() {
        @if (session('success'))
            Swal.fire({
                title: "Succès",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 5000,
                showConfirmButton: false
            });
        @endif
    });

   
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
       const steps = document.querySelectorAll('.step');
       const nextButtons = document.querySelectorAll('.next-step');
       const prevButtons = document.querySelectorAll('.prev-step');
       const submitButton = document.querySelector('.submit-form');
       let currentStep = 1;
   
       // Fonction pour afficher l'étape actuelle
       function showStep(step) {
           steps.forEach((s, index) => {
               if (index === step - 1) {
                   s.classList.add('active');
                   s.classList.remove('d-none'); // Affiche l'étape active
               } else {
                   s.classList.remove('active');
                   s.classList.add('d-none'); // Cache les autres étapes
               }
           });
   
           // Affichage des boutons suivant et précédent
           prevButtons.forEach(btn => {
               btn.style.display = step === 1 ? 'none' : 'inline-block';
           });
           nextButtons.forEach(btn => {
               btn.style.display = step === steps.length ? 'none' : 'inline-block';
           });
           submitButton.style.display = step === steps.length ? 'inline-block' : 'none';
       }
   
       // Fonction pour valider les champs obligatoires de l'étape actuelle
       function validateRequiredFields(step) {
           const currentForm = steps[step - 1];
           const requiredFields = currentForm.querySelectorAll('[required]');
           let allFieldsValid = true;
   
           requiredFields.forEach(field => {
               if (!field.value.trim()) {
                   allFieldsValid = false;
                   field.classList.add('is-invalid');
               } else {
                   field.classList.remove('is-invalid');
               }
           });
   
           // Si des champs obligatoires sont manquants, afficher un modal
           if (!allFieldsValid) {
               Swal.fire({
                   title: "Champs obligatoires",
                   text: "Veuillez remplir tous les champs obligatoires.",
                   icon: "error"
               });
           }
   
           return allFieldsValid;
       }
   
       // Fonction pour valider les zones d'intervention
       function validateInterventionZone() {
           const nationalCheckbox = document.getElementById('national');
           const regions = document.querySelector('select[name="regions[]"]');
           const departements = document.querySelector('select[name="departements[]"]');
           const communes = document.querySelector('select[name="communes[]"]');
   
           let isValid = true;
   
           if (nationalCheckbox.checked) {
               // Si "intervention nationale" est cochée, on ne valide pas les autres champs
               regions.classList.remove('is-invalid');
               departements.classList.remove('is-invalid');
               communes.classList.remove('is-invalid');
           } else {
               // Sinon, il faut valider que l'une des options soit sélectionnée
               if (regions.selectedOptions.length === 0 && departements.selectedOptions.length === 0 && communes.selectedOptions.length === 0) {
                   isValid = false;
                   regions.classList.add('is-invalid');
                   departements.classList.add('is-invalid');
                   communes.classList.add('is-invalid');
               } else {
                   regions.classList.remove('is-invalid');
                   departements.classList.remove('is-invalid');
                   communes.classList.remove('is-invalid');
               }
           }
   
           return isValid;
       }
   
       // Gestion des boutons "Suivant" et "Précédent"
       nextButtons.forEach(button => {
           button.addEventListener('click', function () {
               // Valider l'étape actuelle
               let isValid = true;
   
               if (!validateRequiredFields(currentStep)) {
                   isValid = false;
               }
   
               // Validation spécifique pour l'étape de la zone d'intervention (étape 2)
               if (currentStep === 2 && !validateInterventionZone()) {
                   isValid = false;
                   Swal.fire({
                       title: "Champs obligatoires",
                       text: "Veuillez sélectionner au moins une région, un département ou une commune, sauf si l'intervention est nationale.",
                       icon: "error"
                   });
               }
   
               if (!isValid) {
                   return; // Si la validation échoue, on ne passe pas à l'étape suivante
               }
   
               currentStep++;
               showStep(currentStep);
           });
       });
   
       prevButtons.forEach(button => {
           button.addEventListener('click', function () {
               currentStep--;
               showStep(currentStep);
           });
       });
   
       // Gestion de la soumission du formulaire
       submitButton.addEventListener('click', function (event) {
           // Validation finale avant soumission
           let isValid = true;
   
           if (!validateRequiredFields(currentStep)) {
               isValid = false;
           }
   
           // Validation spécifique pour l'étape de la zone d'intervention (étape 2)
           if (currentStep === 2 && !validateInterventionZone()) {
               isValid = false;
               Swal.fire({
                   title: "Champs obligatoires",
                   text: "Veuillez remplir tous les champs obligatoires et sélectionner une zone d'intervention.",
                   icon: "error"
               });
           }
   
        //    if (!isValid) {
        //        event.preventDefault(); // Si la validation échoue, on empêche la soumission
        //    } else {
        //        Swal.fire({
        //            title: "Confirmation",
        //            text: "Voulez-vous vraiment soumettre le formulaire ?",
        //            icon: "question",
        //            showCancelButton: true,
        //            confirmButtonText: "Oui, soumettre",
        //            cancelButtonText: "Annuler"
        //        }).then((result) => {
        //            if (result.isConfirmed) {
        //                // Afficher le modal de succès immédiatement
        //                Swal.fire({
        //                    title: "Succès",
        //                    text: "Formulaire soumis avec succès !",
        //                    icon: "success",
        //                    timer: 5000, // Afficher le modal pendant 5 secondes avant de soumettre
        //                    showConfirmButton: false
        //                }).then(() => {
        //                    // Soumettre le formulaire après le délai du modal de succès
        //                    document.querySelector('form').submit();
        //                });
        //            } else {
        //                // Si l'utilisateur clique sur "Annuler", on empêche la soumission
        //                event.preventDefault();
        //            }
        //        });
        //    }
       });
   
       // Initialisation
       showStep(currentStep);
   });
   
   </script>
    
<!-- Script pour imprimer un modal -->
<script>
    function imprimerModal() {
      // Récupérer le contenu du modal
      var contenu = document.getElementById('printCandidatureModal').innerHTML;
  
      // Créer une nouvelle fenêtre
      var fenetreImpression = window.open('', '', 'width=800,height=600');
  
      // Ajouter le contenu du modal à la nouvelle fenêtre
      fenetreImpression.document.write('<html><head><title>Détails de votre dossier de candidature</title>');
      fenetreImpression.document.write('<style>');
      fenetreImpression.document.write('@page { size: A4; margin: 20mm; }');
      fenetreImpression.document.write('body { font-family: Arial, sans-serif; font-size: 12pt; }');
      fenetreImpression.document.write('table { width: 100%; border-collapse: collapse; }');
      fenetreImpression.document.write('th, td { border: 1px solid #000; padding: 8px; text-align: left; }');
      fenetreImpression.document.write('</style>');
      fenetreImpression.document.write('</head><body>');
      fenetreImpression.document.write(contenu);
      fenetreImpression.document.write('</body></html>');
  
      // Fermer le document pour appliquer les styles
      fenetreImpression.document.close();
  
      // Attendre que le contenu soit chargé avant d'imprimer
      fenetreImpression.onload = function() {
          // Lancer l'impression
          fenetreImpression.print();
          // Fermer la fenêtre après l'impression
          fenetreImpression.close();
      };
    }
  </script>
  
  <!-- Script pour désactiver certains boutons -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const btnInfoStructure = document.querySelector(".btn-info");
      const btnNewCandidature = document.querySelector(".btn-success");
  
      btnInfoStructure.addEventListener("click", function(event) {
          if (btnInfoStructure.disabled) {
              event.preventDefault();  // Empêche l'ouverture du modal
          }
      });
  
      btnNewCandidature.addEventListener("click", function(event) {
          if (btnNewCandidature.disabled) {
              event.preventDefault();  // Empêche l'ouverture du modal
          }
      });
    });
  </script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const closeButton = document.getElementById('toast-close-button');
      if (closeButton) {
        closeButton.addEventListener('click', function() {
          const toast = closeButton.closest('.toast');
          if (toast) {
            toast.classList.remove('show');
          }
        });
      }
  
      // Optionnel : fermer automatiquement après 5 secondes
      const toastElement = document.querySelector('.toast');
      if (toastElement) {
        setTimeout(function() {
          toastElement.classList.remove('show');
        }, 5000); // 5000ms = 5 secondes
      }
    });
  </script>
  
  <script>
    $(document).ready(function() {
      // Lorsqu'un bouton "Modifier" est cliqué
      $('.edit-btn').on('click', function() {
          var candidatureId = $(this).data('id');  // Récupérer l'ID de la candidature
          var activite = $(this).closest('tr').find('td:nth-child(1)').text().trim();  // Récupérer l'intitulé de l'activité
          var dateDebut = $(this).closest('tr').find('td:nth-child(2)').text().trim();  // Récupérer la date de début
          var dateFin = $(this).closest('tr').find('td:nth-child(3)').text().trim();  // Récupérer la date de fin
  
          // Remplir les champs du formulaire dans le modal avec les données
          $('#candidatureId').val(candidatureId);
          $('#activite').val(activite);
          $('#date_debut').val(dateDebut);
          $('#date_fin').val(dateFin);
      });
    });
  </script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const steps = document.querySelectorAll('[id^="step"]');
      const progressBar = document.querySelector('.progress-bar');
      const stepItems = document.querySelectorAll('.step-item');
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');
      const submitBtn = document.getElementById('submitBtn');
      const form = document.getElementById('updateCandidatureForm');
  
      let currentStep = 0;
      const totalSteps = steps.length;
  
      // Fonction pour afficher l'étape actuelle
      function showStep(stepIndex) {
          steps.forEach((step, index) => {
              step.style.display = index === stepIndex ? 'block' : 'none';
          });
  
          // Mise à jour des boutons
          prevBtn.style.display = stepIndex === 0 ? 'none' : 'inline-block';
          nextBtn.style.display = stepIndex === totalSteps - 1 ? 'none' : 'inline-block';
          submitBtn.style.display = stepIndex === totalSteps - 1 ? 'inline-block' : 'none';
  
          updateProgress();
      }
  
      // Mise à jour de la barre de progression et des étapes actives
      function updateProgress() {
          const progressPercentage = ((currentStep + 1) / totalSteps) * 100;
          progressBar.style.width = `${progressPercentage}%`;
  
          // Change the color of the progress bar based on the step
          progressBar.style.backgroundColor = `rgb(7, 167, 18)`; // Vert (vous pouvez ajuster la couleur si nécessaire)
  
          stepItems.forEach((item, index) => {
              if (index <= currentStep) {
                  item.classList.add('active');
              } else {
                  item.classList.remove('active');
              }
          });
      }
  
      // Gestion des boutons
      nextBtn.addEventListener('click', function() {
          if (currentStep < totalSteps - 1) {
              currentStep++;
              showStep(currentStep);
          }
      });
  
      prevBtn.addEventListener('click', function() {
          if (currentStep > 0) {
              currentStep--;
              showStep(currentStep);
          }
      });
  
      // Soumission du formulaire
      submitBtn.addEventListener('click', function(e) {
          e.preventDefault();
          form.submit();
      });
  
      // Réinitialisation du modal
      $('#updateCandidatureModal').on('show.bs.modal', function () {
          currentStep = 0;
          showStep(currentStep);
      });
  
      // Initialisation
      showStep(currentStep);
    });
  
    document.querySelectorAll('input[type="file"]').forEach(input => {
      input.addEventListener('change', function() {
          if (this.files[0].size > 500 * 1024 * 1024) { // 500 MB en octets
              alert("Le fichier ne doit pas dépasser 500 Mo !");
              this.value = ""; // Réinitialise l'input
          }
      });
    });
  </script>
  
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
    $(document).ready(function() {
      $("#numero_immatriculation").change(function() {
          // Cacher tous les champs
          $("#field-ninea, #field-registre_commerce, #field-agreement, #field-num_decret").addClass("d-none");
  
          // Afficher les champs en fonction des options sélectionnées
          $("#numero_immatriculation option:selected").each(function() {
              let value = $(this).val();
              if (value === "NINEA") {
                  $("#field-ninea").removeClass("d-none");
              } else if (value === "Registre de commerce") {
                  $("#field-registre_commerce").removeClass("d-none");
              } else if (value === "Agreement") {
                  $("#field-agreement").removeClass("d-none");
              } else if (value === "Decret") {
                  $("#field-num_decret").removeClass("d-none");
              }
          });
      });
    });
  </script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(document).ready(function () {
      $('#secteur_select').on('change', function () {
          if ($(this).val().includes("autre")) {
              $('#autre_secteur_input').fadeIn(); // Afficher avec effet
          } else {
              $('#autre_secteur_input').fadeOut(); // Cacher avec effet
          }
      });
  });
  </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nationalCheckbox = document.getElementById('national');
        const regionSelects = document.querySelectorAll('select[name="regions[]"], select[name="departements[]"], select[name="communes[]"]');
        const regionSelect = document.getElementById('regions');
        const departementSelect = document.getElementById('departements');
        const communeSelect = document.getElementById('communes');
    
        // Fonction pour activer/désactiver les sélecteurs en fonction de la case 'national'
        function toggleZones() {
            if (nationalCheckbox.checked) {
                // Désactiver les champs de régions, départements et communes
                regionSelects.forEach(select => {
                    $(select).prop('disabled', true);
                    if ($(select).data('select2')) {
                        $(select).val(null).trigger('change');
                    } else {
                        // Pour les sélecteurs standard
                        Array.from(select.options).forEach(option => {
                            option.selected = false;
                        });
                    }
                });
            } else {
                // Réactiver les champs si 'national' est décoché
                regionSelects.forEach(select => {
                    $(select).prop('disabled', false);
                });
            }
        }
    
        // Fonction pour gérer la désactivation de la case "national" si des zones sont sélectionnées
        function toggleNationalCheckbox() {
            const regionSelected = document.querySelector('select[name="regions[]"]').selectedOptions.length > 0;
            const departementSelected = document.querySelector('select[name="departements[]"]').selectedOptions.length > 0;
            const communeSelected = document.querySelector('select[name="communes[]"]').selectedOptions.length > 0;
    
            // Désactiver la case "national" si une sélection est faite dans les zones
            if (regionSelected || departementSelected || communeSelected) {
                $(nationalCheckbox).prop('disabled', true);
                $(nationalCheckbox).prop('checked', false); // Optionnel : décocher "national" si une zone est sélectionnée
            } else {
                $(nationalCheckbox).prop('disabled', false);
            }
        }
    
        // Ajouter des événements pour le changement de la case 'national' et des sélections de zones
        nationalCheckbox.addEventListener('change', toggleZones);
    
        // Ajouter des événements pour la sélection dans les zones (régions, départements, communes)
        regionSelects.forEach(select => {
            select.addEventListener('change', toggleNationalCheckbox);
        });
    
        // Vérifier l'état de 'national' et des zones au chargement de la page
        toggleZones();
        toggleNationalCheckbox();
    
        // Si l'option "national" est sélectionnée dans le back-end (par exemple, lors de la mise à jour), il faut également vérifier et désactiver les champs correspondants.
        if (nationalCheckbox.checked) {
            // Désactiver les champs pour la mise à jour lorsque 'national' est sélectionné
            regionSelects.forEach(select => {
                $(select).prop('disabled', true);
            });
        }
    });
    </script>
    

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateDebutInput = document.querySelector('[name="date_debut_intervention"]');
        const dateFinInput = document.querySelector('[name="date_fin_intervention"]');
        const submitButton = document.querySelector('.submit-form'); // Le bouton de soumission de votre formulaire
        
        // Fonction pour valider les dates
        function validateDates() {
            const dateDebut = new Date(dateDebutInput.value);
            const dateFin = new Date(dateFinInput.value);
            
            if (dateDebut && dateFin && dateFin < dateDebut) {
                // Si la date de fin est antérieure à la date de début
                Swal.fire({
                    title: "Erreur de dates",
                    text: "La date de fin ne peut pas être antérieure à la date de début.",
                    icon: "error",
                    confirmButtonText: "Compris"
                });
                return false; // Retourner false pour empêcher la soumission du formulaire
            }
            return true; // Les dates sont valides
        }

        // Ajouter un événement pour la soumission du formulaire
        submitButton.addEventListener('click', function (event) {
            if (!validateDates()) {
                event.preventDefault(); // Empêcher la soumission du formulaire
            }
        });

        // Optionnel : Validation en temps réel lorsque l'utilisateur modifie les dates
        dateDebutInput.addEventListener('change', validateDates);
        dateFinInput.addEventListener('change', validateDates);
    });
</script>
  <style>
    /* ========================== */
/*        INDICATEUR ÉTAPES   */
/* ========================== */
.steps-indicator {
    position: relative;
    margin-bottom: 30px;
}

.steps-indicator .progress {
    height: 4px;
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    background-color: #e0e0e0;
    z-index: 1;
}

.steps-indicator .progress-bar {
    background-color: rgb(7, 167, 18);
    width: 0%; /* Assurez-vous qu'il commence à 0% */
    transition: width 0.5s ease; /* Transition fluide */
}

.steps-container {
    display: flex;
    justify-content: space-between;
    position: relative;
    z-index: 2;
}

.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    cursor: pointer;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #e0e0e0;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    transition: all 0.3s ease;
}

.step-label {
    text-align: center;
    font-size: 0.8rem;
    color: #6c757d;
    transition: color 0.3s ease;
}

.step-item.active .step-number {
    background-color: rgb(7, 167, 18); /* Couleur verte */
    color: white;
}

.step-item.active .step-label {
    color: rgb(7, 167, 18);
    font-weight: bold;
}

/* Responsive */
@media (max-width: 768px) {
    .steps-container {
        flex-direction: column;
    }

    .steps-indicator .progress {
        display: none;
    }

    .step-item {
        flex-direction: row;
        align-items: center;
        margin-bottom: 15px;
    }

    .step-number {
        margin-right: 15px;
        margin-bottom: 0;
    }

    .step-label {
        text-align: left;
    }
}

/* ========================== */
/*       TABLE GLOW EFFECT   */
/* ========================== */
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

/* ========================== */
/*        MODAL STYLING      */
/* ========================== */
.modal-content {
    box-shadow: 0 0 20px #059652;
    border-radius: 10px;
    transition: all 0.3s ease-in-out;
    animation: glowEffect 1.5s infinite alternate; /* Animation lumineuse */
}

.modal-header {
    background: linear-gradient(135deg, #059652, #059652);
    color: white;
    box-shadow: 0 0 10px #059652;
}

.modal-footer {
    background-color: #f8f9fa;
    box-shadow: 0 0 10px #059652;
}

button.close {
    color: white;
    font-size: 24px;
}

/* ========================== */
/*       BOUTON PDF          */
/* ========================== */
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

/* ========================== */
/*        ANIMATION MODAL    */
/* ========================== */
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

/* ========================== */
/*    TOAST FADE ANIMATION   */
/* ========================== */
.toast {
    transition: opacity 0.5s ease-out;
}

.toast.fade {
    opacity: 0;
}

/* ========================== */
/*    TABLE FIXED WIDTH      */
/* ========================== */
.table-fixed {
    table-layout: fixed;
    width: 100%;
}

.table-fixed th, 
.table-fixed td {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Largeur spécifique des colonnes */
.w-10 { width: 10%; }
.w-20 { width: 20%; }
.w-30 { width: 30%; }
.w-40 { width: 40%; }

/* ========================== */
/*    SELECT2 FIX TEXTE NOIR  */
/* ========================== */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    color: black !important;
}

  </style>