
@extends('layouts.accueil_template')

@section('title', 'APropos')

@section('content')

  <main class="main">
  <!-- Section Title -->
<!-- Sidebar -->
@include('auth.login')
@include('auth.register')
  <hr>
  <div class="container section-title" data-aos="fade-up">
    <h2>A Propos</h2>
  </div><!-- End Section Title -->

  </main>

@endsection
