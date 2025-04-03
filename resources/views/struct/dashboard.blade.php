@extends('layouts.template')

@section('title', 'Dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <hr class="border-primary">
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
       <!-- Info boxes -->
        <div class="col-12">
                <div class="card-body">
                    Bienvenu <strong>{{ Auth::user()->name }}</strong> au Prix de l'Inclusion Financière 2025 !
                </div>
        </div> 
        <hr>


<section class="content">
    <div class="container-fluid">
         <!-- Résumé du dossier -->
         <div class="row mt-4">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">État de votre candidature</span>
                        <span class="info-box-number">{{ $statut ?? 'Non soumis' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Date limite</span>
                        <span class="info-box-number">{{ $date_limite ?? '31 Mars 2025' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <!-- Informations générales -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informations du dossier</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>N° Dossier:</strong> #DPC-2024-001</p>
                        <p><strong>Date soumission:</strong> 20/01/2024</p>
                        <p><strong>Statut actuel:</strong> 
                            <span class="badge bg-warning">En cours d'évaluation</span>
                        </p>
                        <p><strong>Dernière mise à jour:</strong> 22/01/2024</p>
                    </div>
                </div>
            </div>

            <!-- Progression -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Progression du dossier</h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div>
                                <i class="fas fa-check bg-success"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 20/01/2024</span>
                                    <h3 class="timeline-header">Soumission du dossier</h3>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-check bg-success"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 20/01/2024</span>
                                    <h3 class="timeline-header">Validation du dossier</h3>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-sync bg-warning"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> En cours</span>
                                    <h3 class="timeline-header">Évaluation technique</h3>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-clock bg-secondary"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Délibération finale</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents -->
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Etat du dossier</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Activité</th>
                                    <th>Nombre de points</th>
                                    <th>Date soumission</th>
                                    <th>Rang</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Digital Banking Solutions</td>
                                    <td>100/140</td>
                                    <td>20/01/2024</td>
                                    <td><span class="rank">3</span> <i class="fas fa-trophy text-warning"></i></td> <!-- Rang + Icône Lauréat -->
                                    <td>
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Voir
                                        </button>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td>RCCM</td>
                                    <td><span class="badge bg-warning">En attente</span></td>
                                    <td>20/01/2024</td>
                                    <td>
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Voir
                                        </button>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications et Contact -->
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dernières notifications</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Dossier en cours d'évaluation</h5>
                                    <small>22/01/2024</small>
                                </div>
                                <p class="mb-1">Votre dossier est actuellement en cours d'évaluation par notre comité.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Contact support</h3>
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-envelope"></i> support@example.com</p>
                        <p><i class="fas fa-phone"></i> +221 XX XXX XX XX</p>
                        <button class="btn btn-primary">
                            <i class="fas fa-comment"></i> Envoyer un message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection