<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed" style="height: 100vh; background-color: #296955;">
    <div class="dropdown">
        <div style="text-align: center;">
            <a href="" class="brand-link">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
            </a>
        </div>
    </div>
    <div class="sidebar pb-4 mb-4">
        <nav class="mt-2" role="navigation">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">

                @if(Auth::user()->role === 'structure')
                    <!-- Dashboard -->
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Tableau de bord</p>
                        </a>
                    </li>
                    <!-- Candidater -->
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('candidater') }}" class="nav-link {{ request()->routeIs('candidater') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Candidater</p>
                        </a>
                    </li>
                    <!-- Historique -->
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="#" class="nav-link {{ request()->routeIs('historique') ? 'active' : '' }}">
                            <i class="fas fa-history nav-icon"></i> 
                            <p>Historique</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role === 'DMIF')
                    <!-- Dashboard DMIF -->
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('evalue') }}" class="nav-link {{ request()->routeIs('evalue') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- Liste des Candidats -->
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('listeCandidat') }}" class="nav-link {{ request()->routeIs('listeCandidat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Liste des Candidats</p>
                        </a>
                    </li>
                    <!-- Lauréat -->
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('laureat') }}" class="nav-link {{ request()->routeIs('laureat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-trophy"></i>
                            <p>Lauréat</p>
                        </a>
                    </li>
                    <!-- Critères d'Évaluation -->
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('critereEvaluation') }}" class="nav-link {{ request()->routeIs('critereEvaluation') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>Critères d'Évaluation</p>
                        </a>
                    </li>

                    @php
                        $users_routes = ['registerEvaluator', 'editEvaluator']; // <-- ici c'est CORRIGÉ
                    @endphp

                    <!-- Menu Users avec sous-menus -->
                    <li class="nav-item {{ in_array(request()->route()->getName(), $users_routes) ? 'menu-open' : '' }}" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="#" class="nav-link {{ in_array(request()->route()->getName(), $users_routes) ? 'active' : '' }}">
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

                <!-- Evaluateur & Jury -->
                @if(in_array(Auth::user()->role, ['evaluateur', 'jury']))
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('evalue') }}" class="nav-link {{ request()->routeIs('evalue') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('listeCandidat') }}" class="nav-link {{ request()->routeIs('listeCandidat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Liste des Candidats</p>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('laureat') }}" class="nav-link {{ request()->routeIs('laureat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-trophy"></i>
                            <p>Lauréat</p>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('critereEvaluation') }}" class="nav-link {{ request()->routeIs('critereEvaluation') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>Critères d'Évaluation</p>
                        </a>
                    </li>
                @endif

                <!-- Super Admin -->
                @if(Auth::user()->role === 'superAdmin')
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('administrateur') }}" class="nav-link {{ request()->routeIs('administrateur') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('critereAdmin') }}" class="nav-link {{ request()->routeIs('critereAdmin') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>Critères d'Évaluation</p>
                        </a>
                    </li>
                    <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                        <a href="{{ route('listeUser') }}" class="nav-link {{ request()->routeIs('listeUser') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Liste des utilisateurs</p>
                        </a>
                    </li>
                @endif

                <!-- Déconnexion -->
                <li class="nav-item" style="margin-bottom: 10px; border-bottom: 1px solid #444;">
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                        @csrf
                        <button type="submit" style="background-color: #296955; color: #c4c4c4; border: none;" class="nav-link" id="logoutButton">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p class="logout-text">Déconnexion</p>
                        </button>
                    </form>
                    <div id="progressBarContainer" style="display: none; margin-top: 10px;">
                        <div class="progress" style="height: 10px;">
                            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
