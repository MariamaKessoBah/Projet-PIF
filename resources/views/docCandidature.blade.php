@extends('layouts.accueil_template')

@section('title', 'DocCandidature')

@section('content')
<main class="main">
  <!-- Login & Register Modals -->
  @include('auth.login')
  @include('auth.register')

  <hr>

  <!-- Section : Composition du dossier de candidature -->
  <section id="apropos" class="apropos section">
    <div class="container" data-aos="fade-up">
      
      <!-- Section Title -->
      <div class="section-title text-center" data-aos="fade-up">
        <h2><strong>Composition du dossier de candidature</strong></h2>
        <p>Comment participer ?</p>
      </div>

      <!-- Accordion -->
      <div class="accordion" id="accordionPanelsStayOpenExample">
        
        <!-- Étape 1 : Création de Compte -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#etape1" aria-expanded="true" aria-controls="etape1">
              <strong>Étape 1 : </strong> Création de Compte
            </button>
          </h2>
          <div id="etape1" class="accordion-collapse collapse show">
            <div class="accordion-body">
              <strong>Pour soumettre votre candidature, vous devez créer un compte utilisateur.</strong>
              <p>Un message de confirmation, contenant vos identifiants de connexion, vous sera envoyé par email.</p>
            </div>
          </div>
        </div>

        <!-- Étape 2 : Identification du candidat -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#etape2" aria-expanded="false" aria-controls="etape2">
              <strong>Étape 2 : </strong> Identification du candidat
            </button>
          </h2>
          <div id="etape2" class="accordion-collapse collapse">
            <div class="accordion-body">
              <strong>Renseignez une fiche signalétique comprenant les informations suivantes :</strong>
              <ul>
                <li>Statut</li>
                <li>Dénomination sociale</li>
                <li>Date de création</li>
                <li>Siège social</li>
                <li>Téléphone, Adresse mail</li>
                <li>Nombre de membres</li>
                <li>Point de contact (nom, prénoms, coordonnées et fonction)</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Étape 3 : Dossier de candidature -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#etape3" aria-expanded="false" aria-controls="etape3">
              <strong>Étape 3 : </strong> Dossier de candidature
            </button>
          </h2>
          <div id="etape3" class="accordion-collapse collapse">
            <div class="accordion-body">
              <strong>Remplissez le formulaire et joignez les documents utiles.</strong>
            </div>
          </div>
        </div>

        <!-- Étape 4 : Dossiers à joindre -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#etape4" aria-expanded="false" aria-controls="etape4">
              <strong>Étape 4 : </strong> Dossiers à joindre
            </button>
          </h2>
          <div id="etape4" class="accordion-collapse collapse">
            <div class="accordion-body">
              <p><strong>Chaque candidat doit joindre le rapport validé de l'activité présenté.</strong></p>
              <strong>Documents requis selon le statut :</strong>
              <ul>
                <li><i class="bi bi-check-circle-fill"></i> Entreprises sociales et sociétés coopératives : NINEA, RCCM et Quitus fiscal</li>
                <li><i class="bi bi-check-circle-fill"></i> IMF, FINTECH, ONG, Banques, compagnies d’assurance : Agrément</li>
                <li><i class="bi bi-check-circle-fill"></i> Structures publiques : Décret de création</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Adresse de soumission / Délais -->
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#etape5" aria-expanded="false" aria-controls="etape5">
              Adresse de soumission / Délais
            </button>
          </h2>
          <div id="etape5" class="accordion-collapse collapse">
            <div class="accordion-body">
              <p><strong>Les candidatures doivent être soumises via cette plateforme (<code>www.prixmmess.gouv.sn</code>).</strong></p>
              <p><strong>Aucun document physique ne sera accepté.</strong></p>
              <p>La date limite des candidatures est fixée au <code>XX XX 2025</code>.</p>
            </div>
          </div>
        </div>

      </div> <!-- End Accordion -->

      <!-- Bouton Participer -->
      <div class="text-center mt-4">
        <p>
          Si vous voulez participer, veuillez cliquer sur le bouton ci-dessous pour ouvrir un compte.
        </p>
        <a href="" data-bs-toggle="modal" data-bs-target="#registerModal" class="btn btn-primary">Participer</a>
      </div>

    </div> <!-- End Container -->
  </section>
</main>
@endsection
