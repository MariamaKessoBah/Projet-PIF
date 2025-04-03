@extends('layouts.template')

@section('title', 'Liste des Utilisateurs')

@section('content')

<div class="container">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Ajoutez cette ligne -->

    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white"></div>
    </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Liste des Lauréats</h1>
                </div>
            </div>
            <hr class="border-primary">
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-white"></div>
        </div>
        <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>


        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card card-outline card-success">
                   
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="list">
                            <thead>
                                <tr>
                                    <th>Rang / Lauréat</th> <!-- Colonne Rang / Lauréat -->
                                    <th>Nom de structure</th>
                                    <th>Intitulé de l'activité</th>
                                    <th>Secteur</th>
                                    <th>Nombre de points</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="rank">1</span> <i class="fas fa-trophy text-warning"></i></td> <!-- Rang + Icône Lauréat -->
                                    <td>FINTECH Group SA</td>
                                    <td>Digital Banking Solutions</td>
                                    <td>Services Financiers</td>
                                    <td>120</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="rank">2</span> <i class="fas fa-trophy text-warning"></i></td> <!-- Rang + Icône Lauréat -->
                                    <td>AquaPêche SARL</td>
                                    <td>Aquaculture Moderne</td>
                                    <td>Pêche et Aquaculture</td>
                                    <td>115</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="rank">3</span> <i class="fas fa-trophy text-warning"></i></td> <!-- Rang + Icône Lauréat -->
                                    <td>AgriTech Innovation</td>
                                    <td>Système d'Irrigation Intelligente</td>
                                    <td>Agriculture et Agroalimentaire</td>
                                    <td>110</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection