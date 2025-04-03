
@extends('layouts.accueil_template')

@section('title', 'DocCandidature')

@section('content')

  <main class="main">
@include('auth.login')
@include('auth.register')

    <hr>
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Composition du dossier de candidature</h2>
          <p>Comment participer ?</p>
        </div><!-- End Section Title -->
  

        <div class="accordion" id="accordionPanelsStayOpenExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                <strong>Etape 1 : </strong> Création de Compte
              </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
              <div class="accordion-body">
                <strong>Pour soumettre votre candidature, vous devez créer un compte utilisateur. Un message de confirmation, contenant vos identifiants de connexion, vous sera envoyé par email.</strong> 
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                <strong>Etape 2 : </strong> Identification du candidat
              </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
              <div class="accordion-body">
                <strong>Pour soumettre votre candidature, vous devez renseigner une fiche signalétique comprenant les informations suivantes:</strong> 
                
                <ul>
                  <li></i> <span>Statut</span></li>
                  <li></i> <span>Dénomination sociale</span></li>
                  <li></i> <span>Date de création</span></li>
                  <li></i> <span>Siège social</span></li>
                  <li></i> <span>Téléphone, Adresse mail </span></li>
                  <li></i> <span>Nombre de membres</span></li>
                  <li> <span>Point contact (nom, prénoms, coordonnées et fonction)</span></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                <strong>Etape 3 : </strong> Dossier de candidature
              </button>
            </h2>
            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
              <div class="accordion-body">
                <strong>Remplir le formulaire et joindre les documents utiles.</strong><br>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                <strong>Etape 4 : </strong> Dossiers à joindre
              </button>
            </h2>
            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
              <div class="accordion-body">
                <strong><code> Tout candidat est appelé à joindre le rapport validé de l'activité présenté.</code></strong><br>
                <strong>Selon le statut du candidat, veuillez joindre : </strong>
                <ul>
                  <li><i class="bi bi-check-circle-fill"></i> <span>Pour les entreprises sociales et les sociétés coopératives : NINEA, RCCM et Quitus fiscal ;</span></li>
                  <li><i class="bi bi-check-circle-fill"></i> <span>Pour les IMF, FINTECH, ONG, Banques, compagnies d’assurance : Agrément ;</span></li>
                  <li><i class="bi bi-check-circle-fill"></i> <span>Pour les structures publiques : Décret de création.</span></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                Adresse de soumission/Délais de soumission
              </button>
            </h2>
            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
              <div class="accordion-body">
                <strong>La soumission des candidatures se fera à travers cette plateforme (www.prixmmess.gouv.sn).</strong><strong> Aucun document physique ne sera accepté.</strong><br>La date limite des candidatures est fixée le <code>XX XX 2025</code>
              </div>
            </div>
          </div>
        </div>

      </div>

  </main>

@endsection