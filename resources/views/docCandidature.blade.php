@extends('layouts.accueil_template')

@section('title', 'DocCandidature')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<main class="main">
  <!-- Login & Register Modals -->
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

  <!-- Section : Composition du dossier de candidature -->
  <section id="apropos" class="apropos section">
    <div class="container" data-aos="fade-up">
      
      <!-- Section Title -->
      <div class="section-title text-center" data-aos="fade-up">
        <h2><strong>Composition du dossier de candidature</strong></h2>
        <p>Comment participer ?</p>
      </div>

      <!-- Accordion -->
      <div class="accordion" id="accordionPanelsStayOpenExample">
        
        <!-- Étape 1 : Création de Compte -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#etape1" aria-expanded="true" aria-controls="etape1">
              <strong>Étape 1 : </strong> Création de Compte
            </button>
          </h2>
          <div id="etape1" class="accordion-collapse collapse show">
            <div class="accordion-body">
              <strong>Pour soumettre votre candidature, vous devez créer un compte utilisateur.</strong>
              <p>Un message de confirmation, contenant vos identifiants de connexion, vous sera envoyé par email.</p>
            </div>
          </div>
        </div>

        <!-- Étape 2 : Identification du candidat -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#etape2" aria-expanded="false" aria-controls="etape2">
              <strong>Étape 2 : </strong> Identification du candidat
            </button>
          </h2>
          <div id="etape2" class="accordion-collapse collapse">
            <div class="accordion-body">
              <strong>Renseignez une fiche signalétique comprenant les informations suivantes :</strong>
              <ul>
                <li>Statut</li>
                <li>Dénomination sociale</li>
                <li>Date de création</li>
                <li>Siège social</li>
                <li>Téléphone, Adresse mail</li>
                <li>Nombre de membres</li>
                <li>Point de contact (nom, prénoms, coordonnées et fonction)</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Étape 3 : Dossier de candidature -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#etape3" aria-expanded="false" aria-controls="etape3">
              <strong>Étape 3 : </strong> Dossier de candidature
            </button>
          </h2>
          <div id="etape3" class="accordion-collapse collapse">
            <div class="accordion-body">
              <strong>Remplissez le formulaire et joignez les documents utiles.</strong>
            </div>
            <!-- ✅ Bouton Télécharger le guide placé seul et visible -->
            <div class="mb-3 text-right">
              <a href="" 
                class="btn btn-primary" 
                target="_blank"
                title="Télécharger le guide de candidature">
                <i class="fas fa-file-download"></i> Télécharger le guide
              </a>
            </div>
          </div>
        </div>

        <!-- Étape 4 : Dossiers à joindre -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#etape4" aria-expanded="false" aria-controls="etape4">
              <strong>Étape 4 : </strong> Dossiers à joindre
            </button>
          </h2>
          <div id="etape4" class="accordion-collapse collapse">
            <div class="accordion-body">
              <p><strong>Chaque candidat doit joindre le rapport validé de l'activité présenté.</strong></p>
              <strong>Documents requis selon le statut :</strong>
              <ul>
                <li><i class="bi bi-check-circle-fill"></i> Entreprises sociales et sociétés coopératives : NINEA, RCCM et Quitus fiscal</li>
                <li><i class="bi bi-check-circle-fill"></i> IMF, FINTECH, ONG, Banques, compagnies d’assurance : Agrément</li>
                <li><i class="bi bi-check-circle-fill"></i> Structures publiques : Décret de création</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Adresse de soumission / Délais -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#etape5" aria-expanded="false" aria-controls="etape5">
              Adresse de soumission / Délais
            </button>
          </h2>
          <div id="etape5" class="accordion-collapse collapse">
            <div class="accordion-body">
              <p><strong>Les candidatures doivent être soumises via cette plateforme (<code>www.prixmmess.gouv.sn</code>).</strong></p>
              <p><strong>Aucun document physique ne sera accepté.</strong></p>
              <p>La date limite des candidatures est fixée au <code>XX XX 2025</code>.</p>
            </div>
          </div>
        </div>

      </div> <!-- End Accordion -->

      <!-- Bouton Participer -->
      <div class="text-center mt-4">
        <p>
          Si vous voulez participer, veuillez cliquer sur le bouton ci-dessous pour ouvrir un compte.
        </p>
        <a href="" data-bs-toggle="modal" data-bs-target="#registerModal" class="btn btn-primary">Participer</a>
      </div>

    </div> <!-- End Container -->
  </section>
</main>
@endsection
