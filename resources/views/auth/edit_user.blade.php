@extends('layouts.template')

@section('title', 'Modifier Utilisateur')

@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Modifier Utilisateur</h1>
                </div>
            </div>
            <hr class="border-primary">
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Nom</label>
                                        <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $user->name) }}" required>
                                        <!-- Affichage de l'erreur -->
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email', $user->email) }}" required>
                                        <!-- Affichage de l'erreur -->
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="id_service" class="control-label">Service</label>
                                        <select class="form-control" name="id_service" id="id_service" required>
                                            <option value="">Sélectionner un Service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}" {{ $user->id_service == $service->id ? 'selected' : '' }}>
                                                    {{ $service->nom_service }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Affichage de l'erreur -->
                                        @if ($errors->has('id_service'))
                                            <span class="text-danger">{{ $errors->first('id_service') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="control-label">Mot de Passe</label>
                                        <input type="password" class="form-control form-control-sm" name="password" placeholder="Laissez vide si inchangé">
                                        <!-- Affichage de l'erreur -->
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="control-label">Confirmer Mot de Passe</label>
                                        <input type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="Laissez vide si inchangé">
                                        <!-- Affichage de l'erreur -->
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
