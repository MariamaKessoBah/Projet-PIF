<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\StructController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocaliteController;
use App\Models\User;
use Illuminate\Http\Request;

// Routes publiques
Route::get('/', [AccueilController::class, 'accueil'])->name('accueil');
Route::get('/apropos', [AccueilController::class, 'home'])->name('apropos');
Route::get('/docCandidature', [AccueilController::class, 'doc'])->name('docCandidature');
Route::get('/mediatheque', [AccueilController::class, 'galerie'])->name('mediatheque');

// Authentification
Route::get('/login', [AuthController::class, 'login'])->name('login')->withoutMiddleware(['auth']);
Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register')->withoutMiddleware(['auth']);
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Routes protégées par le middleware 'auth'
Route::middleware('auth')->group(function () {
    // Structure
    Route::prefix('struct')->group(function () {
        Route::get('/dashboard', [StructController::class, 'index'])->name('dashboard');  
        Route::get('/candidater', [StructController::class, 'showLocalite'])->name('candidater');
        Route::put('/candidater', [StructController::class, 'store'])->name('structure.store');
        Route::post('/candidater', [StructController::class, 'storeCandidature'])->name('structure.storeCandidature');
        
        Route::get('/laureat/details/{id}', [StructController::class, 'getLaureatDetails']);
        // Route::put('/candidater', [StructController::class, 'updateCandidature'])->name('structure.updateCandidature');
        Route::put('/candidature/{id}', [StructController::class, 'update'])->name('candidature.update');


        Route::get('/candidature', [StructController::class, 'index'])->name('candidature.index');

        // Routes pour le téléchargement de fichiers
        Route::get('/telecharger/{type}/{filename}', [App\Http\Controllers\StructController::class, 'telechargerFichier'])->name('telecharger');       
    });



    // Évaluateur
    Route::prefix('evaluator')->group(function () {
        Route::get('/evalue', [EvaluatorController::class, 'showEvaluationForm'])->name('evalue');
        Route::get('/critereEvaluation', [EvaluatorController::class, 'showCriteriaPage'])->name('critereEvaluation');
        Route::get('/listeCandidat', [EvaluatorController::class, 'showCandidatesList'])->name('listeCandidat');
        Route::get('/laureat', [EvaluatorController::class, 'showLaureatesList'])->name('laureat');
        Route::get('/laureat/details/{id}', [EvaluatorController::class, 'getLaureatDetails'])
        ->name('laureat.details');        Route::get('/candidature/details/{id}', [EvaluatorController::class, 'getCandidatureDetails']);
        Route::post('/candidatures/valider', [EvaluatorController::class, 'valider'])->name('candidatures.valider');
        Route::get('/evalue', [EvaluatorController::class, 'index'])->name('evalue');  
        Route::get('/registerEvaluator', [EvaluatorController::class, 'evaluateurRegist'])->name('registerEvaluator');  
        Route::get('/editeurEvaluator', [EvaluatorController::class, 'evaluateurEdit'])->name('editEvaluator');
        Route::delete('/evaluateurs/{id}', [EvaluatorController::class, 'destroy'])->name('deleteEvaluator');
        

        Route::post('/enregistrerNote', [EvaluatorController::class, 'enregistrerNote'])
        ->name('candidatures.enregistrerNote');
        
        Route::get('/validation-modal/{id}', [EvaluatorController::class, 'showValidationModal'])->name('evaluateur.validation-modal');

        Route::post('/evaluateurs/store', [EvaluatorController::class, 'evaluateurStore'])->name('evaluateurs.store');
        // Récupérer les coefficients d'évaluation
        Route::post('/candidatures/rejeter', [EvaluatorController::class, 'rejeter'])->name('candidatures.rejeter');

        // Route::get('/candidatures/filtrer', [EvaluatorController::class, 'filtre'])->name('candidatures.filtrer');

        Route::post('/jury-validation', [EvaluatorController::class, 'juryValidation'])
        ->name('evaluator.jury-validation');
       
        Route::post('/restaurer-candidature/{id}', [EvaluatorController::class, 'restaurerCandidature'])->name('candidatures.restaurer');
        
        Route::get('/candidatures/{id}/evaluation', [EvaluatorController::class, 'getEvaluation']);

        Route::get('/laureat/{id}', [EvaluatorController::class, 'showLaureat'])->name('laureat.show');
        // Route::post('/jury/validation', [EvaluatorController::class, 'juryValidation']);
        Route::get('/candidatures/filtrer', [EvaluatorController::class, 'filtre'])->name('candidatures.filtrer');
    
        // Routes pour le téléchargement de fichiers
        Route::get('/telecharger/{type}/{filename}', [EvaluatorController::class, 'telechargerFichier'])->name('telecharger');     
        Route::post('/notes/publier', [EvaluatorController::class, 'publierNotes'])->name('notes.publier');
  
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
    
        return redirect('/register')->with('error', 'Email non trouvé. Assurez-vous que l\'email est correct.');
    })->name('verify.email');
    



    Route::post('/account/update', [AuthController::class, 'updateAccount'])->name('account.update');
    
    // Déconnexion
    Route::post('/', [AuthController::class, 'logout'])->name('logout');
});
