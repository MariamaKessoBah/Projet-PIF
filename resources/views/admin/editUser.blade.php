@extends('layouts.template')

@section('title', 'Critères_Evaluation')

@section('content')
<div class="container">
   <!-- En-tête -->
   <div class="content-header">
       <div class="container-fluid">
           <div class="row mb-2">
               <div class="col-sm-6">
                   <h1 class="m-0">Ajout utilisateur</h1>
               </div>
           </div>
           <hr class="border-primary">
       </div>
   </div>



        <section class="content">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="control-label">Nom</label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label">Prénom</label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label">Origine Structure</label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label">Fonction</label>
                                            <input type="text" name="name" class="form-control form-control-sm" value="" required>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="email" class="form-control form-control-sm" name="email" value="" required>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="id_service" class="control-label">Role</label>
                                            <select class="form-control" name="id_service" id="id_service" required>
                                                <option value="">Sélectionner un role</option>
                                                <option value="">evaluateur</option>
                                                <option value="">admin</option>
                                            </select>
                                           
                                      </div>
                                        <div class="form-group">
                                            <label for="password" class="control-label">Mot de Passe</label>
                                            <input type="password" class="form-control form-control-sm" name="password" placeholder="Laissez vide si inchangé">
                                            <!-- Affichage de l'erreur -->
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation" class="control-label">Confirmer Mot de Passe</label>
                                            <input type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="Laissez vide si inchangé">
                                            <!-- Affichage de l'erreur -->
                                        </div>

                                    </div>

                                    
                                </div>
                
                                <hr>
                                <div class="col-lg-12 text-right">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    </div>
@endsection