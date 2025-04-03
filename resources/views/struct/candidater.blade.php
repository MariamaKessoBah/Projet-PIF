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

<section class="content">
    <div class="container-fluid">

    <!-- Message d'avertissement -->
        <div class="alert alert-warning text-center mt-3">
            <i class="fas fa-exclamation-triangle"></i>
            Le formulaire de candidature n'est actif qu'aprés avoir remplit correctement les informations de votre structure
        </div>
        <hr>
        
       <!-- Actions Rapides -->
       <div class="row mb-4">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">Actions Rapides</h3>
                   </div>
                   <div class="card-body">
                       <div class="btn-group w-100">
                           <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editProfileModal">
                               <i class="fas fa-edit"></i> Informations de votre structure
                           </button>
                            <button type="button" class="btn btn-success {{ isset($structure->nom_structure) ? '' : 'disabled' }}" 
                                    data-toggle="modal" 
                                    data-target="#newCandidatureModal"
                                    {{ isset($structure->nom_structure) ? '' : 'disabled' }}
                                    title="{{ isset($structure->nom_structure) ? 'Nouvelle candidature' : 'Complétez d\'abord votre profil' }}">
                                <i class="fas fa-plus"></i> Nouvelle Candidature
                            </button> 
                            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newCandidatureModal">
                            <i class="fas fa-plus"></i> Nouvelle Candidature
                            </button> -->
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <!-- Modal Modifier Profil -->
       <div class="modal fade" id="editProfileModal" tabindex="-1">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
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
                               <!-- Informations Structure -->
                               <div class="col-md-6">
                                   <h6 class="font-weight-bold mb-3">Informations de la Structure</h6>
                                   <div class="form-group">
                                        <label>Type <span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="type-structure" name="type_structure" required>
                                            <option value="1" data-type="entreprise">Entreprise sociale</option>
                                            <option value="2" data-type="entreprise">Société coopérative</option>
                                            <option value="3" data-type="imf">IMF</option>
                                            <option value="4" data-type="imf">FINTECH</option>
                                            <option value="5" data-type="imf">ONG</option>
                                            <option value="6" data-type="imf">Banque</option>
                                            <option value="7" data-type="imf">Compagnie d'assurance</option>
                                            <option value="8" data-type="public">Structure publique</option>
                                        </select>
                                        
                                        {{-- <input type="text" class="form-control" name="type_structure" value="{{ $structure->nom_structure ?? '' }}" required> --}}
                                    </div>
                                   <div class="form-group">
                                       <label>Nom Structure <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" name="nom_structure" value="{{ $structure->nom_structure ?? '' }}" required>
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
                                    <label>Tel_structure <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="tel_structure" value="{{ $structure->tel_structure ?? '' }}" required>
                                </div>
                                   <!-- Champs spécifiques pour Entreprise sociale et Société coopérative -->
                                <div class="form-group entreprise-champs">
                                    <label>Agrément <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="agrement_entreprise" value="{{ $structure->agrement_entreprise ?? '' }}">
                                </div>
                                <div class="form-group entreprise-champs">
                                    <label>Décret</label>
                                    <input type="text" class="form-control" name="decret_entreprise" value="{{ $structure->decret_entreprise ?? '' }}">
                                </div>

                                <!-- Champs spécifiques pour IMF, FINTECH, ONG, Banque, Compagnie -->
                                <div class="form-group autres-champs">
                                    <label>NINEA <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ninea_entreprise" value="{{ $structure->ninea_entreprise ?? '' }}">
                                </div>
                                <div class="form-group autres-champs">
                                    <label>Registre de commerce <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="registre_entreprise" value="{{ $structure->registre_entreprise ?? '' }}">
                                </div>

                                <!-- Champs spécifiques pour Structure publique -->
                                <div class="form-group publique-champs">
                                    <label>Agrément <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="agrement_entreprise" value="{{ $structure->agrement_entreprise ?? '' }}">
                                </div>
                                <div class="form-group publique-champs">
                                    <label>Décret</label>
                                    <input type="text" class="form-control" name="decret_entreprise" value="{{ $structure->decret_entreprise ?? '' }}">
                                </div>
                                <div class="form-group publique-champs">
                                    <label>NINEA <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ninea_entreprise" value="{{ $structure->ninea_entreprise ?? '' }}">
                                </div>
                                <div class="form-group publique-champs">
                                    <label>Registre de commerce <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="registre_entreprise" value="{{ $structure->registre_entreprise ?? '' }}">
                                </div>

                                   <div class="form-group">
                                       <label>Nombre de Membres/Clients/Cibles <span class="text-danger">*</span></label>
                                       <input type="number" class="form-control" name="nbre_membre" value="{{ $structure->nbre_membre ?? '' }}" required>
                                   </div>
                               </div>
                               
                               <!-- Contact Principal -->
                               <div class="col-md-6">
                                   <h6 class="font-weight-bold mb-3">Contact Principal</h6>
                                   <div class="form-group">
                                       <label>Nom <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" name="nom_contact" value="{{ $structure->nom_contact ?? '' }}" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Prénom <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" name="prenom_contact" value="{{ $structure->prenom_contact ?? '' }}" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Fonction <span class="text-danger">*</span></label>
                                       <input type="text" class="form-control" name="fonction_contact" value="{{ $structure->fonction_contact ?? '' }}" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Téléphone <span class="text-danger">*</span></label>
                                       <input type="tel" class="form-control" name="tel_contact" value="{{ $structure->tel_contact ?? '' }}" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Email <span class="text-danger">*</span></label>
                                       <input type="email" class="form-control" name="email_contact" value="{{ $structure->email_contact ?? '' }}" required>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                           <button type="submit" class="btn btn-success">Enregistrer</button>
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
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Colonne gauche -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Structure <span class="text-danger">*</span></label>
                                                                <select class="form-control select2" name="structure_id" id="structure_select" required>
                                                                    <option value="">Sélectionner un type d'une structure</option>
                                                                    <optgroup label="Entreprises sociales et coopératives">
                                                                        <option value="1" data-type="entreprise">Entreprise sociale</option>
                                                                        <option value="2" data-type="entreprise">Société coopérative</option>
                                                                    </optgroup>
                                                                    <optgroup label="Services Financiers">
                                                                        <option value="3" data-type="imf">IMF</option>
                                                                        <option value="4" data-type="imf">FINTECH</option>
                                                                        <option value="5" data-type="imf">ONG</option>
                                                                        <option value="6" data-type="imf">Banque</option>
                                                                        <option value="7" data-type="imf">Compagnie d'assurance</option>
                                                                    </optgroup>
                                                                    <optgroup label="Structures Publiques">
                                                                        <option value="8" data-type="public">Structure publique</option>
                                                                        {{-- <option value="9" data-type="public">Structure publique N</option> --}}
                                                                    </optgroup>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Intitulé de l'activité <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="intitule_activite" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Description de l'activité <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" name="descr_activite" rows="4" required></textarea>
                                                                <small class="text-muted">Décrivez en détail votre activité et ses objectifs.</small>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Effects/Impacts <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" name="descr_activite" rows="4" required></textarea>
                                                                <small class="text-muted">Décrivez en détail vos effets et impacts.</small>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Innovation dans l'activité <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" name="descr_activite" rows="4" required></textarea>
                                                                <small class="text-muted">Veuillez décrire les innovations dans votre activité.</small>
                                                            </div>

                                                                <script>
                                                                document.getElementsByName('innovation').forEach(radio => {
                                                                    radio.addEventListener('change', function() {
                                                                        document.getElementById('autre_innovation_details').style.display = 
                                                                            this.id === 'autre_innovation' ? 'block' : 'none';
                                                                        
                                                                        if (this.id !== 'autre_innovation') {
                                                                            document.querySelector('[name="autre_innovation_description"]').value = '';
                                                                        }
                                                                    });
                                                                });
                                                                </script>
                                                    
                                                        </div>

                                                        <!-- Colonne droite -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Période d'intervention <span class="text-danger">*</span></label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Date début</label>
                                                                        <input type="date" class="form-control" name="date_debut_intervention" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Date fin</label>
                                                                        <input type="date" class="form-control" name="date_fin_intervention" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Zone d'intervention <span class="text-danger">*</span></label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                    <label>Régions</label>
                                                                        <select class="form-control select2" name="regions[]" multiple required>
                                                                            <optgroup label="Ouest">
                                                                                <option value="dakar">Dakar</option>
                                                                                <option value="thies">Thiès</option>
                                                                                <option value="louga">Louga</option>
                                                                                <option value="saint-louis">Saint-Louis</option>
                                                                            </optgroup>
                                                                            <optgroup label="Centre">
                                                                                <option value="diourbel">Diourbel</option>
                                                                                <option value="fatick">Fatick</option>
                                                                                <option value="kaffrine">Kaffrine</option>
                                                                                <option value="kaolack">Kaolack</option>
                                                                            </optgroup>
                                                                            <optgroup label="Sud">
                                                                                <option value="kolda">Kolda</option>
                                                                                <option value="sedhiou">Sédhiou</option>
                                                                                <option value="ziguinchor">Ziguinchor</option>
                                                                            </optgroup>
                                                                            <optgroup label="Est">
                                                                                <option value="tambacounda">Tambacounda</option>
                                                                                <option value="kedougou">Kédougou</option>
                                                                                <option value="matam">Matam</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Départements</label>
                                                                        <select class="form-control select2" name="departements[]" multiple required>
                                                                            <optgroup label="Dakar">
                                                                                <option value="dakar-ville">Dakar Ville</option>
                                                                                <option value="guediawaye">Guédiawaye</option>
                                                                                <option value="pikine">Pikine</option>
                                                                                <option value="rufisque">Rufisque</option>
                                                                            </optgroup>
                                                                            <optgroup label="Diourbel">
                                                                                <option value="bambey">Bambey</option>
                                                                                <option value="diourbel-ville">Diourbel Ville</option>
                                                                                <option value="mbacke">Mbacké</option>
                                                                            </optgroup>
                                                                            <optgroup label="Fatick">
                                                                                <option value="fatick-ville">Fatick Ville</option>
                                                                                <option value="foundiougne">Foundiougne</option>
                                                                                <option value="gossas">Gossas</option>
                                                                            </optgroup>
                                                                            <optgroup label="Kaffrine">
                                                                                <option value="birkelane">Birkelane</option>
                                                                                <option value="kaffrine-ville">Kaffrine Ville</option>
                                                                                <option value="koungheul">Koungheul</option>
                                                                                <option value="malem-hodar">Malem Hodar</option>
                                                                            </optgroup>
                                                                            <optgroup label="Kaolack">
                                                                                <option value="guinguineo">Guinguinéo</option>
                                                                                <option value="kaolack-ville">Kaolack Ville</option>
                                                                                <option value="nioro-du-rip">Nioro du Rip</option>
                                                                            </optgroup>
                                                                            <optgroup label="Kédougou">
                                                                                <option value="kedougou-ville">Kédougou Ville</option>
                                                                                <option value="salemata">Salémata</option>
                                                                                <option value="saraya">Saraya</option>
                                                                            </optgroup>
                                                                            <optgroup label="Kolda">
                                                                                <option value="kolda-ville">Kolda Ville</option>
                                                                                <option value="medina-yoro-foulah">Médina Yoro Foulah</option>
                                                                                <option value="velingara">Vélingara</option>
                                                                            </optgroup>
                                                                            <optgroup label="Louga">
                                                                                <option value="kebemer">Kébémer</option>
                                                                                <option value="linguere">Linguère</option>
                                                                                <option value="louga-ville">Louga Ville</option>
                                                                            </optgroup>
                                                                            <optgroup label="Matam">
                                                                                <option value="kanel">Kanel</option>
                                                                                <option value="matam-ville">Matam Ville</option>
                                                                                <option value="ranerou">Ranérou</option>
                                                                            </optgroup>
                                                                            <optgroup label="Saint-Louis">
                                                                                <option value="dagana">Dagana</option>
                                                                                <option value="podor">Podor</option>
                                                                                <option value="saint-louis-ville">Saint-Louis Ville</option>
                                                                            </optgroup>
                                                                            <optgroup label="Sédhiou">
                                                                                <option value="bounkiling">Bounkiling</option>
                                                                                <option value="goudomp">Goudomp</option>
                                                                                <option value="sedhiou-ville">Sédhiou Ville</option>
                                                                            </optgroup>
                                                                            <optgroup label="Tambacounda">
                                                                                <option value="bakel">Bakel</option>
                                                                                <option value="goudiry">Goudiry</option>
                                                                                <option value="koumpentoum">Koumpentoum</option>
                                                                                <option value="tambacounda-ville">Tambacounda Ville</option>
                                                                            </optgroup>
                                                                            <optgroup label="Thiès">
                                                                                <option value="mbour">Mbour</option>
                                                                                <option value="thies-ville">Thiès Ville</option>
                                                                                <option value="tivaouane">Tivaouane</option>
                                                                            </optgroup>
                                                                            <optgroup label="Ziguinchor">
                                                                                <option value="bignona">Bignona</option>
                                                                                <option value="oussouye">Oussouye</option>
                                                                                <option value="ziguinchor-ville">Ziguinchor Ville</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label>Communes</label>
                                                                        <select class="form-control select2" name="communes[]" multiple required>
                                                                            <optgroup label="Dakar">
                                                                                <option value="plateau">Plateau</option>
                                                                                <option value="medina">Médina</option>
                                                                                <option value="gueule-tapee">Gueule Tapée</option>
                                                                                <option value="fass">Fass</option>
                                                                                <option value="colobane">Colobane</option>
                                                                            </optgroup>
                                                                            <optgroup label="Pikine">
                                                                                <option value="thiaroye">Thiaroye</option>
                                                                                <option value="yeumbeul">Yeumbeul</option>
                                                                                <option value="malika">Malika</option>
                                                                                <option value="keur-massar">Keur Massar</option>
                                                                            </optgroup>
                                                                            <optgroup label="Guédiawaye">
                                                                                <option value="golf">Golf Sud</option>
                                                                                <option value="sam">Sam Notaire</option>
                                                                                <option value="wakhinane">Wakhinane Nimzatt</option>
                                                                                <option value="ndiareme">Ndiarème Limamoulaye</option>
                                                                            </optgroup>
                                                                            <optgroup label="Rufisque">
                                                                                <option value="rufisque-est">Rufisque Est</option>
                                                                                <option value="rufisque-nord">Rufisque Nord</option>
                                                                                <option value="rufisque-ouest">Rufisque Ouest</option>
                                                                                <option value="bargny">Bargny</option>
                                                                            </optgroup>
                                                                        </select>
                                                                        </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Pièces jointes  <span class="text-danger">*</span></label>
                                                                <br>
                                                                <small class="text-muted">Veuillez joindre un rapport d'activité et les documents supplémentaires.</small>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                            <label>Rapport d'Activité <span class="text-danger">*</span></label>
                                                                            <input type="file" class="form-control-file" name="rapport" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>NINEA </label>
                                                                            <input type="file" class="form-control-file" name="ninea" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>RCCM </label>
                                                                            <input type="file" class="form-control-file" name="rccm" required>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Agrément</label>
                                                                            <input type="file" class="form-control-file" name="agrement" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Décret de création</label>
                                                                            <input type="file" class="form-control-file" name="decret" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Quitus fiscal</label>
                                                                            <input type="file" class="form-control-file" name="quitus" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-success">Valider</button>
                                                </div>
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
       <h3 class="card-title">Informations de la structure</h3>
       <table class="table table-striped table-hover">
           <thead>
               <tr>
                   <th>Nom Structure</th>
                   <th>Siège Social</th>
                   <th>NINEA</th> 
                   <th>Registre</th>
                   <th>Actions</th>
               </tr>
           </thead>
           <tbody>
               <tr>
                   <td>{{ $structure->nom_structure ?? '--' }}</td>
                   <td>{{ $structure->siege_social ?? '--' }}</td>
                   <td>{{ $structure->ninea_entreprise ?? '--' }}</td>
                   <td>{{ $structure->registre_entreprise ?? '--' }}</td>
                   <td>
                       <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editProfileModal">
                           <i class="fas fa-edit"></i>
                       </button>
                   </td>
               </tr>
           </tbody>
       </table>
   </div>

   <div id="dossiersForm" class="form-section" style="display:none;">
       <h3 class="card-title">Dossiers de candidature</h3>
       <table class="table table-striped table-hover">
           <thead>
               <tr>
                   <th>État</th>
                   <th>Activité</th>
                   <th>Type Structure</th> 
                   <th>Actions</th>
               </tr>
           </thead>
           <tbody>
               @forelse($candidatures ?? [] as $candidature)
               <tr>
                   <td><i class="fas fa-check-circle text-success"></i></td>
                   <td>{{ $candidature->intitule_activite }}</td>
                   <td>{{ $candidature->type_structure }}</td>
                   <td>
                       <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                       <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                   </td>
               </tr>
               @empty
               <tr><td colspan="4" class="text-center">Aucun dossier</td></tr>
               @endforelse
           </tbody>
       </table>
   </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    const newCandidatureBtn = document.querySelector('[data-target="#newCandidatureModal"]');
    
    function checkRequiredFields() {
        const structure = {
            nom_structure: '{{ $structure->nom_structure ?? "" }}',
            siege_social: '{{ $structure->siege_social ?? "" }}',
            date_creation: '{{ $structure->date_creation ?? "" }}',
            ninea_entreprise: '{{ $structure->ninea_entreprise ?? "" }}',
            registre_entreprise: '{{ $structure->registre_entreprise ?? "" }}',
            agrement_entreprise: '{{ $structure->agrement_entreprise ?? "" }}',
            nbre_membre: '{{ $structure->nbre_membre ?? "" }}',
            nom_contact: '{{ $structure->nom_contact ?? "" }}',
            prenom_contact: '{{ $structure->prenom_contact ?? "" }}',
            fonction_contact: '{{ $structure->fonction_contact ?? "" }}',
            tel_contact: '{{ $structure->tel_contact ?? "" }}',
            email_contact: '{{ $structure->email_contact ?? "" }}'
            };
        
        const isComplete = Object.values(structure).every(value => value !== "");
        newCandidatureBtn.disabled = !isComplete;
        
        if (!isComplete) {
            newCandidatureBtn.setAttribute('title', 'Veuillez d\'abord compléter votre profil');
       }
   }
    
    checkRequiredFields();
 });

