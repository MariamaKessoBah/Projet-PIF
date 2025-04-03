@extends('layouts.template')

@section('title', 'Enregistrer Evaluateur')

@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Enregistrer un évaluateur</h1>
                </div>
            </div>
            <hr class="border-primary">
        </div>
    </div>

    <!-- Toast pour messages flash -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
        <div id="toastMessage" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') ?? session('error') }}
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('evaluateurs.store') }}" method="POST" id="register_user">
                            @csrf
                            
                            <div class="row">
                                <!-- Colonne gauche -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nom complet</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel">Téléphone</label>
                                        <input type="tel" class="form-control" name="tel" required>
                                    </div>
                                </div>

                                <!-- Colonne droite -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="structure">Nom Structure</label>
                                        <input type="text" name="structure" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fonction">Fonction</label>
                                        <input type="text" name="fonction" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmer Mot de passe</label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let toastMessage = document.getElementById('toastMessage');
        
        @if(session('success') || session('error'))
            let toast = new bootstrap.Toast(toastMessage, { delay: 5000 }); // 5 secondes avant disparition
            toast.show();
        @endif
    });
</script>


<style>
    .form-control {
        transition: box-shadow 0.3s ease-in-out;
    }
    .form-control:focus {
        box-shadow: 0 0 10px rgba(63, 81, 181, 0.7);
        border-color: #3f51b5;
    }
    .form-control.border-danger {
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.7);
        border-color: red;
    }
    button.btn-primary:hover {
        background-color: #3f51b5;
        box-shadow: 0 0 15px rgba(63, 81, 181, 0.7);
    }
</style>
@endsection
