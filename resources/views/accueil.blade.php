
@extends('layouts.accueil_template')

@section('title', 'Accueil')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<main class="main">
  <style>
    .dark-background {
      background-color: #000 !important;
      color: #fff;
    }
  
    .carousel-container {
      background-color: transparent !important;
    }
  
    .carousel-item {
  height: 75vh !important;
}
.carousel-item img {
  width: 100% !important;
  height: 100%;
  object-fit: cover !important;
}


    /* Responsive pour les petits écrans */
    @media (max-width: 576px) {
      .modal-dialog {
        max-width: 90%;
      }
    }


   
  </style>

  
  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">
      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active">
          <img src="assets/img/hero-carousel/hero-carousel-2.png" alt="">
          <div class="carousel-container">
            <h2>Bienvenue à la plateforme dédiée au Prix de l'Inclusion Financière<br></h2>
            <p>Un événement majeur célébrant les initiatives et innovations qui renforcent l'accès aux services financiers pour tous.</p>
            <a href="#registerModal" data-bs-toggle="modal" class="btn-get-started">Participez</a>
          </div>
        </div><!-- End Carousel Item -->

        <div class="carousel-item">
          <img src="assets/img/hero-carousel/hero-carousel-3.png" alt="">
          <div class="carousel-container">
            <h2>Participez à une transformation durable</h2>
            <p>Rejoignez-nous pour honorer les acteurs qui œuvrent à réduire les inégalités grâce à des solutions financières inclusives.</p>
            <a href="#registerModal" data-bs-toggle="modal" class="btn-get-started">PARTICIPEZ</a>
          </div>
        </div><!-- End Carousel Item -->
        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>
        
      <!-- Barre déroulante d'informations -->
      <div class="info-bar">
        <div class="scrolling-text">
          🎉 Nouveaux sur l'inclusion financière! | 🌟 La plateforme du prix du ministère de la microfinance sera opérationnelle bientôt ! | 📞 Contactez-nous au +221 77 123 45 67 pour plus d'informations !
        </div>
      </div>

      </div>


    </section><!-- /Hero Section -->

    <!-- Sidebar -->
<!-- Login Modal -->
<div class="modal fade {{ session('open_modal') ? 'show' : '' }}" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  
  <style>
    /* Responsive pour les petits écrans */
    @media (max-width: 576px) {
      .modal-dialog {
        max-width: 90%;
      }
    }


    /* Style pour les cubes animés */
    .loading-cubes {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 5px;
    }

    .loading-cube {
      width: 20px;
      height: 20px;
      background-color: #007bff;
      border-radius: 5px;
      animation: bounce 0.6s infinite alternate;
    }

    .loading-cube:nth-child(2) {
      animation-delay: 0.2s;
    }

    .loading-cube:nth-child(3) {
      animation-delay: 0.4s;
    }

    /* Animation pour les cubes */
    @keyframes bounce {
      0% {
        transform: translateY(0);
      }
      100% {
        transform: translateY(-15px);
      }
    }
    
    /* Masquer les cubes au départ */
    .loading-cubes {
      display: none;
    }
  </style>
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
        <form id="loginForm" action="{{ route('handleLogin') }}" method="POST">
          @csrf <!-- Protection contre les attaques CSRF -->
          @if(session('error_msg'))
            <div class="alert alert-danger">
              {{ session('error_msg') }}
            </div>
          @endif
          <!-- Afficher le message d'erreur si disponible -->
          {{-- @include('components.error-message') --}}

          <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-control form-control-sm" id="logEmail" placeholder="Veuillez saisir votre email" required aria-label="Adresse email">
          </div>

          <div class="mb-3 position-relative">
            <label for="password" class="form-label">Mot de passe</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control form-control-sm" id="logPassword" placeholder="Veuillez saisir votre mot de passe" required aria-label="Mot de passe">
              <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1" style="border-left: none;" aria-pressed="false">
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
              </button>
            </div>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success" id="logSubmitBtn">Se connecter</button>
            <!-- Cube de chargement -->
            <div id="loadingCubes" class="loading-cubes">
              <div class="loading-cube"></div>
              <div class="loading-cube"></div>
              <div class="loading-cube"></div>
            </div>
          </div>
        </form>

        <hr>

        <div class="text-center">
          <p>Pas encore de compte ? <a href="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal">Créer un compte</a></p>
        </div>
      </div>
    </div>

    <script>
      // Cacher ou afficher le mot de passe et changer l'icône
      document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('logPassword');
        const passwordIcon = document.getElementById('togglePasswordIcon');
        const toggleButton = document.getElementById('togglePassword');
    
        // Toggle le type du champ de mot de passe
        if (passwordField.type === 'password') {
          passwordField.type = 'text';
          passwordIcon.classList.remove('fa-eye');
          passwordIcon.classList.add('fa-eye-slash'); // Modifier l'icône pour 'mot de passe visible'
          toggleButton.setAttribute('aria-pressed', 'true'); // Indiquer que le mot de passe est visible
        } else {
          passwordField.type = 'password'; // Correction ici: 'password' au lieu de 'logPassword'
          passwordIcon.classList.remove('fa-eye-slash');
          passwordIcon.classList.add('fa-eye'); // Remettre l'icône pour 'mot de passe caché'
          toggleButton.setAttribute('aria-pressed', 'false'); // Indiquer que le mot de passe est caché
        }
      });
    
      // Afficher le modal si la session est définie
      @if(session('open_modal'))
        document.addEventListener('DOMContentLoaded', function () {
          const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
          loginModal.show(); // Ouvre le modal
        });
      @endif
    
      // Afficher ou masquer les cubes animés lors de la soumission du formulaire
      document.getElementById('loginForm').addEventListener('submit', function(event) {
        const submitButton = document.getElementById('logSubmitBtn');
        const loadingCubes = document.getElementById('loadingCubes');
    
        // Désactiver le bouton de soumission
        submitButton.disabled = true;
        // Afficher les cubes
        loadingCubes.style.display = 'flex';
      });
      
      
    </script>
    <script>
      // Lors de la fermeture du modal de connexion, ne pas supprimer la couche sombre immédiatement
      $('#loginModal').on('hidden.bs.modal', function () {
        // Vérifie si le modal d'inscription est ouvert
        if (!$('#registerModal').hasClass('show')) {
          // Si le modal d'inscription est fermé, on enlève la couche sombre
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
        }
      });
    
      // Lors de l'ouverture du modal d'inscription, on ferme le modal de connexion
      $('#loginModal').on('hide.bs.modal', function () {
        $('#registerModal').modal('show');  // Ouvre le modal d'inscription
      });
    </script>
  </div>

  
