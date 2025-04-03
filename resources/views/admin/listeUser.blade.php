@extends('layouts.template')

@section('title', 'Liste des Utilisateurs')

@section('content')
<div class="container">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Ajoutez cette ligne -->

    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white"></div>
    </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Liste des Utilisateurs</h1>
                </div>
            </div>
            <hr class="border-primary">
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-white"></div>
        </div>
        <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>


        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="{{ route('editUser') }}">
                                <i class="fa fa-plus"></i> Ajouter un Nouvel Utilisateur
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="list">
                            <thead>
                                <tr>
                                    {{-- <th class="text-center">#</th> --}}
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($users as $user) --}}
                                    <tr>
                                        <th class="text-center"></th>
                                        <td><b></b></td>
                                        <td><b></b></td>
                                        {{-- <td><b></b></td> --}}
                                        @if(Auth::user()->email === 'fimf@fimf.sn')

                                        <td class="text-center">
                                            <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                {{-- <a class="dropdown-item view_user" href="javascript:void(0)" data-id="{{ $user->id }}">Voir</a> --}}
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="">Modifier</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="">Supprimer</a>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $('#list').dataTable();
            $('.view_user').click(function(){
                uni_modal("<i class='fa fa-id-card'></i> Détails de l'Utilisateur", "view_user.php?id=" + $(this).attr('data-id'));
            });
            $('.delete_user').click(function(){
                delete_user($(this).attr('data-id'));
            });

            // Afficher le toast de succès si le message est présent
            @if (session('success'))
                alert_toast("Données enregistrées avec succès !", 'success');
            @endif
        });

        // Fonction pour afficher le toast
        function alert_toast(message, type) {
            $('#alert_toast .toast-body').html("<i class='fas fa-check-circle'></i> " + message);
            $('#alert_toast').removeClass('bg-danger bg-success').addClass(type === 'success' ? 'bg-success' : 'bg-danger');
            $('#alert_toast').toast({ delay: 3000 });
            $('#alert_toast').toast('show');
        }

        // Configurer AJAX pour inclure le token CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $(document).on('click', '.delete_user', function () {
            var userId = $(this).data('id'); // Récupérer l'ID de l'utilisateur
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                $.ajax({
                    url: '/users/' + userId, // URL de la route DELETE
                    type: 'DELETE', // Méthode HTTP
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                    },
                    success: function (response) {
                        if (response.success) {
                            alert('Utilisateur supprimé avec succès.');
                            location.reload(); // Recharge la page après suppression
                        } else {
                            alert('Erreur : ' + response.message);
                        }
                    },
                    error: function (error) {
                        alert('Une erreur est survenue lors de la suppression.');
                        console.error(error.responseJSON.message || error.statusText);
                    }
                });
    }
});

    </script>
</div>
@endsection