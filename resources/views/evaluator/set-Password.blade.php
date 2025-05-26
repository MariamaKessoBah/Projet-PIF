<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Définir votre mot de passe - Prix du Ministre</title>

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background-image: url('{{ asset('assets/img/hero-carousel/hero-carousel-1.png') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Style pour l'overlay de chargement */
    #loadingOverlay {
      display: none;
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(6px);
      z-index: 1050;
      justify-content: center;
      align-items: center;
      transition: opacity 0.3s ease-in-out;
      opacity: 0;
    }

    /* Spinner personnalisé */
    .spinner-border {
      width: 3rem;
      height: 3rem;
      border-width: 0.3em;
    }
  </style>
</head>
<body>

@if (session('status') === 'reset_success')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        title: 'Réinitialisation réussie',
        text: 'Votre mot de passe a été réinitialisé avec succès. Cliquez sur OK pour continuer.',
        icon: 'success',
        confirmButtonText: 'OK',
      }).then((result) => {
        if (result.isConfirmed) {
          const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
          loginModal.show();
        }
      });
    });
  </script>
@endif

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card">

        <div class="modal-header position-relative">
          <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
          <div class="position-absolute w-100 text-center">
            <h5 class="modal-title"><strong style="font-size: 3vh">REINITIALISER VOTRE MOT DE PASSE</strong></h5>
          </div>
        </div>

        <div class="card-body p-4">
          <p class="text-center mb-4">Veuillez choisir un mot de passe sécurisé pour votre compte.</p>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form id="setPasswordForm" action="{{ route('evaluateur.password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3 position-relative">
              <label for="password" class="form-label">Mot de passe</label>
              <div class="input-group">
                <input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Veuillez saisir votre mot de passe" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword1">
                  <i class="fas fa-eye" id="iconPassword1"></i>
                </button>
              </div>
            </div>

            <div class="mb-3 position-relative">
              <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
              <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control form-control-sm" id="password_confirmation" placeholder="Veuillez confirmer votre mot de passe" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                  <i class="fas fa-eye" id="iconPassword2"></i>
                </button>
              </div>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success" id="submitBtn">Définir mon mot de passe</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal de connexion -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="loginForm" action="{{ route('handleLogin') }}" method="POST">
          @csrf

          @if(session('error_msg'))
            <div class="alert alert-danger">
              {{ session('error_msg') }}
            </div>
          @endif

          <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-control form-control-sm" id="logEmail" required>
          </div>

          <div class="mb-3 position-relative">
            <label for="logPassword" class="form-label">Mot de passe</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control form-control-sm" id="logPassword" required>
              <button type="button" class="btn btn-outline-secondary" id="togglePasswordLogin">
                <i class="fas fa-eye" id="iconPasswordLogin"></i>
              </button>
            </div>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success" id="logSubmitBtn">Se connecter</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Toggle visibility for all password fields
  function setupTogglePassword(toggleId, inputId, iconId) {
    const toggleBtn = document.getElementById(toggleId);
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (toggleBtn && input && icon) {
      toggleBtn.addEventListener('click', function () {
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !isPassword);
        icon.classList.toggle('fa-eye-slash', isPassword);
      });
    }
  }

  // Init password toggles
  setupTogglePassword('togglePassword1', 'password', 'iconPassword1');
  setupTogglePassword('togglePassword2', 'password_confirmation', 'iconPassword2');
  setupTogglePassword('togglePasswordLogin', 'logPassword', 'iconPasswordLogin');

  // Display loading overlay when any form is submitted
  function handleFormSubmission(formId, buttonId) {
    const form = document.getElementById(formId);
    const submitBtn = document.getElementById(buttonId);
    form.addEventListener('submit', function () {
      const overlay = document.getElementById('loadingOverlay');
      if (overlay) {
        overlay.style.display = 'flex';
        setTimeout(() => {
          overlay.style.opacity = 1;
        }, 10);
      }
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Chargement...';
      }
    });
  }

  // Apply loading behavior for both forms
  handleFormSubmission('setPasswordForm', 'submitBtn');
  handleFormSubmission('loginForm', 'logSubmitBtn');

  // Show login modal if session requires
  @if(session('open_modal'))
    document.addEventListener('DOMContentLoaded', function () {
      const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
      loginModal.show();
    });
  @endif
</script>

<!-- Overlay de chargement -->
<div id="loadingOverlay">
  <div class="spinner-border text-light" role="status">
    <span class="visually-hidden">Chargement...</span>
  </div>
</div>

</body>
</html>
