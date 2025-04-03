<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * Les noms des champs à exclure du trim.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Vous pouvez ajouter ici les champs à exclure
    ];
}
