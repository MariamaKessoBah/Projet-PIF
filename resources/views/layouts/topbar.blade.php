<!-- Inclure la bibliothèque SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

<!-- Inclusion de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Inclusion de Bootstrap JS (avec Popper inclus dans le bundle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<nav class="main-header navbar navbar-expand fixed-top" style="background-color: #FFF;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" style="color: #000;" data-widget="pushmenu" href="#" role="button" aria-label="Menu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </a>
        </li>
        <li class="nav-item flex-grow-1 text-center text-lg-start">
            <a class="nav-link text-black" href="#" role="button">
                <strong class="h6 d-block d-lg-inline text-wrap">
                    <strong class="d-inline d-lg-none">PIF</strong>
                    <strong class="d-none d-lg-inline">Plateforme du Prix de l’Inclusion Financière</strong>
                </strong>
            </a>
        </li>
        
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" style="color: #000;" data-toggle="dropdown" aria-expanded="false" href="#" aria-label="Menu de compte" id="accountDropdown">
                <div class="d-flex badge-pill align-items-center">
                    <span class="fa fa-user mr-2" aria-hidden="true"></span>
                    <span><b>{{ Auth::user()->role ?? 'Role non défini' }}</b></span>
                    <span class="fa fa-angle-down ml-2" aria-hidden="true"></span>
                </div>
            </a>
            <div class="dropdown-menu" aria-labelledby="accountDropdown" style="left: -2.5em;">
                <a class="dropdown-item" href="#" id="manage_account">
                    <i class="fa fa-cog"></i> Gérer le compte
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="#" onclick="logoutUser();">
                    <i class="fa fa-power-off"></i> Déconnexion
                </a>
            </div>
        </li>
    </ul>
</nav>


<!-- Modal pour gérer le compte -->
<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accountModalLabel">Modifier les informations de connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateAccountForm" action="{{ route('account.update') }}" method="POST" autocomplete="on">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required autocomplete="email" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe (laisser vide si pas de changement)</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ajoutez cette bibliothèque si elle n'est pas déjà incluse -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
$(document).ready(function() {
    $('#accountDropdown').on('click', function() {
        if ($('#accountModal').hasClass('show')) {
            $('#accountModal').modal('hide');
        }
    });

    $('#manage_account').on('click', function() {
        $('.dropdown-menu').removeClass('show');
        $('#accountModal').modal('show');
    });

    $('#accountModal').on('hidden.bs.modal', function() {
        $('.dropdown-menu').removeClass('show');
    });

    $('#updateAccountForm').on('submit', function(event) {
        event.preventDefault();

        const form = $(this);
        const email = $('#email').val();
        const password = $('#password').val();
        const passwordConfirmation = $('#password_confirmation').val();
        const submitButton = form.find('button[type="submit"]');

        // Vérification de la correspondance des mots de passe
        if (password !== passwordConfirmation) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "Les mots de passe ne correspondent pas.",
            });
            return;
        }

        submitButton.prop('disabled', true).text('Chargement...');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: 'Informations mises à jour avec succès !',
                });

                setTimeout(() => location.reload(), 2000);
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON?.message || 'Une erreur est survenue. Veuillez réessayer.';
                
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: errorMessage,
                });

                submitButton.prop('disabled', false).text('Mettre à jour');
            }
        });
    });
});

function logoutUser() {
    document.getElementById('logout-form').submit();
}
</script>
