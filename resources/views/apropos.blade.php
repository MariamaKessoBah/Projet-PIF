@extends('layouts.accueil_template')

@section('title', 'À Propos')

@section('content')

<main class="main">
  <hr>
  <!-- Section: À Propos -->
  <section id="apropos" class="apropos section py-5">
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center">
        <!-- Titre principal -->
        <div class="text-center mb-5">
          <p class="lead text-muted">Prix du Ministre de la Microfinance et de l’Économie Sociale et Solidaire pour la Promotion de l’Inclusion Financière</p>
        </div>

        <div class="row">
          <!-- Colonne gauche -->
          <div class="col-lg-12">
            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">À propos du prix</h4>
              <p>
                Le Ministère de la Microfinance et de l'Économie Sociale et Solidaire a lancé un prix annuel pour récompenser les initiatives marquantes dans le domaine de l'inclusion financière. Ce prix vise à encourager et à mettre en lumière les acteurs de la microfinance qui œuvrent pour un meilleur accès aux services financiers pour tous.
              </p>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Pourquoi participer ?</h4>
              <p>Participer à ce prix vous permet de :</p>
              <ul class="list-unstyled">
                <li>- Mettre en avant votre projet à un large public.</li>
                <li>- Bénéficier d'une reconnaissance au sein de l'écosystème de l'inclusion financière.</li>
                <li>- Contribuer à l'atteinte des objectifs de développement durable.</li>
                <li>- Rejoindre un réseau dynamique d'acteurs engagés pour un changement social positif.</li>
              </ul>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Qui peut participer ?</h4>
              <p>Le prix est ouvert à une large gamme d'acteurs du secteur :</p>
              <ul class="list-unstyled">
                <li>- Institutions de Microfinance</li>
                <li>- FINTECH</li>
                <li>- ONG</li>
                <li>- Banques</li>
                <li>- Compagnies d'assurances</li>
                <li>- Structures publiques</li>
                <li>- Entreprises sociales</li>
                <li>- Sociétés coopératives</li>
              </ul>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Calendrier</h4>
              <ul class="list-unstyled">
                <li>📅 <strong>Février :</strong> Ouverture des candidatures</li>
                <li>🏆 <strong>Mars :</strong> Cérémonie de remise des prix</li>
              </ul>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Critères de participation</h4>
              <p>Les projets seront évalués selon plusieurs critères :</p>
              <ul class="list-unstyled">
                <li><strong>Impact géographique :</strong> Présence en zones rurales et auprès des populations vulnérables.</li>
                <li><strong>Utilisation des technologies :</strong> Intégration des solutions numériques pour améliorer l'accès aux services financiers.</li>
                <li><strong>Adaptation aux besoins sociaux :</strong> Prise en compte des besoins spécifiques des femmes, des jeunes et des populations vulnérables.</li>
              </ul>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Comment participer ?</h4>
              <p>La participation au prix se fait en trois étapes simples :</p>
              <ol class="mb-3">
                <li>📝 Créez un compte sur la plateforme.</li>
                <li>📌 Complétez le formulaire en détaillant votre projet et en répondant aux critères.</li>
                <li>📎 Soumettez les pièces justificatives demandées.</li>
              </ol>
              <p>Un jury d'experts évaluera toutes les candidatures selon les critères mentionnés ci-dessus.</p>
            </div>

            <div class="p-4 shadow-lg rounded bg-light mb-4">
              <h4 class="fw-bold text-dark">Foire aux questions</h4>
              <p>
                  📩 Si vous avez des questions, vous pouvez consulter notre 
                  <a href="{{ url('/#faq') }}" class="text-primary">FAQ</a>
                  ou nous contacter directement via la plateforme.
              </p>
          </div>
          
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

@endsection
