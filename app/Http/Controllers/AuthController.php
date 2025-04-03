<?php
namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest; // Si vous l'utilisez
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\UserRegisteredNotification;



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
            if ($user->role === 'structure') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'evaluateur' || $user->role === 'DMIF' || $user->role === 'jury') {
                return redirect()->route('evalue');
            } elseif ($user->role === 'superAdmin') {
                return redirect()->route('administrateur'); 
            } else {
                return redirect()->route('accueil');
            }
                } return redirect()->back()
                ->with('error_msg', 'Paramètres de connexion incorrects')
                ->with('open_modal', true); // Ajouter cette variable à la session
    
    }
    
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
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'structure',
            ]);
    
            // Envoyer un email de confirmation
            $user->notify(new UserRegisteredNotification($user));
    
            return response()->json([
                'message' => __('messages.registration_success'),
            ]);
        } catch (\Exception $e) {
            \Log::error('Registration error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            return response()->json([
                'message' => __('messages.registration_failed'),
            ], 500);
        }
    }
    
    

    
    // Mettre à jour le compte utilisateur
    public function updateAccount(Request $request)
    {
        // Validation des données entrantes
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed', // Vérifie que le mot de passe est confirmé
        ]);

        // Mise à jour des informations de l'utilisateur
        $user = Auth::user();
        $user->email = $request->email;

        if ($request->filled('password')) {
            // Hash le mot de passe avant de le stocker
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Redirige avec un message pour le toast
        return redirect()->back()->with('toast', ['message' => 'Informations de compte mises à jour avec succès!', 'type' => 'success']);
    }
}
