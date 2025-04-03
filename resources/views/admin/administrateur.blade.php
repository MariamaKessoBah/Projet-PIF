@extends('layouts.template')

@section('title', 'Dashboard_administrateur')

@section('content')
<div class="container">
   <!-- En-tête -->
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

   <!-- Statistiques -->
   <div class="row">
       <div class="col-lg-3 col-6">
           <div class="small-box bg-info">
               <div class="inner">
                   <h3>45</h3>
                   <p>Structures Enregistrées</p>
               </div>
               <div class="icon">
                   <i class="fas fa-building"></i>
               </div>
           </div>
       </div>

       <div class="col-lg-3 col-6">
           <div class="small-box bg-success">
               <div class="inner">
                   <h3>15</h3>
                   <p>Évaluateurs Actifs</p>
               </div>
               <div class="icon">
                   <i class="fas fa-user-check"></i>
               </div>
           </div>
       </div>

       <div class="col-lg-3 col-6">
           <div class="small-box bg-warning">
               <div class="inner">
                   <h3>8</h3>
                   <p>Nouvelles Inscriptions</p>
               </div>
               <div class="icon">
                   <i class="fas fa-user-plus"></i>
               </div>
           </div>
       </div>

       <div class="col-lg-3 col-6">
           <div class="small-box bg-danger">
               <div class="inner">
                   <h3>12</h3>
                   <p>En attente de validation</p>
               </div>
               <div class="icon">
                   <i class="fas fa-clock"></i>
               </div>
           </div>
       </div>
   </div>

   <!-- Tableau des dernières activités -->
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-header">
                   <h3 class="card-title">Dernières Activités</h3>
               </div>
               <div class="card-body table-responsive p-0">
                   <table class="table table-hover text-nowrap">
                       <thead>
                           <tr>
                               <th>Utilisateur</th>
                               <th>Action</th>
                               <th>Date</th>
                               <th>Statut</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>evaluateur@example.com</td>
                               <td>Évaluation complétée</td>
                               <td>{{ now()->format('d/m/Y H:i') }}</td>
                               <td><span class="badge badge-success">Terminé</span></td>
                           </tr>
                           <tr>
                               <td>structure@example.com</td>
                               <td>Nouvelle soumission</td>
                               <td>{{ now()->subHours(2)->format('d/m/Y H:i') }}</td>
                               <td><span class="badge badge-warning">En attente</span></td>
                           </tr>
                           <tr>
                               <td>admin@example.com</td>
                               <td>Ajout d'un évaluateur</td>
                               <td>{{ now()->subHours(5)->format('d/m/Y H:i') }}</td>
                               <td><span class="badge badge-info">Complété</span></td>
                           </tr>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>

   <!-- Graphiques statistiques -->
   <div class="row">
       <div class="col-md-6">
           <div class="card">
               <div class="card-header">
                   <h3 class="card-title">Répartition des Structures</h3>
               </div>
               <div class="card-body">
                   <canvas id="structuresChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
               </div>
           </div>
       </div>
       <div class="col-md-6">
           <div class="card">
               <div class="card-header">
                   <h3 class="card-title">Activité Mensuelle</h3>
               </div>
               <div class="card-body">
                   <canvas id="activityChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
               </div>
           </div>
       </div>
   </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
   // Graphique des structures
   new Chart(document.getElementById('structuresChart').getContext('2d'), {
       type: 'pie',
       data: {
           labels: ['IMF', 'FinTech', 'PTF', 'ONG', 'Banques'],
           datasets: [{
               data: [30, 25, 20, 15, 10],
               backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545', '#6610f2']
           }]
       }
   });

   // Graphique d'activité
   new Chart(document.getElementById('activityChart').getContext('2d'), {
       type: 'line',
       data: {
           labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
           datasets: [{
               label: 'Évaluations',
               data: [12, 19, 15, 25, 22, 30],
               borderColor: '#007bff'
           }]
       }
   });
});
</script>
@endpush
@endsection