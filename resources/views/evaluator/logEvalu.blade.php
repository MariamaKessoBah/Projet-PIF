<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <title>Connexion</title>

  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      border: none;
      border-radius: 0.5rem;
    }
    .card-header {
      background-color: #fff;
      border-bottom: 1px solid rgba(0, 0, 0, 0.125);
      padding: 1.5rem 1rem;
      text-align: center;
      position: relative;
    }
    .form-control:focus {
      box-shadow: 0 0 10px rgba(63, 81, 181, 0.7);
      border-color: #3f51b5;
    }
    .btn-success {
      background-color: #28a745;
    }
    .btn-success:hover {
      background-color: #218838;
      box-shadow: 0 0 15px rgba(40, 167, 69, 0.7);
    }
    .loading-cubes {
      display: none;
      justify-content: center;
      align-items: center;
      gap: 5px;
      margin-top: 10px;
    }
    .loading-cube {
      width: 20px;
      height: 20px;
      background-color: #007bff;
      border-radius: 5px;
      animation: bounce 0.6s infinite alternate;
    }
    .loading-cube:nth-child(2) { animation-delay: 0.2s; }
    .loading-cube:nth-child(3) { animation-delay: 0.4s; }
    @keyframes bounce {
      0% { transform: translateY(0); }
      100% { transform: translateY(-15px); }
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card">

          <!-- Header -->
          <div class="card-header position-relative">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
            <div class="position-absolute w-100 text-center">
              <h5 class="modal-title"><strong>CONNEXION</strong></h5>
            </div>
          </div>

          <!-- Body -->
          <div class="card-body p-4">
            <p class="text-center mb-4">Veuillez saisir vos identifiants pour vous connecter.</p>

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if(session('error_msg'))
              <div class="alert alert-danger">
                {{ session('error_msg') }}
              </div>
            @endif

            <form id="loginForm" action="{{ route('handleLogin') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="logEmail" class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control form-control-sm" id="logEmail" placeholder="Veuillez saisir votre email" required aria-label="Adresse email">
              </div>

              <div class="mb-3 position-relative">
                <label for="logPassword" class="form-label">Mot de passe</label>
                <div class="input-group">
                  <input type="password" name="password" class="form-control form-control-sm" id="logPassword" placeholder="Veuillez saisir votre mot de passe" required aria-label="Mot de passe">
                  <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1" style="border-left: none;" aria-pressed="false">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                  </button>
                </div>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success" id="logSubmitBtn">Se connecter</button>

                <!-- Loading cubes -->
                <div id="loadingCubes" class="loading-cubes">
                  <div class="loading-cube"></div>
                  <div class="loading-cube"></div>
                  <div class="loading-cube"></div>
                </div>
              </div>
            </form>

            <hr>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordField = document.getElementById('logPassword');
      const passwordIcon = document.getElementById('togglePasswordIcon');
      const toggleButton = document.getElementById('togglePassword');

      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
        toggleButton.setAttribute('aria-pressed', 'true');
      } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
        toggleButton.setAttribute('aria-pressed', 'false');
      }
    });

    document.getElementById('loginForm').addEventListener('submit', function(event) {
      const submitButton = document.getElementById('logSubmitBtn');
      const loadingCubes = document.getElementById('loadingCubes');

      submitButton.disabled = true;
      loadingCubes.style.display = 'flex';
    });
  </script>
</body>
</html>
