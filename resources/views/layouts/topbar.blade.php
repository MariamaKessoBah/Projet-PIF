<nav class="main-header navbar navbar-expand fixed-top" style="background-color: #FFF;">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" style="color: #000;" data-widget="pushmenu" href="#" role="button" aria-label="Menu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a class="nav-link text-black" href="{{ route('dashboard') }}" role="button">
                <large><b>Plateforme du Prix de l’Inclusion Financière</b></large>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" style="color: #000;" data-toggle="dropdown" aria-expanded="false" href="javascript:void(0)" aria-label="Menu de compte" id="accountDropdown">
                <div class="d-flex badge-pill">
                    <span class="fa fa-user mr-2" aria-hidden="true"></span>
                    <span><b>{{ Auth::user()->role ?? 'Role non défini' }}</b></span>
                    <span class="fa fa-angle-down ml-2" aria-hidden="true"></span>
                </div>
            </a>
            <div class="dropdown-menu" aria-labelledby="accountDropdown" style="left: -2.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_account">
                    <i class="fa fa-cog"></i> Gérer le compte
                </a>
                <form id="logout-form" action="" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="javascript:void(0)" onclick="logoutUser();">
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
                <form id="updateAccountForm" action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe (laisser vide si pas de changement)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const dropdownMenu = $('.dropdown-menu');

        $('#accountDropdown').on('click', function() {
            // Fermer le dropdown si le modal est ouvert
            if ($('#accountModal').hasClass('show')) {
                $('#accountModal').modal('hide');
            }
        });

        $('#manage_account').on('click', function() {
            // Fermer le dropdown lorsque le modal est ouvert
            dropdownMenu.removeClass('show');
            $('#accountModal').modal('show'); // Afficher le modal
        });

        // Lors de la fermeture du modal, réinitialiser l'état du dropdown
        $('#accountModal').on('hidden.bs.modal', function() {
            dropdownMenu.removeClass('show');
        });

        $('#updateAccountForm').on('submit', function(event) {
            event.preventDefault(); // Empêche le comportement par défaut du formulaire
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).text('Chargement...'); // Désactiver le bouton et changer le texte

            // Envoie le formulaire via AJAX
            $.ajax({
                url: this.action,
                method: 'POST',
                data: $(this).serialize(),
                success: function() {
                    location.reload(); // Recharger la page
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON?.message || 'Une erreur est survenue. Veuillez réessayer.';
                    Toastify({
                        text: errorMessage,
                        duration: 3000, // Durée de l'affichage de l'erreur
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#FF5733", // Couleur d'erreur
                    }).showToast();
                    submitButton.prop('disabled', false).text('Mettre à jour'); // Réactiver le bouton
                }
            });
        });

       // Fonction de déconnexion avec SweetAlert
        window.logoutUser = function() {
            Swal.fire({
                title: '<span class="font-weight-bold">Déconnexion</span>',
                text: 'Vous allez être déconnecté dans quelques instants...',
                imageUrl: '{{ asset('images/logo.png') }}', // Lien vers une image pour l'alerte
                imageWidth: 100,
                imageHeight: 100,
                timer: 5000, // Durée du minuteur en millisecondes
                timerProgressBar: true, // Affiche la barre de progression du minuteur
                showCancelButton: true, // Affiche le bouton Annuler
                confirmButtonText: 'OK', // Texte du bouton OK
                cancelButtonText: 'Annuler', // Texte du bouton Annuler
                didOpen: () => {
                    Swal.showLoading(); // Montre une animation de chargement lorsque l'alerte est ouverte
                },
                willClose: () => {
                    Swal.stopTimer(); // Arrête le minuteur lorsque l'alerte est fermée
                }
            }).then((result) => {
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                    // Si l'utilisateur confirme ou si le minuteur expire
                    document.getElementById('logout-form').submit(); // Soumet le formulaire de déconnexion
                } else {
                    // Afficher un message indiquant que la déconnexion a été annulée après la fermeture de l'alerte
                    setTimeout(() => {
                        Toastify({
                            text: "Déconnexion annulée.", // Message affiché
                            duration: 3000, // Durée d'affichage du message
                            gravity: "top", // Position verticale du message
                            position: 'right', // Position horizontale du message
                            backgroundColor: "linear-gradient(to right, #ff9800, #ffc107)", // Couleur d'avertissement
                        }).showToast(); // Affiche le message
                    }, 100); // Délai avant d'afficher le message
                }
            });
        };


        // Afficher le toast au chargement si un message de session est défini
        @if(session('toast'))
            Toastify({
                text: "{{ session('toast.message') }}",
                duration: 3000,
                gravity: "top",
                position: 'right',
                backgroundColor: "{{ session('toast.type') === 'success' ? 'linear-gradient(to right, #00b09b, #96c93d)' : '#FF5733' }}",
            }).showToast();
        @endif
    });
</script>
