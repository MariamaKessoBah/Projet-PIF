<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Gérer une requête entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Si l'utilisateur est authentifié, redirige vers la page d'accueil
        if (Auth::guard($guards[0] ?? null)->check()) {
            return redirect('/');
        }
        
        return $next($request);
    }
}
