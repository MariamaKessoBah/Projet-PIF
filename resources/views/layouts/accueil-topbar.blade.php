<header id="header" class="header sticky-top">

  <!-- Topbar Section -->
  <div class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      
      <!-- Contact Information -->
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center">
          <a href="mailto:contact@example.com">prixmmess@microfinance-ess.gouv.sn</a>
        </i>
        <i class="bi bi-phone d-flex align-items-center ms-4">
          <span>(+221) 33 889 80 33</span>
        </i>
      </div>
      
      <!-- Social Links -->
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://x.com/MinMicrofinESS?t=YiCvV7A4kzAWznVvBgfGsQ&s=08" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="https://www.facebook.com/MINISTERE.MESS" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/ministeremicrofinanceess?igsh=YzljYTk1ODg3Zg==" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://www.linkedin.com/company/minist-re-de-la-microfinance-et-de-l-economie-sociale-et-solidaire/" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </div><!-- End Top Bar -->

  <!-- Branding and Navigation -->
  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      
      <!-- Logo and Site Name -->
      <a href="{{ route('accueil') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename" style="font-size: 20px">Prix de l'inclusion Financière</h1>
      </a>

      <!-- Navigation Menu -->
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('accueil') }}" class="nav-link {{ request()->routeIs('accueil') ? 'active' : '' }}">Accueil</a></li>
          <li><a href="{{ route('apropos') }}" class="nav-link {{ request()->routeIs('apropos') ? 'active' : '' }}">A propos du prix</a></li>
          <li><a href="{{ route('docCandidature') }}" class="nav-link {{ request()->routeIs('docCandidature') ? 'active' : '' }}">Candidature</a></li>
          <li><a href="{{ route('mediatheque') }}" class="nav-link {{ request()->routeIs('mediatheque') ? 'active' : '' }}">Mediatheque</a></li>
          <li>
            <a href="" data-bs-toggle="modal" data-bs-target="#loginModal">
              <i class="bi bi-person"></i> Connexion
            </a>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </div>

</header>
<!-- End Header -->