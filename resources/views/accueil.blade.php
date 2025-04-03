
@extends('layouts.accueil_template')

@section('title', 'Accueil')

@section('content')

  <main class="main">

  <!-- Hero Section -->
<section id="hero" class="hero section dark-background">
  <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

    <div class="carousel-item active">
      <img src="assets/img/hero-carousel/hero-carousel-1.png" alt="">
      <div class="carousel-container">
        <h2 style="font-size: 40px;">Bienvenue à la plateforme dédiée au Prix de l'Inclusion Financière<br></h2>
        <p>Un événement majeur célébrant les initiatives et innovations qui renforcent l'accès aux services financiers pour tous.</p>
        <a href="#loginModal" data-bs-toggle="modal" class="btn-get-started">Participez</a>
      </div>
    </div><!-- End Carousel Item -->

    <div class="carousel-item">
      <img src="assets/img/hero-carousel/hero-carousel-2.png" alt="">
      <div class="carousel-container">
        <h2>Participez à une transformation durable</h2>
        <p>Rejoignez-nous pour honorer les acteurs qui œuvrent à réduire les inégalités grâce à des solutions financières inclusives.</p>
        <a href="#loginModal" data-bs-toggle="modal" class="btn-get-started">PARTICIPEZ</a>
      </div>
    </div><!-- End Carousel Item -->

    <div class="carousel-item">
      <img src="assets/img/hero-carousel/hero-carousel-3.png" alt="">
      <div class="carousel-container">
        <h2>Innovons ensemble pour un futur inclusif</h2>
        <p>Découvrez des projets inspirants qui façonnent l'avenir de l'inclusion financière en mettant l'humain au cœur des initiatives.</p>
        <a href="#loginModal" data-bs-toggle="modal" class="btn-get-started">Participez</a>
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
@include('auth.login')
@include('auth.register')

  
    <!-- About Section -->
    {{-- <section id="about" class="about section"> --}}

    <!-- Mot du Directeur Section -->
<section id="mot-du-directeur" class="mot-du-directeur section">
  <div class="container" data-aos="fade-up">
    <div class="row align-items-center">
      <!-- Photo du Directeur -->
      {{-- <div class="col-lg-4 text-center mb-3 mb-lg-0">
          <img src="assets/img/ministre.jpeg" alt="Photo du Directeur" class="img-fluid rounded-4 mb-4">
      </div> --}}

      <div class="col-lg-3 text-center mb-3 mb-lg-0">
          <img src="assets/img/ministre.jpeg" alt="Photo du Directeur" class="img-fluid rounded-4 mb-4" style="width: 350px; height: 350px;">
      </div>
    
      <!-- Texte du Mot du Directeur -->
      <div class="col-lg-9">
        <div class="directeur-content">
          <h2 class="section-title text-uppercase">Mot du Ministre</h2>
          <blockquote class="directeur-quote">
            <p>
              "Le Prix de l'Inclusion Financière est une célébration de l'innovation, de l'engagement et de la solidarité. 
              Ensemble, nous avons le pouvoir de transformer des vies en rendant les services financiers accessibles à tous. 
              Continuons de bâtir un avenir inclusif et durable pour notre communauté."
            </p>
          </blockquote>
          <p class="directeur-signature">
            <strong>- Dr Alioune Badara Dione</strong>  
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

     

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



      </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        {{-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> --}}
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
              <p>ctcom@microfinance-ess.gouv.sn</p>
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

