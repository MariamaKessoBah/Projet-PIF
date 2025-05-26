<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DossierCandidature;
use Illuminate\Support\Facades\DB; 
use App\Models\SecteurIntervention;
use App\Models\Structure;
use App\Models\Critere;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Evaluateur;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SetPasswordNotification;
use Illuminate\Support\Facades\Log;
use App\Models\Laureat;
use App\Models\Region;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class EvaluatorController extends Controller 
{
    /**
     * Affiche la page d'évaluation.
     */
    public function showEvaluationForm()
    {
        // Récupérer les critères
        $criteres = Critere::all();
        
        // Récupérer les candidatures avec pagination
        $candidatures = DossierCandidature::paginate(10);
    
        // Retourner la vue avec les variables
        return view('evaluator.evalue', compact('candidatures', 'criteres'));
    }
    
    public function evaluateurRegist()
    {
        // Retourner la vue avec les variables
        return view('evaluator.registerEvaluator');
    }
   
    public function evaluateurEdit()
    {
        $evaluateurs = Evaluateur::with('user')->get(); // On récupère les évaluateurs avec leurs users
        return view('evaluator.editeurEvaluator', compact('evaluateurs'));
    }

    public function evaluateurStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'tel' => 'required|string',
            'structure' => 'required|string',
            'fonction' => 'required|string',
        ]);

        // Création de l'utilisateur avec un mot de passe temporaire aléatoire
        $tempPassword = Str::random(20);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($tempPassword), // Mot de passe temporaire crypté
            'role' => 'evaluateur', 
        ]);

        // Création de l'évaluateur
        $evaluateur = Evaluateur::create([
            'id_user' => $user->id,
            'tel' => $request->tel,
            'structure' => $request->structure,
            'fonction' => $request->fonction,
        ]);

        // Génération du token pour la réinitialisation du mot de passe
        $token = Password::createToken($user);
        
        // Envoi de la notification avec le lien de définition du mot de passe
        $user->notify(new SetPasswordNotification($token));

        // Rediriger vers la page d'édition des évaluateurs
        return redirect()->route('editEvaluator')
                        ->with('success', 'Évaluateur enregistré avec succès. Un email a été envoyé pour la définition du mot de passe.');
    }

    
