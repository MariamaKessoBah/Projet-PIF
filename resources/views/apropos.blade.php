@extends('layouts.accueil_template')

@section('title', 'À Propos')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<main class="main">
  <!-- Login Modal -->
<div class="modal fade {{ session('open_modal') ? 'show' : '' }}" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  
  <style>
    /* Responsive pour les petits écrans */
    @media (max-width: 576px) {
      .modal-dialog {
        max-width: 90%;
      }
    }


    /* Style pour les cubes animés */
    .loading-cubes {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 5px;
    }

    .loading-cube {
      width: 20px;
      height: 20px;
      background-color: #007bff;
      border-radius: 5px;
      animation: bounce 0.6s infinite alternate;
    }

    .loading-cube:nth-child(2) {
      animation-delay: 0.2s;
    }

    .loading-cube:nth-child(3) {
      animation-delay: 0.4s;
    }

    /* Animation pour les cubes */
    @keyframes bounce {
      0% {
        transform: translateY(0);
      }
      100% {
        transform: translateY(-15px);
      }
    }
    
    /* Masquer les cubes au départ */
    .loading-cubes {
      display: none;
    }
  </style>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header position-relative">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
        <div class="position-absolute w-100 text-center">
          <h5 class="modal-title" id="loginModalLabel"><strong>CONNEXION</strong></h5>
        </div>
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form id="loginForm" action="{{ route('handleLogin') }}" method="POST">
          @csrf <!-- Protection contre les attaques CSRF -->
          @if(session('error_msg'))
            <div class="alert alert-danger">
              {{ session('error_msg') }}
            </div>
          @endif
          <!-- Afficher le message d'erreur si disponible -->
          {{-- @include('components.error-message') --}}

          <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-control form-control-sm" id="logEmail" placeholder="Veuillez saisir votre email" required aria-label="Adresse email">
          </div>

          <div class="mb-3 position-relative">
            <label for="password" class="form-label">Mot de passe</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control form-control-sm" id="logPassword" placeholder="Veuillez saisir votre mot de passe" required aria-label="Mot de passe">
              <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1" style="border-left: none;" aria-pressed="false">
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
              </button>
            </div>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success" id="logSubmitBtn">Se connecter</button>
            <!-- Cube de chargement -->
            <div id="loadingCubes" class="loading-cubes">
              <div class="loading-cube"></div>
              <div class="loading-cube"></div>
              <div class="loading-cube"></div>
            </div>
          </div>
        </form>

        <hr>

        <div class="text-center">
          <p>Pas encore de compte ? <a href="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal">Créer un compte</a></p>
        </div>
      </div>
    </div>

    <script>
      // Cacher ou afficher le mot de passe et changer l'icône
      document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('logPassword');
        const passwordIcon = document.getElementById('togglePasswordIcon');
        const toggleButton = document.getElementById('togglePassword');
    
        // Toggle le type du champ de mot de passe
        if (passwordField.type === 'password') {
          passwordField.type = 'text';
          passwordIcon.classList.remove('fa-eye');
          passwordIcon.classList.add('fa-eye-slash'); // Modifier l'icône pour 'mot de passe visible'
          toggleButton.setAttribute('aria-pressed', 'true'); // Indiquer que le mot de passe est visible
        } else {
          passwordField.type = 'password'; // Correction ici: 'password' au lieu de 'logPassword'
          passwordIcon.classList.remove('fa-eye-slash');
          passwordIcon.classList.add('fa-eye'); // Remettre l'icône pour 'mot de passe caché'
          toggleButton.setAttribute('aria-pressed', 'false'); // Indiquer que le mot de passe est caché
        }
      });
    
      // Afficher le modal si la session est définie
      @if(session('open_modal'))
        document.addEventListener('DOMContentLoaded', function () {
          const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
          loginModal.show(); // Ouvre le modal
        });
      @endif
    
      // Afficher ou masquer les cubes animés lors de la soumission du formulaire
      document.getElementById('loginForm').addEventListener('submit', function(event) {
        const submitButton = document.getElementById('logSubmitBtn');
        const loadingCubes = document.getElementById('loadingCubes');
    
        // Désactiver le bouton de soumission
        submitButton.disabled = true;
        // Afficher les cubes
        loadingCubes.style.display = 'flex';
      });
      
      
    </script>
    <script>
      // Lors de la fermeture du modal de connexion, ne pas supprimer la couche sombre immédiatement
      $('#loginModal').on('hidden.bs.modal', function () {
        // Vérifie si le modal d'inscription est ouvert
        if (!$('#registerModal').hasClass('show')) {
          // Si le modal d'inscription est fermé, on enlève la couche sombre
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
        }
      });
    
      // Lors de l'ouverture du modal d'inscription, on ferme le modal de connexion
      $('#loginModal').on('hide.bs.modal', function () {
        $('#registerModal').modal('show');  // Ouvre le modal d'inscription
      });
    </script>
  </div>

  
