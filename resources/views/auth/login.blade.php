<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-image: url('{{ asset('assets/img/hero-carousel/hero-carousel-1.png') }}'); /* mets le bon chemin ici */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  
    .container-login {
  width: 450px;
  padding: 25px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  background-color: rgba(255, 255, 255, 0.95);
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
<body class="bg-light">

  <div class="container-login bg-white">
    <div class="modal-header position-relative">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
      <div class="position-absolute w-100 text-center">
        <h5 class="modal-title" id="loginModalLabel"><strong>CONNEXION</strong></h5>
      </div>
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <form id="loginForm" action="{{ route('handleLogin') }}" method="POST">
      @csrf

      @if(session('error_msg'))
        <div class="alert alert-danger">
          {{ session('error_msg') }}
        </div>
      @endif

      <div class="mb-3">
        <label for="logEmail" class="form-label">Adresse email</label>
        <input type="email" name="email" class="form-control" id="logEmail" required placeholder="Entrez votre email">
      </div>

      <div class="mb-3">
        <label for="logPassword" class="form-label">Mot de passe</label>
        <div class="input-group">
          <input type="password" name="password" class="form-control" id="logPassword" required placeholder="Entrez votre mot de passe">
          <button type="button" class="btn btn-outline-secondary" id="togglePassword">
            <i class="fas fa-eye" id="togglePasswordIcon"></i>
          </button>
        </div>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-success" id="logSubmitBtn">Se connecter</button>
      </div>

      <div id="loadingCubes" class="loading-cubes">
        <div class="loading-cube"></div>
        <div class="loading-cube"></div>
        <div class="loading-cube"></div>
      </div>
    </form>

    <hr>
  
  </div>

  <script>
    // Toggle visibilité du mot de passe
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordField = document.getElementById('logPassword');
      const icon = document.getElementById('togglePasswordIcon');

      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        passwordField.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    });

    // Affiche les cubes au clic sur "Se connecter"
    document.getElementById('loginForm').addEventListener('submit', function () {
      const submitBtn = document.getElementById('logSubmitBtn');
      const loadingCubes = document.getElementById('loadingCubes');
      submitBtn.disabled = true;
      loadingCubes.style.display = 'flex';
    });
  </script>
</body>
</html>