public function showSetPasswordForm(Request $request, $token)
{
    // Vérifier que l'email est présent dans la requête
    if (!$request->has('email')) {
        return redirect()->route('login')->with('error', 'Lien invalide. L\'email est manquant.');
    }
    
    $email = $request->email;
    
    // Vérifier que l'email correspond à un utilisateur existant
    $user = User::where('email', $email)->first();
    
    if (!$user) {
        return redirect()->route('login')->with('error', 'Utilisateur non trouvé.');
    }
    
    return view('evaluator.set-password', [
        'token' => $token,
        'email' => $email
    ]);
}
    
    // Nouvelle méthode pour traiter la définition du mot de passe
    public function setPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        // Utiliser le broker de mot de passe pour réinitialiser
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Mettre à jour le mot de passe de l'utilisateur
                $user->password = $password;
                $user->save();
            }
        );
        
        if ($status === Password::PASSWORD_RESET) {
            // Ne pas rediriger vers la page de connexion mais rester sur la page actuelle avec un message de succès
            return back()->with('status', 'reset_success');
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
    
    

    public function update(Request $request, $id)
    {
        $evaluator = Evaluateur::findOrFail($id);
        $user = $evaluator->user;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'structure' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $evaluator->update([
            'structure' => $validated['structure'],
            'fonction' => $validated['fonction'],
            'tel' => $validated['tel'],
        ]);

        return redirect()->route('editEvaluator')->with('success', 'Évaluateur modifié avec succès.');
    }
    
    public function destroy($id)
    {
        // On récupère l'évaluateur
        $evaluateur = Evaluateur::findOrFail($id);
    
        // Supprimer l'utilisateur associé à cet évaluateur
        $user = $evaluateur->user;
        $user->delete(); // Cette ligne supprime l'utilisateur
    
        // On supprime l'évaluateur
        $evaluateur->delete();
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Évaluateur et utilisateur supprimés avec succès.');
    }
    
    public function index()
    {
        // Récupération des statistiques existantes
        $candidatures = DossierCandidature::all();
        $valides = DossierCandidature::where('etat', 'validé')->count();
        $attente = DossierCandidature::where('etat', 'en_attente')->count();
        $evalues = DossierCandidature::where('etat', 'évalué')->count();
        $termines = DossierCandidature::where('etat', 'terminé')->count();
        $rejectes = DossierCandidature::where('etat', 'rejeté')->count();

        // Récupération des statistiques par secteur
        $secteurStats = DB::table('secteur_toucher')
            ->join('secteur_interventions', 'secteur_toucher.id_secteur', '=', 'secteur_interventions.id')
            ->join('dossier_candidatures', 'secteur_toucher.id_candidature', '=', 'dossier_candidatures.id')
            ->select('secteur_interventions.designation_secteur', DB::raw('count(*) as total'))
            ->groupBy('secteur_interventions.designation_secteur')
            ->orderBy('total', 'desc')
            ->get();

        // Récupération des statistiques par type de structure
        $structureStats = DB::table('dossier_candidatures')
            ->join('structures', 'dossier_candidatures.id_structure', '=', 'structures.id')
            ->select('structures.type', DB::raw('count(*) as total'))
            ->groupBy('structures.type')
            ->orderBy('total', 'desc')
            ->get();

        return view('evaluator.evalue', compact(
            'candidatures',
            'valides',
            'attente',
            'rejectes',
            'secteurStats',
            'structureStats',
            'evalues',
            'termines'
        ));
    }

    /**
     * Affiche les critères d'évaluation.
     */
    public function showCriteriaPage()
    {
        $candidatures = DossierCandidature::paginate(10); // Pagination par 10 éléments
        return view('evaluator.critereEvaluation', compact('candidatures'));
    }

    /**
     * Affiche la liste des candidats.
     */
    public function showCandidatesList()
    {
        $criteres = Critere::all();
        $user = Auth::user();
        $regions = Region::all();

    
        if (in_array($user->role, ['DMIF', 'jury'])) {
            // Candidatures validées sans notes "en_attente"
            $candidaturesValidees = DossierCandidature::where('etat', 'validé')
                ->with('notes.critere')
                ->paginate(10);
    
            // Calcul de la note_totale pour chaque candidature
            $candidaturesValidees->getCollection()->transform(function ($candidature) {
                $candidature->note_totale = $candidature->notes->sum(fn($note) => $note->note_critere * ($note->critere->coefficient ?? 1));
                return $candidature;
            });
    
            // Trier par note_totale après la transformation
            $candidaturesValidees = new \Illuminate\Pagination\LengthAwarePaginator(
                $candidaturesValidees->getCollection()->sortByDesc('note_totale'),
                $candidaturesValidees->total(),
                $candidaturesValidees->perPage(),
                $candidaturesValidees->currentPage(),
                // ['path' => \Request::url(), 'query' => \Request::query()]
            );
    
            // Candidatures rejetées
            $candidaturesRejetees = DossierCandidature::where('etat', 'rejeté')->paginate(10);
    
            // Candidatures en attente
            $candidaturesEnAttente = DossierCandidature::where('etat', 'en_attente')->paginate(10);
    
            // Candidatures évaluées : uniquement celles dont l'état est "évalué" ou "terminé"
            $candidaturesEvaluees = DossierCandidature::whereIn('etat', ['évalué', 'terminé'])
                ->with('notes.critere')
                ->paginate(10);
    
            // Calcul de la note_totale pour chaque candidature
            $candidaturesEvaluees->getCollection()->transform(function ($candidature) {
                $candidature->note_totale = $candidature->notes->sum(fn($note) => $note->note_critere * ($note->critere->coefficient ?? 1));
                return $candidature;
            });
    
            // Trier par note_totale après la transformation
            $candidaturesEvaluees = new \Illuminate\Pagination\LengthAwarePaginator(
                $candidaturesEvaluees->getCollection()->sortByDesc('note_totale'),
                $candidaturesEvaluees->total(),
                $candidaturesEvaluees->perPage(),
                $candidaturesEvaluees->currentPage(),
                // ['path' => \Request::url(), 'query' => \Request::query()]
            );
        } else {
            // Gestion pour un évaluateur
            $evaluateur = Evaluateur::where('id_user', $user->id)->first();
            if (!$evaluateur) {
                abort(403, 'Aucun évaluateur trouvé pour cet utilisateur.');
            }
    
            // Candidatures validées, où l'évaluateur n'a pas encore mis de notes
            $candidaturesValidees = DossierCandidature::where('etat', 'validé')
                ->whereDoesntHave('notes', function ($query) use ($evaluateur) {
                    $query->where('id_evaluateur', $evaluateur->id);
                })
                ->paginate(10);
    
            // Candidatures rejetées
            $candidaturesRejetees = DossierCandidature::where('etat', 'rejeté')->paginate(10);
    
            // Candidatures en attente
            $candidaturesEnAttente = DossierCandidature::where('etat', 'en_attente')->paginate(10);
    
            // Candidatures évaluées : celles qu'il a évaluées
            $candidaturesEvaluees = DossierCandidature::whereHas('notes', function ($query) use ($evaluateur) {
                $query->where('id_evaluateur', $evaluateur->id);
            })
                ->with(['notes' => function ($query) use ($evaluateur) {
                    $query->where('id_evaluateur', $evaluateur->id)->with('critere');
                }, 'structure'])
                ->paginate(10);
    
            // Calcul de la note_totale pour chaque candidature
            $candidaturesEvaluees->getCollection()->transform(function ($candidature) {
                $candidature->note_totale = $candidature->notes->sum(fn($note) => $note->note_critere * ($note->critere->coefficient ?? 1));
                return $candidature;
            });
    
            // Trier par note_totale après la transformation
            $candidaturesEvaluees = new \Illuminate\Pagination\LengthAwarePaginator(
                $candidaturesEvaluees->getCollection()->sortByDesc('note_totale'),
                $candidaturesEvaluees->total(),
                $candidaturesEvaluees->perPage(),
                $candidaturesEvaluees->currentPage(),
                // ['path' => \Request::url(), 'query' => \Request::query()]
            );
        }
    
        // Retourner la vue avec les données
        return view('evaluator.listeCandidat', compact(
            'criteres', 'candidaturesRejetees', 'candidaturesEnAttente', 'candidaturesValidees', 'candidaturesEvaluees', 'regions'
        ));
    }
    
    /**
     * Affiche la liste des lauréats.
     */
    public function showLaureatesList()
    {
        // Récupérer l'état de la note dans la base de données
        $etatNote = DB::table('notes')->where('etat_note', 'publié')->exists() ? 'publiée' : 'en_attente';
    
        // Récupérer les lauréats
        $laureats = Laureat::join('dossier_candidatures', 'laureats.candidature_id', '=', 'dossier_candidatures.id')
            ->join('structures', 'dossier_candidatures.id_structure', '=', 'structures.id')
            ->select(
                'laureats.id',
                'laureats.rang',
                'structures.nom_structure as structure_nom',
                'dossier_candidatures.intitule_activite',
                'dossier_candidatures.note_finale',
                'laureats.candidature_id'
            )
            ->orderBy('laureats.rang', 'asc')
            ->limit(3)
            ->get();
    
        return view('evaluator.laureat', compact('laureats', 'etatNote'));
    }
    
    public function getLaureatDetails($id)
    {
        try {
            // Log pour débogage
            Log::info('Début getLaureatDetails', ['id' => $id]);

            // Récupérer le lauréat avec ses relations
            $laureat = DB::table('laureats')
                ->join('dossier_candidatures', 'laureats.candidature_id', '=', 'dossier_candidatures.id')
                ->join('structures', 'dossier_candidatures.id_structure', '=', 'structures.id')
                ->leftJoin('secteur_toucher', 'dossier_candidatures.id', '=', 'secteur_toucher.id_candidature')
                ->leftJoin('secteur_interventions', 'secteur_toucher.id_secteur', '=', 'secteur_interventions.id')
                ->where('laureats.id', $id)
                ->select(
                    'laureats.*',
                    'dossier_candidatures.intitule_activite',
                    'dossier_candidatures.note_finale',
                    'structures.nom_structure',
                    'secteur_interventions.designation_secteur as secteur',
                    DB::raw('(SELECT COUNT(DISTINCT id_evaluateur) FROM notes WHERE id_candidature = dossier_candidatures.id) as nb_evaluateurs')
                )
                ->first();

            if (!$laureat) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lauréat non trouvé'
                ], 404);
            }

            // Récupérer les notes moyennes par critère
            $notes = DB::table('notes')
                ->join('criteres', 'notes.id_critere', '=', 'criteres.id')
                ->where('notes.id_candidature', $laureat->candidature_id)
                ->groupBy('criteres.id', 'criteres.designation', 'criteres.coefficient')
                ->select(
                    'criteres.designation as critere',
                    'criteres.coefficient',
                    DB::raw('AVG(notes.note_critere) as note_moyenne'),
                    DB::raw('AVG(notes.note_critere * criteres.coefficient) as total_points')
                )
                ->get();

            $response = [
                'success' => true,
                'laureat' => [
                    'nom_structure' => $laureat->nom_structure,
                    'intitule_activite' => $laureat->intitule_activite,
                    'secteur' => $laureat->secteur ?? 'Non spécifié',
                    'note_finale' => $laureat->note_finale,
                    'rang' => $laureat->rang,
                    'nb_evaluateurs' => $laureat->nb_evaluateurs,
                    'observation_jury' => $laureat->observation_jury
                ],
                'notes' => $notes
            ];

            Log::info('Réponse préparée', $response);

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('Erreur dans getLaureatDetails', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Récupère les détails d'une candidature spécifique.
     */
    public function getCandidatureDetails($id)
    {   
        $candidatures = DossierCandidature::with('structure')->paginate(10); 
        return view('evaluator.evalue', compact('candidatures'));        
        
        if ($candidature) {
            $structure = $candidature->structure;
            return response()->json([
                'nom_structure' => $structure->nom_structure ?? '--',
                'intitule_activite' => $candidature->intitule_activite ?? '--',
                'description_activite' => $candidature->description_activite ?? '--',
                'zone_intervention' => $candidature->zone_intervention ?? '--',
                'effet_impact' => $candidature->effet_impact ?? '--',
                'date_debut_intervention' => $candidature->date_debut_intervention ?? '--',
                'date_fin_intervention' => $candidature->date_fin_intervention ?? '--',
                'designation_cible' => $candidature->designation_cible ?? '--',
                'nbr_homme_toucher' => $candidature->nbr_homme_toucher ?? '--',
                'nbr_femme_toucher' => $candidature->nbr_femme_toucher ?? '--',
                'nbr_jeune_toucher' => $candidature->nbr_jeune_toucher ?? '--',
                'nbr_handicape_toucher' => $candidature->nbr_handicape_toucher ?? '--',
                'ninea_link' => asset('path/to/ninea/' . $candidature->fichier_ninea),
                'rapport_activite_link' => asset('path/to/rapport/' . $candidature->rapport_activite),
                'rccm_link' => asset('path/to/rccm/' . $candidature->fichier_rccm),
                'agrement_link' => asset('path/to/agrement/' . $candidature->fichier_agrement),
            ]);
        }

        return response()->json(['message' => 'Candidature non trouvée'], 404);
    }

    public function valider(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:dossier_candidatures,id',
                'etat' => 'required|in:validé',
            ]);
    
            $candidature = DossierCandidature::find($request->id);
    
            if (!$candidature) {
                return response()->json(['success' => false, 'message' => 'Candidature introuvable.'], 404);
            }
    
            $candidature->etat = $request->etat;
            $candidature->save();
    
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function rejeter(Request $request)
    {
        try {
            $candidature = DossierCandidature::findOrFail($request->id);
            $candidature->etat = 'rejeté';
            $candidature->motif_rejet = $request->motif_rejet;
            $candidature->save();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function enregistrerNote(Request $request)
    {
        try {
            Log::info('Début de enregistrerNote');

            // Récupérer l'évaluateur connecté
            $evaluateur = Evaluateur::where('id_user', Auth::id())->first();

            if (!$evaluateur) {
                Log::error('Évaluateur non trouvé pour l\'utilisateur:', ['user_id' => Auth::id()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Évaluateur non trouvé'
                ], 404);
            }

            Log::info('Évaluateur trouvé:', ['evaluateur_id' => $evaluateur->id]);

            // Validation des données
            $validated = $request->validate([
                'candidature_id' => 'required|exists:dossier_candidatures,id',
                'ratings' => 'required|array',
                'ratings.*.id_critere' => 'required|exists:criteres,id',
                'ratings.*.note_critere' => 'required|integer|between:0,10',
                'ratings.*.observation' => 'nullable|string'
            ]);

            DB::beginTransaction();

            // Mettre à jour ou enregistrer les notes
            foreach ($validated['ratings'] as $rating) {
                Note::updateOrCreate(
                    [
                        'id_candidature' => $validated['candidature_id'],
                        'id_critere' => $rating['id_critere'],
                        'id_evaluateur' => $evaluateur->id
                    ],
                    [
                        'note_critere' => $rating['note_critere'],
                        'observation' => $rating['observation'],
                        'etat_note' => 'en attente',
                        'etat' => 'en_attente'
                    ]
                );
            }

            // Vérifier si tous les évaluateurs ont soumis leurs notes
            $totalEvaluateurs = Evaluateur::count();
            $candidatureId = $validated['candidature_id'];

            $evaluateursAyantÉvalué = Note::where('id_candidature', $candidatureId)
                ->distinct('id_evaluateur')
                ->count('id_evaluateur');

            Log::info('Évaluateurs ayant évalué:', ['count' => $evaluateursAyantÉvalué]);

            // Si tous les évaluateurs ont évalué, mettre à jour la candidature en "évalué"
            if ($evaluateursAyantÉvalué >= $totalEvaluateurs) {
                DossierCandidature::where('id', $candidatureId)
                    ->update(['etat' => 'évalué']);

                Log::info("Candidature ID $candidatureId mise à jour en 'évalué'.");
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Les notes ont été enregistrées/mises à jour avec succès'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur dans enregistrerNote:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }

    public function filtre(Request $request)
    {
        $query = DossierCandidature::query();
    
        // Filtrer par type de structure
        if ($request->has('type_structure') && !empty($request->type_structure)) {
            $query->whereHas('structure', function($q) use ($request) {
                $q->where('type', $request->type_structure);
            });
        }
    
        // Filtrer par zone d'intervention
        if ($request->has('zone_intervention') && !empty($request->zone_intervention)) {
            $query->whereHas('regions', function($q) use ($request) {
                $q->where('nom_region', $request->zone_intervention);
            });
        }
    
        // Cloner la requête filtrée pour chaque état
        $candidaturesEnAttente = $query->clone()->where('etat', 'en_attente')->paginate(10);
        $candidaturesValidees = $query->clone()->where('etat', 'validé')->paginate(10);
        $candidaturesRejetees = $query->clone()->where('etat', 'rejeté')->paginate(10);
        
        $criteres = Critere::all();
    
        // Filtrer également les candidatures évaluées
        $candidaturesEvaluees = $query->clone()
            ->whereHas('notes')
            ->with(['notes.critere', 'structure'])
            ->paginate(10);
    
        // Transformer les items de la pagination en collection
        $candidaturesEvalueesCollection = collect($candidaturesEvaluees->items())
            ->map(function ($candidature) {
                $candidature->note_totale = $candidature->notes->sum(function ($note) {
                    return $note->note_critere * ($note->critere->coefficient ?? 1);
                });
                return $candidature;
            });
    
        // Récupérer toutes les régions
        $regions = Region::all();
    
        return view('evaluator.listeCandidat', compact(
            'candidaturesRejetees', 
            'candidaturesEnAttente', 
            'candidaturesValidees', 
            'criteres', 
            'candidaturesEvalueesCollection', // Passer la collection à la vue
            'candidaturesEvaluees', // Passer la pagination complète pour les liens
            'regions'  // Passer les régions à la vue
        ));
    }
    
    public function restaurerCandidature($id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 403);
        }

        if (Auth::user()->role !== 'DMIF') {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        try {
            $candidature = DossierCandidature::findOrFail($id);
            $candidature->etat = 'en_attente';
            $candidature->save();

            return response()->json(['success' => true, 'message' => 'Candidature restaurée avec succès !']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }

    public function showValidationModal($id)
    {
        try {
            $candidature = DossierCandidature::with([
                'notes' => function($query) {
                    $query->with(['critere', 'evaluateur.user']);
                },
                'structure'
            ])->findOrFail($id);

            // Récupérer tous les critères
            $criteres = Critere::orderBy('id')->get()->mapWithKeys(function($critere) {
                return [$critere->id => [
                    'designation' => $critere->designation,
                    'coefficient' => $critere->coefficient
                ]];
            });

            // Grouper les notes par évaluateur
            $evaluateursNotes = [];
            $totalGlobal = 0; // Somme totale de toutes les notes

            foreach ($candidature->notes as $note) {
                if (!$note->evaluateur || !$note->evaluateur->user) continue;

                $evaluateurId = $note->evaluateur->id;
                if (!isset($evaluateursNotes[$evaluateurId])) {
                    $evaluateursNotes[$evaluateurId] = [
                        'nom' => $note->evaluateur->user->name,
                        'notes' => [],
                        'total' => 0,
                        'observation' => $note->observation,
                        'date' => $note->updated_at->format('d/m/Y')
                    ];
                }

                if ($note->critere) {
                    // Stocker la note brute
                    $evaluateursNotes[$evaluateurId]['notes'][$note->critere->id] = $note->note_critere;
                    // Calculer le total pondéré pour cet évaluateur
                    $evaluateursNotes[$evaluateurId]['total'] += ($note->note_critere * $note->critere->coefficient);
                }
            }

            // Calculer la somme totale de tous les évaluateurs
            foreach ($evaluateursNotes as $evaluateur) {
                $totalGlobal += $evaluateur['total'];
            }

            return response()->json([
                'success' => true,
                'evaluateurNotes' => array_values($evaluateursNotes),
                'criteres' => $criteres,
                'candidature' => [
                    'nom_structure' => $candidature->structure->nom_structure ?? 'N/A',
                    'activite' => $candidature->intitule_activite ?? 'N/A',
                    'note_totale' => $totalGlobal // Somme totale au lieu de la moyenne
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur dans showValidationModal:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }

    public function juryValidation(Request $request)
    {
        try {
            // Validation des données
            $request->validate([
                'candidature_id' => 'required|exists:dossier_candidatures,id',
                'status' => 'required|in:valide,revision,rejete',
                'observation_jury' => 'nullable|string',
                'moyenne_finale' => 'nullable|numeric' // Validation de la moyenne finale
            ]);

            DB::beginTransaction();

            // Récupérer la candidature
            $candidature = DossierCandidature::find($request->candidature_id);

            // Si la candidature est validée
            if ($request->status === 'valide') {
                $candidature->etat = 'terminé';  // Mettre l'état à 'validé'
                $candidature->note_finale = $request->moyenne_finale;  // Enregistrer la moyenne finale
                $candidature->save();

                // Ajouter ou mettre à jour le lauréat
                $laureat = Laureat::updateOrCreate(
                    ['candidature_id' => $request->candidature_id],
                    [
                        'date_selection' => now(),
                        'observation_jury' => $request->observation_jury
                    ]
                );

                // Mettre à jour les rangs
                $this->updateRanks();
            }

            // Vérifier si toutes les notes sont validées pour passer à "terminé"
            $allNotesValidated = Note::where('id_candidature', $request->candidature_id)
                ->where('etat_note', '!=', 'validé')  // Vérifie s'il existe des notes non validées
                ->exists();  // Si une note n'est pas validée, exists() renvoie true, sinon false

            // Si toutes les notes sont validées, mettre l'état à "terminé"
            if (!$allNotesValidated) {  // Toutes les notes sont validées
                $candidature->etat = 'terminé';  // Mise à jour de l'état
                $candidature->save();  // Sauvegarder la mise à jour
            }

            DB::commit();  // Valider la transaction

            return response()->json([
                'success' => true,
                'message' => 'La décision a été enregistrée avec succès',
                'note_finale' => $candidature->note_finale
            ]);

        } catch (\Exception $e) {
            DB::rollBack();  // Annuler la transaction en cas d'erreur
            Log::error('Erreur dans juryValidation:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue: ' . $e->getMessage()
            ], 500);
        }
    }

    private function updateRanks()
    {
        $laureats = Laureat::join('dossier_candidatures', 'laureats.candidature_id', '=', 'dossier_candidatures.id')
            ->whereNotNull('dossier_candidatures.note_finale')
            ->orderByDesc('dossier_candidatures.note_finale')
            ->select('laureats.id', 'laureats.candidature_id')
            ->get();

        foreach ($laureats as $index => $laureat) {
            Laureat::where('id', $laureat->id)->update(['rang' => $index + 1]);
        }
    }

    /**
     * Télécharger un fichier spécifique (dans le contexte d'un évaluateur)
     */
    public function telechargerFichier($type, $filename)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        Log::info("Tentative de téléchargement par un évaluateur: Type=$type, Filename=$filename");
        
        // Vérifier si le type est valide
        if (!in_array($type, ['ninea', 'rapport', 'rccm', 'agrement', 'decret', 'quitus'])) {
            abort(404, 'Type de document non valide');
        }
        
        // Différent du code du StructController - En tant qu'évaluateur, 
        // nous avons juste besoin d'accéder directement au fichier
        
        // Tenter de trouver le fichier directement
        if (Storage::disk('public')->exists('documents/' . basename($filename))) {
            $path = storage_path('app/public/documents/' . basename($filename));
            return response()->download($path);
        }
        
        // Le fichier n'a pas été trouvé, cherchons un fichier similaire
        $requestedBase = strtolower(pathinfo(basename($filename), PATHINFO_FILENAME));
        $extension = strtolower(pathinfo(basename($filename), PATHINFO_EXTENSION));
        
        $files = Storage::disk('public')->files('documents');
        foreach ($files as $file) {
            $fileBase = strtolower(pathinfo(basename($file), PATHINFO_FILENAME));
            $fileExt = strtolower(pathinfo(basename($file), PATHINFO_EXTENSION));
            
            // Si l'extension correspond et le début du nom est similaire
            if ($fileExt == $extension && strpos($fileBase, substr($requestedBase, 0, 5)) === 0) {
                $filePath = storage_path('app/public/' . $file);
            
                if (file_exists($filePath)) {
                    return response()->download($filePath);
                }
            }
        }
        
        // Si le fichier n'a pas été trouvé après toutes les vérifications
        abort(404, 'Le fichier demandé n\'a pas été trouvé sur le serveur.');
    }

    public function publierNotes()
    {
        // Vérifier si l'état est déjà 'en_attente' avant de mettre à jour
        $etatNote = DB::table('notes')->where('etat_note', 'en attente')->exists();

        if ($etatNote) {
            // Mettre à jour l'état de toutes les notes en 'publié'
            DB::table('notes')
                ->where('etat_note', 'en attente')
                ->update(['etat_note' => 'publié']);

            return response()->json([
                'success' => true,
                'message' => 'La liste a été publiée avec succès.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'L\'état des notes est déjà publié.'
            ]);
        }
    }
}