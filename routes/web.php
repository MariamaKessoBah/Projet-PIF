<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\StructController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Http\Request;

// Routes publiques
Route::get('/', [AccueilController::class, 'accueil'])->name('accueil');
Route::get('/apropos', [AccueilController::class, 'home'])->name('apropos');
Route::get('/docCandidature', [AccueilController::class, 'doc'])->name('docCandidature');

// Authentification
Route::get('/login', [AuthController::class, 'login'])->name('login')->withoutMiddleware(['auth']);
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register'); // Ajout d'un nom pour la route

// Routes protégées par le middleware 'auth'
Route::middleware('auth')->group(function () {
    // Structure
    Route::prefix('struct')->group(function () {
        Route::get('/dashboard', [StructController::class, 'index'])->name('dashboard');  
        Route::get('/candidater', [StructController::class, 'index1'])->name('candidater');
        Route::put('/candidater', [StructController::class, 'store'])->name('structure.store');

    });

    // Évaluateur
    Route::prefix('evaluator')->group(function () {
        Route::get('/evalue', [EvaluatorController::class, 'doc1'])->name('evalue');
        Route::get('/critereEvaluation', [EvaluatorController::class, 'index1'])->name('critereEvaluation');
        Route::get('/listeCandidat', [EvaluatorController::class, 'index'])->name('listeCandidat');
        Route::get('/laureat', [EvaluatorController::class, 'index2'])->name('laureat');

    });

    // Admin
    Route::prefix('admin')->group(function () {
        Route::get('/administrateur', [AdminController::class, 'index'])->name('administrateur');
        Route::get('/listeUser', [AdminController::class, 'user'])->name('listeUser');
        Route::get('/editUser', [AdminController::class, 'editer'])->name('editUser');
        Route::get('/critereAdmin', [AdminController::class, 'critere'])->name('critereAdmin');

    });

    Route::get('/verify-email', function (Request $request) {
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            $user->email_verified_at = now();
            $user->save();
    
            return redirect('/login')->with('success', 'Votre email a été confirmé.');
        }
    
        return redirect('/register')->with('error', 'Email non trouvé.');
    })->name('verify.email');
    

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
