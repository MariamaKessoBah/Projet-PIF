<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Modal d'inscription -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
        <div class="position-absolute w-100 text-center">
          <h5 class="modal-title" id="registerModalLabel"><strong>INSCRIPTION</strong></h5>
        </div>
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="registerForm" action="{{ route('register') }}">
          @csrf
          <!-- Afficher le message d'erreur -->
        
          <div class="mb-3">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom complet" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Choisissez un mot de passe" required>
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success" id="submitBtn">Créer un compte</button>
            <div id="loadingSpinner" class="spinner-border text-primary" style="display: none;" role="status">
              <span class="visually-hidden">Chargement...</span>
            </div>
          </div>
        </form>
        <hr>
        <div class="text-center">
          <p>Déjà un compte ? <a href="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">Se connecter</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Lien vers Animate.css pour les animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Modal de confirmation amélioré -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-4 animate__animated animate__fadeInDown">
      
      <!-- Header -->
      <div class="modal-header bg-gradient text-white">
        <h5 class="modal-title fw-bold" id="confirmationModalLabel">🎉 Inscription réussie !</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body text-center p-4">
        <div class="icon-container mb-3">
          <i class="fas fa-check-circle fa-4x text-success glow"></i>
        </div>
        <p class="fs-5 fw-semibold">Un e-mail de confirmation vous a été envoyé.</p>
        <p class="text-muted small">Veuillez vérifier votre boîte de réception et votre dossier spam.</p>
        
        <div class="alert alert-info small rounded-3 mt-3">
          <strong>📩 Vous ne trouvez pas l'email ?</strong><br>
          Essayez de <a href="#" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#registerModal">renvoyer la confirmation</a>.
        </div>        
      </div>
      
      <!-- Footer -->
      <div class="modal-footer d-flex justify-content-center border-0 pb-4">
        <button type="button" class="btn btn-success px-4 fw-bold shadow-sm" data-bs-dismiss="modal">OK</button>
      </div>

    </div>
  </div>
</div>

<!-- Inclusion de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Votre script personnalisé -->
<script>
$('#registerForm').on('submit', function (e) {
    e.preventDefault(); // Empêche la soumission classique du formulaire

    $('#submitBtn').hide();
    $('#loadingSpinner').show();
    $('.text-danger, .invalid-feedback').remove();
    $('.form-control').removeClass('is-invalid');

    if ($('#password').val() !== $('#password_confirmation').val()) {
        $('#password_confirmation').after('<div class="text-danger">Les mots de passe ne correspondent pas.</div>');
        $('#submitBtn').show();
        $('#loadingSpinner').hide();
        return;
    }

    $.ajax({
        url: '{{ route("register") }}',
        method: 'POST',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            if (response.status == "success") {
                $('#registerModal').modal('hide');
                $('#confirmationModal').modal('show');
                $('#confirmationMessage').text(response.message);
                $('#registerForm')[0].reset();
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                for (let field in errors) {
                    let input = $([name="${field}"]);
                    input.addClass('is-invalid');
                    input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                  }
            } else {
                alert(xhr.responseJSON.message || 'Erreur interne, veuillez réessayer.');
            }
            $('#submitBtn').show();
            $('#loadingSpinner').hide();
        }
    });
});
</script>
<script>
  // Lors de la fermeture du modal d'inscription, on vérifie si le modal de connexion est aussi fermé
  $('#registerModal').on('hidden.bs.modal', function () {
    if (!$('#loginModal').hasClass('show')) {
      // Si le modal de connexion est également fermé, on supprime la couche sombre
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
    }
  });

  // Lors de l'ouverture du modal d'inscription, on ferme le modal de connexion sans supprimer la couche sombre
  $('#registerModal').on('show.bs.modal', function () {
    $('#loginModal').modal('hide'); // Ferme le modal de connexion
  });
</script>
<!-- Styles CSS personnalisés -->
<style>
  .bg-gradient {
    background: linear-gradient(135deg, #28a745, #218838);
  }

  .icon-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .glow {
    text-shadow: 0 0 10px rgba(40, 167, 69, 0.7);
  }

  .btn-success:hover {
    background-color: #1e7e34 !important;
    transform: scale(1.05);
    transition: 0.3s;
  }
</style>