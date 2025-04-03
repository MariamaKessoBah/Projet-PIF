@extends('layouts.template')

@section('title', 'CritereEvaluation')

@section('content')
<div class="container">
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Critères d'évaluation</h1>
            </div>
        </div>
        <hr class="border-primary">
    </div>
</div>
    <div class="container-fluid">
    <!-- Card des critères -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Critères d'évaluation</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="30%">Critère</th>
                            <th>Description</th>
                            <th width="15%">coefficient</th>
                            <th width="15%">Score max</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Zone d'intervention</strong>
                            </td>
                            <td>
                                <ul>
                                    <li>Couverture géographique</li>
                                    <li>Accessibilité des services</li>
                                    <li>Impact territorial</li>
                                </ul>
                            </td>
                            <td class="text-center">3</td>
                            <td class="text-center">10 points</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Cible</strong>
                            </td>
                            <td>
                                <ul>
                                    <li>Identification des bénéficiaires</li>
                                    <li>Pertinence de la solution</li>
                                    <li>Impact social</li>
                                </ul>
                            </td>
                            <td class="text-center">4</td>
                            <td class="text-center">10 points</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Secteur d'activité</strong>
                            </td>
                            <td>
                                <ul>
                                    <li>Pertinence sectorielle</li>
                                    <li>Innovation dans le secteur</li>
                                    <li>Potentiel de croissance</li>
                                </ul>
                            </td>
                            <td class="text-center">5</td>
                            <td class="text-center">10 points</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Innovation</strong>
                            </td>
                            <td>
                                <ul>
                                    <li>Caractère innovant de la solution</li>
                                    <li>Utilisation des nouvelles technologies</li>
                                    <li>Avantage compétitif</li>
                                    <li>Originalité de l'approche</li>
                                    <li>Capacité de disruption du marché</li>
                                </ul>
                            </td>
                            <td class="text-center">5</td>
                            <td class="text-center">10 points</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Notes explicatives -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Guide de notation</h3>
                </div>
                <div class="card-body">
                    <div class="rating-guide">
                        <p><strong>8-10 points:</strong> Excellent - Répond parfaitement aux critères</p>
                        <p><strong>6-7 points:</strong> Bon - Répond bien aux critères avec quelques améliorations possibles</p>
                        <p><strong>4-5 points:</strong> Moyen - Répond partiellement aux critères</p>
                        <p><strong>0-3 points:</strong> Insuffisant - Ne répond pas aux critères</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Documents de référence</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-file-pdf mr-2"></i>
                            <a href="#">Guide complet d'évaluation</a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-file-excel mr-2"></i>
                            <a href="#">Grille de notation détaillée</a>
                        </li>
                        <li>
                            <i class="fas fa-file-word mr-2"></i>
                            <a href="#">Modèle de rapport d'évaluation</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection