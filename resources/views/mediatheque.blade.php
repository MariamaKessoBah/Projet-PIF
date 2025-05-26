@extends('layouts.accueil_template')

@section('title', 'DocCandidature')

@section('content')

<main class="main">

  <!-- Login and Register Modals -->
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
  @include('auth.register')

  <hr>

  <!-- Section: À Propos -->
  <section id="apropos" class="apropos section">
    <div class="container" data-aos="fade-up">
      
      <!-- Titre -->
      <div class="section-title text-center" data-aos="fade-up">
        <h2 class="fw-bold text-primary">📸 Images & 🎥 Vidéos</h2>
        {{-- <p class="text-muted">Découvrez nos meilleurs moments en images et en vidéos.</p> --}}
      </div>

      <!-- Vidéo de Présentation -->
      <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
          <div class="ratio ratio-16x9 video-container shadow-lg rounded-4 overflow-hidden">
            <iframe src="https://www.youtube.com/embed/XVpmJDQeiW4" title="Vidéo de présentation" allowfullscreen></iframe>
          </div>
        </div>
      </div>

      <!-- Carrousel d'images -->
      <div class="carousel-container mb-5">
        <div id="carouselExampleCaptions" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/hero-carousel/1.jpg" class="d-block w-100 object-fit-cover rounded-3" alt="Image 1" style="height: 400px;">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5 class="text-white">Première Image</h5>
                <p class="text-light">Un instant capturé avec soin.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/img/hero-carousel/2.jpg" class="d-block w-100 object-fit-cover rounded-3" alt="Image 2" style="height: 400px;">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5 class="text-white">Deuxième Image</h5>
                <p class="text-light">Un moment inoubliable.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/img/hero-carousel/3.jpg" class="d-block w-100 object-fit-cover rounded-3" alt="Image 3" style="height: 400px;">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5 class="text-white">Troisième Image</h5>
                <p class="text-light">Une image qui parle d'elle-même.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon rounded-circle bg-dark p-3" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon rounded-circle bg-dark p-3" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
          </button>
        </div>
      </div>

    </div>
  </section>

  
</main>

@endsection
