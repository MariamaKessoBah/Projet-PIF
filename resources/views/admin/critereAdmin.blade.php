@extends('layouts.template')

@section('title', 'Critères_Evaluation')

@section('content')
<div class="container">
   <div class="content-header">
       <div class="container-fluid">
           <div class="row mb-2">
               <div class="col-sm-6">
                   <h1 class="m-0">Critères d'evaluation</h1>
               </div>
               <div class="col-sm-6 text-right">
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCriteriaModal">
                       <i class="fas fa-plus"></i> Nouveau critère
                   </button>
               </div>
           </div>
           <hr class="border-primary">
       </div>
   </div>

   <!-- Liste des critères -->
   <div class="card">
       <div class="card-body">
           <table class="table table-striped">
               <thead>
                   <tr>
                       <th>Désignation</th>
                       <th>Coefficient</th>
                       <th>Barème</th>
                       <th>Actions</th>
                   </tr>
               </thead>
               <tbody>
                   <tr>
                       <td>Zone d'intervention</td>
                       <td>3</td>
                       <td>10</td>
                       <td class="text-center">
                           <div class="btn-group">
                               <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCriteriaModal">
                                   <i class="fas fa-edit"></i>
                               </button>
                               <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCriteriaModal">
                                   <i class="fas fa-trash"></i>
                               </button>
                           </div>
                       </td>
                   </tr>
               </tbody>
           </table>
       </div>
   </div>
</div>

<!-- Modal Ajout -->
<div class="modal fade" id="addCriteriaModal">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">Ajouter un critère</h5>
               <button type="button" class="close" data-dismiss="modal">
                   <span>&times;</span>
               </button>
           </div>
           <form action="" method="POST">
               @csrf
               <div class="modal-body">
                   <div class="form-group">
                       <label>Désignation</label>
                       <input type="text" class="form-control" name="designation" required>
                   </div>
                   <div class="form-group">
                       <label>Coefficient</label>
                       <input type="number" class="form-control" name="coefficient" required>
                   </div>
                   <div class="form-group">
                       <label>Barème</label>
                       <input type="number" class="form-control" name="bareme" required>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn btn-primary">Enregistrer</button>
               </div>
           </form>
       </div>
   </div>
</div>

<!-- Modal Modification -->
<div class="modal fade" id="editCriteriaModal">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">Modifier le critère</h5>
               <button type="button" class="close" data-dismiss="modal">
                   <span>&times;</span>
               </button>
           </div>
           <form action="" method="POST">
               @csrf
               @method('PUT')
               <div class="modal-body">
                   <div class="form-group">
                       <label>Désignation</label>
                       <input type="text" class="form-control" name="designation" required>
                   </div>
                   <div class="form-group">
                       <label>Coefficient</label>
                       <input type="number" class="form-control" name="coefficient" required>
                   </div>
                   <div class="form-group">
                       <label>Barème</label>
                       <input type="number" class="form-control" name="bareme" required>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn btn-primary">Sauvegarder</button>
               </div>
           </form>
       </div>
   </div>
</div>

<!-- Modal Suppression -->
<div class="modal fade" id="deleteCriteriaModal">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">Confirmation de suppression</h5>
               <button type="button" class="close" data-dismiss="modal">
                   <span>&times;</span>
               </button>
           </div>
           <form action="" method="POST">
               @csrf
               @method('DELETE')
               <div class="modal-body">
                   <p>Êtes-vous sûr de vouloir supprimer ce critère ?</p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn btn-danger">Supprimer</button>
               </div>
           </form>
       </div>
   </div>
</div>
@endsection