// document.addEventListener('DOMContentLoaded', function() {
//    const newCandidatureBtn = document.querySelector('[data-target="#newCandidatureModal"]');
//    newCandidatureBtn.disabled = false;
//    newCandidatureBtn.classList.remove('disabled');
//    newCandidatureBtn.setAttribute('title', 'Nouvelle candidature');
// });
</script>

<script>
function showForm(formId, btnId) {
   // Cacher tous les formulaires
   document.querySelectorAll('.form-section').forEach(form => {
       form.style.display = 'none';
   });
   // Afficher le formulaire demandé
   document.getElementById(formId).style.display = 'block';
   
   // Mise à jour des boutons
   document.querySelectorAll('.card-tools a').forEach(btn => {
       btn.classList.remove('active');
   });
   document.getElementById(btnId).classList.add('active'); 
}



document.addEventListener('DOMContentLoaded', function () {
    const selectType = document.getElementById('type-structure');
    const entrepriseChamps = document.querySelectorAll('.entreprise-champs');
    const autresChamps = document.querySelectorAll('.autres-champs');
    const publiqueChamps = document.querySelectorAll('.publique-champs');

    // Fonction pour afficher/masquer les champs
    function toggleFields(type) {
        // Masquer tous les champs au départ
        entrepriseChamps.forEach(champ => champ.style.display = 'none');
        autresChamps.forEach(champ => champ.style.display = 'none');
        publiqueChamps.forEach(champ => champ.style.display = 'none');

        // Afficher les champs spécifiques selon le type
        switch (type) {
            case 'entreprise': // Entreprise sociale ou Société coopérative
                entrepriseChamps.forEach(champ => champ.style.display = 'block');
                break;
            case 'imf': // IMF, FINTECH, ONG, Banque, Compagnie d'assurance
                autresChamps.forEach(champ => champ.style.display = 'block');
                break;
            case 'public': // Structure publique
                publiqueChamps.forEach(champ => champ.style.display = 'block');
                break;
        }
    }

    // Détection des changements dans le champ de sélection
    selectType.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const type = selectedOption.getAttribute('data-type');
        toggleFields(type);
    });

    // Appel initial pour l'option sélectionnée par défaut
    const initialType = selectType.options[selectType.selectedIndex].getAttribute('data-type');
    toggleFields(initialType);
});


</script>