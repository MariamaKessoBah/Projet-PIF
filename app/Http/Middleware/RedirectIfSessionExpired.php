<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfSessionExpired
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est déconnecté à cause d'une session expirée
        if (!Auth::check()) {
            return redirect()->route('accueil')->with('status', 'Votre session a expiré. Veuillez vous reconnecter.');
        }

        return $next($request);
    }
}
