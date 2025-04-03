@extends('layouts.accueil_template')

@section('title', 'DocCandidature')

@section('content')

<main class="main">

  <!-- Login and Register Modals -->
  @include('auth.login')
  @include('auth.register')

  <hr>

  <!-- Section: À Propos -->
  <section id="apropos" class="apropos section">
    <div class="container" data-aos="fade-up">
      
      <!-- Titre -->
      <div class="section-title text-center" data-aos="fade-up">
        <h2 class="fw-bold text-primary">📸 Images & 🎥 Vidéos</h2>
        <p class="text-muted">Découvrez nos meilleurs moments en images et en vidéos.</p>
      </div>

      <!-- Vidéo de Présentation -->
      <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
          <div class="ratio ratio-16x9 video-container shadow-lg rounded-4 overflow-hidden">
            <iframe src="https://www.youtube.com/embed/XVpmJDQeiW4" title="Vidéo de présentation" allowfullscreen></iframe>
          </div>
        </div>
      </div>

      <!-- Carrousel d'images -->
      <div class="carousel-container mb-5">
        <div id="carouselExampleCaptions" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="assets/img/hero-carousel/1.jpg" class="d-block w-100 object-fit-cover rounded-3" alt="Image 1" style="height: 400px;">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5 class="text-white">Première Image</h5>
                <p class="text-light">Un instant capturé avec soin.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/img/hero-carousel/2.jpg" class="d-block w-100 object-fit-cover rounded-3" alt="Image 2" style="height: 400px;">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5 class="text-white">Deuxième Image</h5>
                <p class="text-light">Un moment inoubliable.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/img/hero-carousel/3.jpg" class="d-block w-100 object-fit-cover rounded-3" alt="Image 3" style="height: 400px;">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                <h5 class="text-white">Troisième Image</h5>
                <p class="text-light">Une image qui parle d'elle-même.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon rounded-circle bg-dark p-3" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon rounded-circle bg-dark p-3" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
          </button>
        </div>
      </div>

    </div>
  </section>

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section bg-light pt-5 pb-5">
    <div class="container section-title text-center mb-4" data-aos="fade-up">
      <h2 class="fw-bold text-primary">Nos Réalisations</h2>
      <p class="text-muted">Découvrez nos projets : applications mobiles, sites web et bien plus encore.</p>
    </div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <!-- Portfolio Filters -->
            <div class="portfolio-filters mb-5 text-center">
              <button class="btn btn-outline-primary m-2" data-filter="*" type="button">Tout</button>
              <button class="btn btn-outline-primary m-2" data-filter=".filter-app" type="button">Applications</button>
              <button class="btn btn-outline-primary m-2" data-filter=".filter-web" type="button">Sites Web</button>
              <button class="btn btn-outline-primary m-2" data-filter=".filter-product" type="button">Produits</button>
            </div>

            <!-- Portfolio Items -->
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                <div class="portfolio-card shadow-lg rounded-4 overflow-hidden">
                  <img src="assets/img/hero-carousel/1.jpg" class="img-fluid" alt="App 1">
                  <div class="portfolio-info p-4 bg-dark bg-opacity-75">
                    <h5 class="text-white">Application Mobile 1</h5>
                    <p class="text-light">Une application mobile innovante pour gérer vos activités.</p>
                    <a href="assets/img/portfolio/portfolio-1.jpg" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="portfolio-details.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-web">
                <div class="portfolio-card shadow-lg rounded-4 overflow-hidden">
                  <img src="assets/img/hero-carousel/2.jpg" class="img-fluid" alt="Web 1">
                  <div class="portfolio-info p-4 bg-dark bg-opacity-75">
                    <h5 class="text-white">Site Web 1</h5>
                    <p class="text-light">Un site web responsive pour une meilleure expérience utilisateur.</p>
                    <a href="assets/img/portfolio/portfolio-2.jpg" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="portfolio-details.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                <div class="portfolio-card shadow-lg rounded-4 overflow-hidden">
                  <img src="assets/img/hero-carousel/hero-carousel3.jpg" class="img-fluid" alt="Product 1">
                  <div class="portfolio-info p-4 bg-dark bg-opacity-75">
                    <h5 class="text-white">Produit 1</h5>
                    <p class="text-light">Un produit innovant pour simplifier votre quotidien.</p>
                    <a href="assets/img/portfolio/portfolio-3.jpg" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="portfolio-details.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div>

            </div> <!-- End Portfolio Container -->
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Portfolio Section -->

</main>

@endsection