</div>
  <hr>
  <!-- Section: À Propos -->
  <section id="apropos" class="apropos section py-5">
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center">
        <!-- Titre principal -->
        <div class="text-center mb-5">
          <p class="lead text-muted">Prix du Ministre de la Microfinance et de l’Économie Sociale et Solidaire pour la Promotion de l’Inclusion Financière</p>
        </div>

        <div class="row">
          <!-- Colonne gauche -->
          <div class="col-lg-12">
            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">À propos du prix</h4>
              <p>
                Le Ministère de la Microfinance et de l'Économie Sociale et Solidaire a lancé un prix annuel pour récompenser les initiatives marquantes dans le domaine de l'inclusion financière. Ce prix vise à encourager et à mettre en lumière les acteurs de la microfinance qui œuvrent pour un meilleur accès aux services financiers pour tous.
              </p>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Pourquoi participer ?</h4>
              <p>Participer à ce prix vous permet de :</p>
              <ul class="list-unstyled">
                <li>- Mettre en avant votre projet à un large public.</li>
                <li>- Bénéficier d'une reconnaissance au sein de l'écosystème de l'inclusion financière.</li>
                <li>- Contribuer à l'atteinte des objectifs de développement durable.</li>
                <li>- Rejoindre un réseau dynamique d'acteurs engagés pour un changement social positif.</li>
              </ul>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Qui peut participer ?</h4>
              <p>Le prix est ouvert à une large gamme d'acteurs du secteur :</p>
              <ul class="list-unstyled">
                <li>- Institutions de Microfinance</li>
                <li>- FINTECH</li>
                <li>- ONG</li>
                <li>- Banques</li>
                <li>- Compagnies d'assurances</li>
                <li>- Structures publiques</li>
                <li>- Entreprises sociales</li>
                <li>- Sociétés coopératives</li>
              </ul>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Calendrier</h4>
              <ul class="list-unstyled">
                <li>📅 <strong>Février :</strong> Ouverture des candidatures</li>
                <li>🏆 <strong>Mars :</strong> Cérémonie de remise des prix</li>
              </ul>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Critères de participation</h4>
              <p>Les projets seront évalués selon plusieurs critères :</p>
              <ul class="list-unstyled">
                <li><strong>Impact géographique :</strong> Présence en zones rurales et auprès des populations vulnérables.</li>
                <li><strong>Utilisation des technologies :</strong> Intégration des solutions numériques pour améliorer l'accès aux services financiers.</li>
                <li><strong>Adaptation aux besoins sociaux :</strong> Prise en compte des besoins spécifiques des femmes, des jeunes et des populations vulnérables.</li>
              </ul>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Comment participer ?</h4>
              <p>La participation au prix se fait en trois étapes simples :</p>
              <ol class="mb-3">
                <li>📝 Créez un compte sur la plateforme.</li>
                <li>📌 Complétez le formulaire en détaillant votre projet et en répondant aux critères.</li>
                <li>📎 Soumettez les pièces justificatives demandées.</li>
              </ol>
              <p>Un jury d'experts évaluera toutes les candidatures selon les critères mentionnés ci-dessus.</p>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Foire aux questions</h4>
              <p>
                  📩 Si vous avez des questions, vous pouvez consulter notre 
                  <a href="{{ url('/#faq') }}" class="text-primary">FAQ</a>
                  ou nous contacter directement via la plateforme.
              </p>
          </div>
          
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

@endsection
