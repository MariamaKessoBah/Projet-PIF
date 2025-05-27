<style>
    .nav-section {
        margin-bottom: 10px;
        border-bottom: 1px solid #444;
    }

    .logout-spinner {
        display: none;
        margin-left: 5px;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed" style="height: 100vh; background-color: #296955;">
    <div class="dropdown">
        <div style="text-align: center;">
            <a href="#" class="brand-link">
                <img src="{{ asset('images/logo.png') }}" alt="Logo du Ministère" style="height: 40px;">
            </a>
        </div>
    </div>

    <div class="sidebar pb-4 mb-4">
        <nav class="mt-2" role="navigation" aria-label="Navigation principale">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">

                {{-- Structure --}}
                @if(Auth::check() && Auth::user()->role === 'structure')
                    <li class="nav-item nav-section">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Tableau de bord</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('candidater') }}" class="nav-link {{ request()->routeIs('candidater') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Candidater</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="#" class="nav-link {{ request()->routeIs('historique') ? 'active' : '' }}">
                            <i class="fas fa-history nav-icon"></i>
                            <p>Historique</p>
                        </a>
                    </li>
                @endif

                {{-- DMIF --}}
                @if(Auth::check() && Auth::user()->role === 'DMIF')
                    <li class="nav-item nav-section">
                        <a href="{{ route('evalue') }}" class="nav-link {{ request()->routeIs('evalue') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('listeCandidat') }}" class="nav-link {{ request()->routeIs('listeCandidat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Liste des Candidats</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('laureat') }}" class="nav-link {{ request()->routeIs('laureat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-trophy"></i>
                            <p>Lauréat</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('critereEvaluation') }}" class="nav-link {{ request()->routeIs('critereEvaluation') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>Critères d'Évaluation</p>
                        </a>
                    </li>

                    @php
                        $users_routes = ['registerEvaluator', 'editEvaluator'];
                        $users_open = in_array(request()->route()->getName(), $users_routes);
                    @endphp

                    <li class="nav-item nav-section {{ $users_open ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $users_open ? 'active' : '' }}" aria-expanded="{{ $users_open ? 'true' : 'false' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('registerEvaluator') }}" class="nav-link {{ request()->routeIs('registerEvaluator') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Ajouter Evaluateur</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('editEvaluator') }}" class="nav-link {{ request()->routeIs('editEvaluator') ? 'active' : '' }}">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                    <p>Editer Evaluateur</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Evaluateur & Jury --}}
                @if(Auth::check() && in_array(Auth::user()->role, ['evaluateur', 'jury']))
                    <li class="nav-item nav-section">
                        <a href="{{ route('evalue') }}" class="nav-link {{ request()->routeIs('evalue') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('listeCandidat') }}" class="nav-link {{ request()->routeIs('listeCandidat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Liste des Candidats</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('laureat') }}" class="nav-link {{ request()->routeIs('laureat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-trophy"></i>
                            <p>Lauréat</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('critereEvaluation') }}" class="nav-link {{ request()->routeIs('critereEvaluation') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>Critères d'Évaluation</p>
                        </a>
                    </li>
                @endif

                {{-- Super Admin --}}
                @if(Auth::check() && Auth::user()->role === 'superAdmin')
                    <li class="nav-item nav-section">
                        <a href="{{ route('administrateur') }}" class="nav-link {{ request()->routeIs('administrateur') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('critereAdmin') }}" class="nav-link {{ request()->routeIs('critereAdmin') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>Critères d'Évaluation</p>
                        </a>
                    </li>
                    <li class="nav-item nav-section">
                        <a href="{{ route('listeUser') }}" class="nav-link {{ request()->routeIs('listeUser') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Liste des utilisateurs</p>
                        </a>
                    </li>
                @endif

                {{-- Déconnexion --}}
                <li class="nav-item nav-section">
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                        @csrf
                        <button type="submit" style="background-color: #296955; color: #c4c4c4; border: none;" class="nav-link" id="logoutButton">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p class="logout-text">Déconnexion</p>
                            <i id="logoutSpinner" class="fas fa-spinner fa-spin logout-spinner"></i>
                        </button>
                    </form>
                    <div id="progressBarContainer" style="display: none; margin-top: 10px;">
                        <div class="progress" style="height: 10px;">
                            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                 style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<script>
    document.getElementById('logoutForm').addEventListener('submit', function(e) {
        e.preventDefault();

        document.getElementById('progressBarContainer').style.display = 'block';
        document.getElementById('logoutSpinner').style.display = 'inline-block';

        let progress = 0;
        let interval = setInterval(function() {
            if (progress < 100) {
                progress += 10;
                document.getElementById('progressBar').style.width = progress + '%';
                document.getElementById('progressBar').setAttribute('aria-valuenow', progress);
            } else {
                clearInterval(interval);
                document.getElementById('logoutForm').submit();
            }
        }, 200);
    });
</script>
