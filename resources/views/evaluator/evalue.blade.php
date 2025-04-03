@extends('layouts.template')

@section('title', 'Dashboard_evaluateur')
@section('content')
<div class="container">
    <!-- Statistiques générales -->
    
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

    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info elevation-3">
                <div class="inner px-3 py-4">
                    <h3 class="mb-0">150</h3>
                    <p class="mb-0">Candidats Total</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users text-white-50"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success elevation-3">
                <div class="inner px-3 py-4">
                    <h3 class="mb-0">53</h3>
                    <p class="mb-0">Candidats Validés</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle text-white-50"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning elevation-3">
                <div class="inner px-3 py-4">
                    <h3 class="mb-0">44</h3>
                    <p class="mb-0">En Attente</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock text-white-50"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-danger elevation-3">
                <div class="inner px-3 py-4">
                    <h3 class="mb-0">53</h3>
                    <p class="mb-0">Candidats Rejetés</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times-circle text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card card-outline card-info elevation-3">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Candidature par secteur d'activité
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="gradesChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-success elevation-3" >
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Nombre de dossier par type structure
                    </h3>
                </div>
                <div class="card-body">
                    <canvas id="criteriaChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières évaluations -->
    <div class="card card-outline card-primary elevation-3">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list-alt mr-2"></i>
                Évaluations Récentes
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="pl-4">Candidat</th>
                            <th>Date</th>
                            <th>Note Moyenne</th>
                            <th>Statut</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td class="pl-4">FINTECH</td>
                                <td>{{ now()->format('d/m/Y') }}</td>
                                <td>8/10</td>
                                <td>
                                    <span class="badge badge-success px-3 py-2">
                                        Validé
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fas fa-eye mr-1"></i> Voir
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-4">IMF</td>
                                <td>{{ now()->subDays(1)->format('d/m/Y') }}</td>
                                <td>6/10</td>
                                <td>
                                    <span class="badge badge-warning px-3 py-2">
                                        En cours
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fas fa-eye mr-1"></i> Voir
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-4">PTF</td>
                                <td>{{ now()->subDays(2)->format('d/m/Y') }}</td>
                                <td>4/10</td>
                                <td>
                                    <span class="badge badge-danger px-3 py-2">
                                        Rejeté
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fas fa-eye mr-1"></i> Voir
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="#" class="text-secondary">Voir toutes les évaluations</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
   // Premier graphique - Secteurs d'activités
   new Chart(document.getElementById('gradesChart').getContext('2d'), {
       type: 'bar',
       data: {
           labels: [
               'Agriculture/Agroalimentaire',
               'Pêche/Aquaculture', 
               'Commerce',
               'Services Financiers',
               'Transport',
               'Artisanat',
               'Tourisme',
               'Technologies',
               'Énergie',
               'Santé'
           ],
           datasets: [{
               data: [45, 35, 30, 25, 25, 20, 18, 15, 12, 10],
               backgroundColor: [
                   '#2ecc71', '#3498db', '#f1c40f', '#e74c3c',
                   '#9b59b6', '#1abc9c', '#f39c12', '#34495e',
                   '#95a5a6', '#16a085'
               ]
           }]
       },
       options: {
           responsive: true,
           maintainAspectRatio: false,
           plugins: {
               legend: { display: false }
           },
           scales: {
               y: {
                   beginAtZero: true,
                   title: {
                       display: true,
                       text: 'Nombre d\'activités'
                   }
               },
               x: {
                   grid: { display: false },
                   ticks: { maxRotation: 45, minRotation: 45 }
               }
           }
       }
   });

   // Deuxième graphique - Types de structures
   new Chart(document.getElementById('criteriaChart').getContext('2d'), {
       type: 'bar',
       data: {
           labels: ['IMF', 'FinTech', 'PTF', 'ONG', 'Banques', 'Assurances'],
           datasets: [{
               data: [25, 20, 15, 12, 10, 8],
               backgroundColor: [
                   '#28a745', '#17a2b8', '#ffc107',
                   '#dc3545', '#6610f2', '#fd7e14'
               ]
           }]
       },
       options: {
           responsive: true,
           maintainAspectRatio: false,
           plugins: {
               legend: { display: false }
           },
           scales: {
               y: {
                   beginAtZero: true,
                   title: {
                       display: true,
                       text: 'Nombre de dossiers'
                   }
               },
               x: {
                   grid: { display: false }
               }
           }
       }
   });
});
</script>
@endpush