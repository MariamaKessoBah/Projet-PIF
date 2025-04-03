<meta name="csrf-token" content="{{ csrf_token() }}">

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
            <button type="submit" class="btn btn-success">Créer un compte</button>
          </div>
        </form>
        <hr>
        <div class="text-center">
          <p>Déjà un compte ? <a href="{{ route('login') }}" data-bs-toggle="modal" data-bs-dismiss="modal">Se connecter</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Inscription réussie</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p>Un e-mail de confirmation vous a été envoyé. Veuillez vérifier votre boîte de réception.</p>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Réinitialise les champs et messages d'erreur lorsque la modale est fermée
  $('#registerModal').on('hidden.bs.modal', function () {
      $('#registerForm')[0].reset();
      $('.is-invalid').removeClass('is-invalid');
      $('.invalid-feedback').remove();
  });

  // Place le focus sur le champ "Nom complet" à l'ouverture
  $('#registerModal').on('shown.bs.modal', function () {
      $('#name').trigger('focus');
  });

  // Gestion de l'envoi du formulaire
  $('#registerForm').on('submit', function (e) {
      e.preventDefault(); // Empêche la soumission classique du formulaire

      $('.text-danger, .invalid-feedback').remove(); // Supprime les messages d'erreur existants

      // Vérifie si les mots de passe correspondent
      if ($('#password').val() !== $('#password_confirmation').val()) {
          $('#password_confirmation').after('<div class="text-danger">Les mots de passe ne correspondent pas.</div>');
          return;
      }

      // Envoi du formulaire avec AJAX
      $.ajax({
          url: '{{ route("register") }}', // Utilise la route Laravel
          method: 'POST',
          data: $(this).serialize(),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          success: function (response) {
              // Masque le formulaire et affiche le modal de confirmation
              $('#registerModal').modal('hide');
              $('#confirmationModal').modal('show');
          },
          error: function (xhr) {
              const errors = xhr.responseJSON?.errors;
              if (errors) {
                  for (let field in errors) {
                      const input = $(`#${field}`);
                      input.addClass('is-invalid');
                      if (input.next('.invalid-feedback').length === 0) {
                          input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                      }
                  }
              } else {
                  alert('Erreur interne. Veuillez réessayer plus tard.');
              }
          }
      });
  });
</script>