</div>
    @include('auth.register')

    
   <!-- Mot du Ministre Section -->
<section id="mot-du-directeur" class="mot-du-directeur section">
  <div class="container" data-aos="fade-up">
    <div class="row align-items-center">
      <div class="col-lg-3 text-center mb-3 mb-lg-0">
        <img src="assets/img/ministre.jpeg" alt="Photo du Ministre" class="img-fluid rounded-4 mb-4" style="width: 350px; height: 350px;">
      </div>
      
      <!-- Texte du Mot du Ministre -->
      <div class="col-lg-9">
        <div class="directeur-content">
          <h2 class="section-title text-uppercase">Mot du Ministre</h2>
          <blockquote class="directeur-quote">
            <p id="short-text" style="text-align: justify; ">
              "<strong>Chers acteurs de l'inclusion financière,</strong><br><br> 
              C'est avec une grande fierté que je lance le Prix du Ministre de la Microfinance et de l'Économie sociale et solidaire pour la Promotion de l'Inclusion financière.  
              Ce prix s'inscrit pleinement dans les objectifs de notre <strong>Agenda national de transformation Sénégal 2050.</strong>  
              En effet, l'inclusion financière est un pilier essentiel de ce plan ambitieux.  
              Elle est le moteur de la croissance économique, de la réduction de la pauvreté et de l'autonomisation des populations...
            </p>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#directeurModal">
              Voir plus
            </button>
          </blockquote>
          <p class="directeur-signature">
            <strong>- Dr Alioune Badara Dione</strong>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Bootstrap -->
