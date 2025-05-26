<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Prix de l'Inclusion Financière</title>
    
    <!-- Inclure vos CSS ici -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Ajoutez d'autres CSS si nécessaire -->
    
    @yield('styles')
</head>
<body class="hold-transition">
    <div class="wrapper">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Inclure vos JS ici -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Ajoutez d'autres JS si nécessaire -->
    
    @yield('scripts')
</body>
</html>