<head>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
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
        <form action="{{ route('handleLogin') }}" method="POST">
          @csrf <!-- Protection contre les attaques CSRF -->
          
          <!-- Afficher le message d'erreur si disponible -->
          @if(session('error_msg'))
            <div class="alert alert-danger">
              {{ session('error_msg') }}
            </div>
          @endif
          
          <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Veuillez saisir votre email" required>
          </div>
          
          <div class="mb-3 position-relative">
            <label for="password" class="form-label">Mot de passe</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control" id="password" placeholder="Veuillez saisir votre mot de passe" required>
              <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1" style="border-left: none;">
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
              </button>
            </div>
          </div>
      

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">Se connecter</button>
          </div>
        </form>
        
        <hr>
        
        <div class="text-center">
          <p>Pas encore de compte ? <a href="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal">Créer un compte</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Cacher ou afficher le mot de passe et changer l'icône
  document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('togglePasswordIcon');

    // Vérifier si le champ est en mode 'password' ou 'text'
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      passwordIcon.classList.remove('fa-eye');
      passwordIcon.classList.add('fa-eye-slash');  // Modifier l'icône pour 'mot de passe visible'
    } else {
      passwordField.type = 'password';
      passwordIcon.classList.remove('fa-eye-slash');
      passwordIcon.classList.add('fa-eye');  // Remettre l'icône pour 'mot de passe caché'
    }
  });


  // Vérifie si le modal doit être affiché après un échec de connexion
  @if(session('open_modal'))
    document.addEventListener('DOMContentLoaded', function () {
      const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
      loginModal.show(); // Ouvre le modal
    });
  @endif

</script>
