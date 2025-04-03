<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indique les URIs qui doivent être exclus de la vérification CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Ajoutez ici les URIs que vous souhaitez exclure de la vérification
    ];
}
