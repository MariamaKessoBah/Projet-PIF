<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest; // Si vous l'utilisez
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\WelcomeUserNotification;
use Illuminate\Support\Facades\Log; // Ajout de l'importation de Log
use Illuminate\Support\Facades\DB; 

class AuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function login()
    {
        return view('auth.login');
    }


    // Gérer la connexion de l'utilisateur
    public function handleLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        if (Auth::attempt($validated)) {
            $user = Auth::user();
        
            // Vérification du rôle
            switch ($user->role) {
                case 'structure':
                    return redirect()->route('dashboard');
                case 'evaluateur':
                case 'DMIF':
                case 'jury':
                    return redirect()->route('evalue');
                case 'superAdmin':
                    return redirect()->route('administrateur'); 
                default:
                    return redirect()->route('accueil');
            }
        }
        
        
        return redirect()->back()
        ->with('error_msg', 'Adresse e-mail ou mot de passe incorrect.')
        ->with('open_modal', true);
    }

    // Déconnexion de l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l'utilisateur
        $request->session()->invalidate(); // Invalide la session
        $request->session()->regenerateToken(); // Régénère le token CSRF
    
        // Redirection vers la page d'accueil
        return redirect()->route('accueil')->with('status', 'Vous êtes déconnecté.');
    }    

    public function register(Request $request)
    {
        try {
            // Validation des données
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'email' => 'required|string|email:rfc,dns|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
    

            // Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'structure', 
            ]);
    
            // Envoi de la notification
            $user->notify(new WelcomeUserNotification($user));
    
            // Renvoi de la réponse en JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Inscription réussie. Un e-mail de confirmation vous a été envoyé.'
            ]);
            
        } catch (\Exception $e) {
            // Enregistrer l'erreur dans les logs
            Log::error('Erreur lors de l\'inscription :', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l\'inscription. Veuillez réessayer.'
            ], 500);
        }
    }
    
    
    public function updateAccount(Request $request)
    {
        Log::info("Données reçues:", $request->all());
        
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        try {
            DB::beginTransaction();
            
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
            }
            
            $data = ['email' => $request->email];
            if ($request->filled('password')) {
                $data['password'] = $request->password;
            }

            if (!$user instanceof \App\Models\User) {
                return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
            }
            
            $user->update($data);
            DB::commit();
            
            Log::info("Utilisateur mis à jour:", ['id' => $user->id, 'email' => $user->email]);
            
            return response()->json(['message' => 'Informations mises à jour avec succès!'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erreur mise à jour:", ['error' => $e->getMessage()]);
            
            return response()->json(['message' => 'Une erreur est survenue.'], 500);
        }
    }
    
}
