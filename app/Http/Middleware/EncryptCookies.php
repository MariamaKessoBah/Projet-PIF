<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Les noms des cookies qui ne devraient pas être chiffrés.
     *
     * @var array
     */
    protected $except = [
        // Ajoutez ici les noms de cookies à exclure du chiffrement, si nécessaire
    ];
}