<div class="modal fade" id="directeurModal" tabindex="-1" aria-labelledby="directeurModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="directeurModalLabel">Mot du Ministre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
          "<strong>Chers acteurs de l'inclusion financière,</strong><br><br>
          C'est avec une grande fierté que je lance le <strong>Prix du Ministre de la Microfinance et de l'Économie sociale et solidaire pour la Promotion de l'Inclusion financière.</strong>  
          Ce prix s'inscrit pleinement dans les objectifs de notre <strong>Agenda national de transformation Sénégal 2050.</strong><br><br>

          En effet, l'inclusion financière est un pilier essentiel de ce plan ambitieux. Elle est le moteur de la croissance économique, de la réduction de la pauvreté et de l'autonomisation des populations, notamment les femmes et les jeunes.  
          Ce prix vise à récompenser les initiatives les plus innovantes et les plus impactantes qui contribuent à rendre les services financiers accessibles à tous les Sénégalais.<br><br>  

          Nous recherchons des projets qui mettent en œuvre des solutions innovantes pour l'accès au crédit dans les zones rurales, qui développent des produits financiers adaptés aux besoins spécifiques des femmes, ou qui utilisent les technologies numériques pour faciliter les transactions financières.<br><br>  

          En récompensant ces initiatives, nous souhaitons non seulement mettre en lumière les acteurs qui œuvrent pour une inclusion financière plus inclusive, mais également encourager l'émergence de nouvelles solutions et de nouveaux partenariats.<br><br>  

          Je suis convaincu que ce prix contribuera à renforcer l'écosystème de la microfinance au Sénégal et à accélérer la réalisation des objectifs de notre Agenda 2050.<br><br>
          Je vous invite tous à participer à ce concours et à nous faire part de vos projets les plus prometteurs.<br><br>  

          Je remercie les membres du comité de sélection, composé d'experts des différents sectoriels, qui auront la lourde tâche d'évaluer les candidatures et de désigner les lauréats.<br><br>  

        </p>
        <p class="highlighted-text">
          « Ensemble, construisons une <strong>Économie sociale et solidaire</strong> et une <strong>Microfinance intégrées, inclusives et performantes</strong> pour un <strong>développement territorial durable</strong> dans un <strong>Sénégal souverain, juste et prospère</strong>. »
        </p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>


     

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>FAQ </h2>
        {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Pourquoi le prix ?</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Le Prix de l'Inclusion Financière est une initiative visant à récompenser les institutions, entreprises, ou individus qui contribuent de manière significative à l'amélioration de l'accès aux services financiers pour les populations vulnérables ou marginalisées.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Qui peut participer ?</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Le prix est ouvert à :

              Les institutions de microfinance (IMF) enregistrées ;
              Les entreprises du secteur privé ou public engagées dans des projets inclusifs ;
              Les associations ou ONG œuvrant dans le domaine de l'inclusion financière.            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Quels sont les critères d’éligibilité ?</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Pour être éligible, les candidats doivent :

              Soumettre un dossier complet dans les délais impartis ;
              Présenter des initiatives innovantes ou des résultats concrets en matière d’inclusion financière ;
              Être en conformité avec la réglementation en vigueur (NINEA, registre de commerce, agrément pour les SFD, etc.).            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="400">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Quels sont les documents nécessaires pour soumettre une candidature ?
            </h4>
          </div>
          <div class="col-lg-7">
            <p>
              Les documents requis incluent :

              Une fiche signalétique complète (personne morale, entreprise ou IMF) ;
              Une copie du NINEA ou du registre de commerce (ou agrément pour les SFD) ;
              Un quitus fiscal (facultatif) ;
              Une attestation de service fait (facultative).            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Comment puis-je soumettre ma candidature ?
            </h4>
          </div>
          <div class="col-lg-7">
            <p>
              Les candidatures doivent être soumises via la plateforme officielle. Cliquez sur "Candidature" dans le menu principal et remplissez le formulaire en ligne. Assurez-vous de joindre tous les documents requis.            </p>
          </div>
        </div><!-- End F.A.Q Item-->
        <div class="row faq-item" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Y a-t-il des frais de participation ?

            </h4>
          </div>
          <div class="col-lg-7">
            <p>
              Non, la participation au Prix de l'Inclusion Financière est entièrement gratuite.

            </div>
        </div><!-- End F.A.Q Item-->
        <div class="row faq-item" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Quels sont les délais pour soumettre une candidature ? </h4>
          </div>
          <div class="col-lg-7">
            <p>
              Les lauréats bénéficieront de :

              Une reconnaissance officielle et une visibilité accrue ;
              Une dotation financière pour soutenir leurs initiatives ;
              Une opportunité de réseautage avec des partenaires et investisseurs potentiels.
            </div>
        </div><!-- End F.A.Q Item-->
        <div class="row faq-item" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Quels sont les délais pour soumettre une candidature ? </h4>
          </div>
          <div class="col-lg-7">
            <p>
              Les candidatures doivent être déposées avant la date limite mentionnée sur le site. Toute soumission après cette date ne sera pas prise en compte.
          </div>
        </div><!-- End F.A.Q Item-->
      </div><!-- End F.A.Q Item-->

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <p>Diamniadio, sphère ministérielle
                Ousmane Tanor Dieng
                
                Bâtiment B, Dakar</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Appelez-Nous</h3>
              <p>(+221) 33 889 80 33</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p>prixmmess@microfinance-ess.gouv.sn</p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
          <div class="row gy-4">

            <div class="col-md-6">
              <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
            </div>

            <div class="col-md-6 ">
              <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
            </div>

            <div class="col-md-12">
              <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
            </div>

            <div class="col-md-12">
              <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
            </div>

            <div class="col-md-12 text-center">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>

              <button type="submit">Send Message</button>
            </div>

          </div>
        </form><!-- End Contact Form -->

      </div>

    </section><!-- /Contact Section -->

  </main>


  @endsection
<style>
  .directeur-quote {
    font-style: italic;
    color: #555;
    line-height: 1.6;
}

.directeur-signature {
    text-align: right;
    font-weight: bold;
    color: #333;
}

.modal-body {
    text-align: justify;
    line-height: 1.6;
}

</style>
