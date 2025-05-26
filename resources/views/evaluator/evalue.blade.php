@extends('layouts.template')

@section('title', 'Dashboard_evaluateur')

@section('content')
<div class="container">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tableau de bord</h1>
                </div>
            </div>
            <hr class="border-primary">
        </div>
    </div>

    <!-- Statistiques générales -->
    <div class="row mb-4">
        @php
            $stats = [
                ['count' => $candidatures->count(), 'text' => 'Candidatures Reçues', 'color' => 'primary', 'icon' => 'users'],
                ['count' => $attente, 'text' => 'Candidatures en Attente de validation', 'color' => 'secondary', 'icon' => 'clock'],
                ['count' => $valides, 'text' => 'Candidatures Validées', 'color' => 'warning', 'icon' => 'check-circle'],
                ['count' => $rejectes, 'text' => 'Candidatures Rejetées', 'color' => 'danger', 'icon' => 'times-circle'],
                ['count' => $evalues, 'text' => 'Candidatures Évaluées', 'color' => 'info', 'icon' => 'clipboard-check'],
                ['count' => $termines, 'text' => 'Candidatures Acceptées', 'color' => 'success', 'icon' => 'gavel'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="col-lg-4 col-6">
                <div class="small-box bg-gradient-{{ $stat['color'] }} elevation-3">
                    <div class="inner px-3 py-4">
                        <h3 class="mb-0">{{ $stat['count'] }}</h3>
                        <p class="mb-0">{{ $stat['text'] }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-{{ $stat['icon'] }} text-white-50"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Graphiques -->
    <div class="row mb-4">
        @php
            $charts = [
                ['id' => 'gradesChart', 'title' => 'Nombre de candidatures par secteur d\'activité', 'color' => 'info', 'type' => 'bar'],
                ['id' => 'criteriaChart', 'title' => 'Nombre de dossier par type structure', 'color' => 'success', 'type' => 'pie']
            ];
        @endphp

        @foreach ($charts as $chart)
            <div class="col-md-6">
                <div class="card card-outline card-{{ $chart['color'] }} elevation-3">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-{{ $chart['type'] == 'pie' ? 'pie' : 'bar' }} mr-2"></i>
                            {{ $chart['title'] }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="{{ $chart['id'] }}" style="min-height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<!-- Style spécifique aux graphiques -->
<style>
    #criteriaChart {
        max-height: 400px !important;
    }
</style>

@push('scripts')
<!-- Inclusion de Chart.js et du plugin DataLabels -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonction de création des graphiques
    function createChart(elementId, data, labels, colors, chartType, tooltipText) {
        const total = data.reduce((sum, value) => sum + value, 0);
        const percentages = data.map(value => ((value / total) * 100).toFixed(1) + "%");

        new Chart(document.getElementById(elementId).getContext('2d'), {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: chartType === 'pie' ? 'bottom' : 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw} ${tooltipText} (${percentages[context.dataIndex]})`;
                            }
                        }
                    },
                    datalabels: chartType === 'pie' ? {
                        color: '#fff',
                        font: { weight: 'bold' },
                        formatter: (value, context) => percentages[context.dataIndex] // Affichage des % sur le graphique
                    } : {}
                },
                scales: chartType === 'bar' ? {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Nombre' },
                        ticks: { stepSize: 1, callback: (value) => Number(value).toFixed(0) }
                    },
                    x: { grid: { display: false }, ticks: { autoSkip: false, maxRotation: 45, minRotation: 45 } }
                } : {}
            },
            plugins: [ChartDataLabels]
        });
    }

    // Premier graphique (bar chart)
    createChart('gradesChart', 
        @json($secteurStats).map(i => i.total), 
        @json($secteurStats).map(i => i.designation_secteur),
        ['#2ecc71', '#3498db', '#f1c40f', '#e74c3c', '#9b59b6', '#1abc9c', '#f39c12', '#34495e', '#95a5a6', '#16a085'],
        'bar', 'candidature(s)');

    // Deuxième graphique (pie chart) avec pourcentages affichés
    createChart('criteriaChart', 
        @json($structureStats).map(i => i.total), 
        @json($structureStats).map(i => i.type),
        ['#28a745', '#17a2b8', '#ffc107', '#dc3545', '#6610f2', '#fd7e14'],
        'pie', 'structure(s)');
});
</script>
@endpush
<!-- Fin de la section -->
```
