<?php

namespace App\Http\Controllers;

use App\Models\CibleActivite;
use Illuminate\Http\Request;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;
use App\Models\Region;
use App\Models\Departement;
use App\Models\Commune;
use App\Models\SecteurIntervention;
use App\Models\DossierCandidature;
use App\Models\Prix;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Illuminate\Support\Facades\Log; // Ajout de l'importation de Log
use App\Models\Laureat;
use App\Models\Pays;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;




class StructController extends Controller
{
    public function index() {
        // Vérifier si un utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $user = Auth::user();
    
        // Récupérer la structure associée à l'utilisateur connecté
        $structure = Structure::where('id_user', $user->id)->first();
    
        // Récupérer la première entrée de la table 'prix' indépendamment de la structure
        $prix = Prix::first();
    
        $candidatures = [];
        $laureats = [];
        $notifications = [];
    
        if ($structure) {
            // Récupérer les candidatures associées à la structure
            $candidatures = DossierCandidature::where('id_structure', $structure->id)->get();
    
            // Récupérer les lauréats liés à la structure avec une requête optimisée
            $laureats = Laureat::join('dossier_candidatures', 'laureats.candidature_id', '=', 'dossier_candidatures.id')
                ->join('structures', 'dossier_candidatures.id_structure', '=', 'structures.id')
                ->where('structures.id', $structure->id)
                ->select([
                    'laureats.id',
                    'laureats.rang',
                    'structures.nom_structure as structure_nom',
                    'dossier_candidatures.intitule_activite',
                    'dossier_candidatures.note_finale'
                ])
                ->orderBy('laureats.rang', 'asc')
                ->get();
    
            // Récupérer le dernier dossier mis à jour
            $dossier = DossierCandidature::where('id_structure', $structure->id)
                ->latest('updated_at')
                ->first();
    
                if ($structure) {
                    // Récupérer les candidatures associées à la structure
                    $candidatures = DossierCandidature::where('id_structure', $structure->id)->get();
            
                    $laureats = Laureat::join('dossier_candidatures', 'laureats.candidature_id', '=', 'dossier_candidatures.id')
                    ->join('structures', 'dossier_candidatures.id_structure', '=', 'structures.id')
                    ->join('notes', 'notes.id_candidature', '=', 'dossier_candidatures.id')  // Joindre notes avec dossier_candidatures via 'id_candidature'
                    ->where('structures.id', $structure->id)
                    ->where('notes.etat_note', 'publié')  // Filtrer uniquement les notes avec 'publié'
                    ->select([
                        'laureats.id',
                        'laureats.rang',
                        'structures.nom_structure as structure_nom',
                        'dossier_candidatures.intitule_activite',
                        'dossier_candidatures.note_finale',
                        'laureats.observation_jury' // Observation du jury
                    ])
                    ->distinct()  // Empêcher les doublons
                    ->orderBy('laureats.rang', 'asc')
                    ->get();
                
                
                
                    // Récupérer le dernier dossier mis à jour
                    $dossier = DossierCandidature::where('id_structure', $structure->id)
                        ->latest('updated_at')
                        ->first();
            
                    if ($dossier) {
                        // Gestion des notifications selon l'état du dossier
                        $etat = $dossier->etat;
                        $motifRejet = $dossier->motif_rejet ?? 'Aucun motif spécifié';
                        
                        // Message pour l'état "terminé"
                        $messages = [
                            'validé' => "Votre dossier a été validé avec succès. Il est en cours d'évaluation.",
                            'évalué' => "Votre dossier a été évalué.",
                            'rejeté' => "Votre dossier a été rejeté.<br>Motif : " . $motifRejet,
                            'en_attente' => "Votre dossier est en attente de validation.",
                            'terminé' => "L'évaluation de votre dossier est terminée. Merci pour votre participation et votre confiance. <br><br>Observations du jury :<br>" . implode('<br>', $laureats->pluck('observation_jury')->toArray()),
                        ];
            
                        $notifications[] = [
                            'titre' => ucfirst($etat),
                            'message' => $messages[$etat] ?? "Votre dossier a été mis à jour.",
                            'date' => $dossier->updated_at->format('d/m/Y'),
                        ];
                    }
                }
            }
        // Retourner la vue avec toutes les données
        return view('struct.dashboard', compact('structure', 'candidatures', 'prix', 'laureats', 'notifications'));
    }
    
    
    

    // Ajout de la méthode pour les détails des lauréats
    public function getLaureatDetails($id)
    {
        try {
            // Vérifier que le lauréat appartient à la structure de l'utilisateur connecté
            $structure = Structure::where('id_user', Auth::id())->first();
            
            $laureat = DB::table('laureats')
                ->join('dossier_candidatures', 'laureats.candidature_id', '=', 'dossier_candidatures.id')
                ->join('structures', 'dossier_candidatures.id_structure', '=', 'structures.id')
                ->leftJoin('secteur_toucher', 'dossier_candidatures.id', '=', 'secteur_toucher.id_candidature')
                ->leftJoin('secteur_interventions', 'secteur_toucher.id_secteur', '=', 'secteur_interventions.id')
                ->where('laureats.id', $id)
                ->where('structures.id', $structure->id) // Sécurité supplémentaire
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
                    'message' => 'Lauréat non trouvé ou accès non autorisé'
                ], 404);
            }
    
            // Récupérer les notes moyennes par critère
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
    
            return response()->json([
                'success' => true,
                'laureat' => [
                    'nom_structure' => $laureat->nom_structure,
                    'intitule_activite' => $laureat->intitule_activite,
                    'secteur' => $laureat->secteur ?? 'Non spécifié',
                    'note_finale' => $laureat->note_finale,
                    'rang' => $laureat->rang,
                    'nb_evaluateurs' => $laureat->nb_evaluateurs,
                    'observation_jury' => $laureat->observation_jury
                ],
                'notes' => $notes
            ]);
    
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

        // Récupérer la première entrée de la table 'prix'
        $prix = Prix::first();

        // Retourner la vue avec les données
        return view('struct.dashboard', compact('structure', 'candidatures', 'prix', 'laureats'));
    }
    

    


    public function showLocalite()
{
    $structure = Structure::where('id_user', Auth::id())->first();
    $regions = Region::all();
    $departements = Departement::all();
    $communes = Commune::all();
    $secteur_interventions = SecteurIntervention::all();
    $cible_activites = CibleActivite::all();

    // Récupérer toutes les candidatures de la structure
    $candidatures = DossierCandidature::where('id_structure', $structure->id ?? null)->get();

    // Vérifier si l'une des candidatures est nationale
    $national = false;
    foreach ($candidatures as $candidature) {
        if ($candidature->pays()->where('national', 1)->exists()) {
            $national = true;
            break; // Si une candidature est nationale, on arrête la boucle
        }
    }

    return view('struct.candidater', compact(
        'structure', 'regions', 'departements', 'communes', 
        'secteur_interventions', 'cible_activites', 'candidatures', 'national'
    ));
}

    

    
    public function store(Request $request)
    {

        $structure = Structure::where('id_user', Auth::id())->first();
        $regions = Region::all();
        $departements = Departement::all();
        $communes = Commune::all();
        $secteur_interventions = SecteurIntervention::all();
        $cible_activites = CibleActivite::all();
    
        // Récupérer uniquement les candidatures liées à la structure de l'utilisateur connecté
        $candidatures = DossierCandidature::where('id_structure', $structure->id ?? null)->get();
    
        $validatedData = $request->validate([
            'nom_structure' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'siege_social' => 'required|string|max:255',
            'date_creation' => 'required|date',
            'tel_structure' => 'required|digits:9',
            'statut_juridique' => 'required|string|max:255',
            'ninea' => 'nullable|string|max:255',
            'registre_commerce' => 'nullable|string|max:255',
            'agreement' => 'nullable|string|max:255',
            'num_decret' => 'nullable|string|max:255',
            'nom_contact' => 'required|string|max:255',
            'prenom_contact' => 'required|string|max:255',
            'fonction_contact' => 'required|string|max:255',
            'tel_contact' => 'required|digits:9',
            'email_contact' => 'required|email|max:255',
        ], [
            // Messages personnalisés pour la validation
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
            'date' => 'Le champ :attribute doit être une date valide.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
        ]);
        
        
    
     // Vérifier si une structure existe déjà pour l'utilisateur
     $structure = Structure::where('id_user', Auth::id())->first();

     if ($structure) {
         // Si la structure existe déjà, on met à jour les informations
         $structure->update($validatedData);
     } else {
         // Sinon, on crée une nouvelle structure
         $structure = Structure::create(array_merge($validatedData, ['id_user' => Auth::id()]));
     }
 
      // Message de succès
     session()->flash('success', 'Votre structure a été enregistrée avec succès.');

     // Retourner à la vue avec la structure
    //  return view('struct.candidater', compact(
    //     'structure', 'regions', 'departements', 'communes', 
    //     'secteur_interventions', 'cible_activites', 'candidatures'
    // ));

    return redirect('/struct/candidater')->with('success', 'Votre structure a été enregistrée avec succès.');

    }

    public function storeCandidature(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        // Récupérer la structure de l'utilisateur connecté
        $structure = Structure::where('id_user', Auth::id())->first();
        if (!$structure) {
            return redirect()->back()->with('error', 'Structure non trouvée.');
        }
    
      // Récupérer les secteurs et vérifier si 'autre' est sélectionné
        $secteurs = $request->secteurs ?? [];

        // Définir les règles de validation
        $validationRules = [
            'intitule_activite' => 'required|string|max:255',
            'description_activite' => 'required|string',
            'effet_impact' => 'required|string',
            'innovation' => 'nullable|string',
            'date_debut_intervention' => 'required|date',
            'date_fin_intervention' => 'required|date|after_or_equal:date_debut_intervention',
            'national' => 'nullable|boolean',
            'regions' => $request->has('national') ? 'nullable|array' : 'required_without_all:departements,communes|array',
            'regions.*' => 'exists:regions,id',
            'departements' => $request->has('national') ? 'nullable|array' : 'required_without_all:regions,communes|array',
            'departements.*' => 'exists:departements,id',
            'communes' => $request->has('national') ? 'nullable|array' : 'required_without_all:regions,departements|array',
            'communes.*' => 'exists:communes,id',
            'secteurs' => 'required|array',
            'secteurs.*' => function ($attribute, $value, $fail) {
                if ($value !== 'autre' && !SecteurIntervention::where('id', $value)->exists()) {
                    $fail('Le secteur sélectionné est invalide.');
                }
            },
            'cibles' => 'required|array',
            'cibles.*' => 'exists:cible_activites,id',
            'nbr_homme' => 'nullable|integer|min:0',
            'nbr_femme' => 'nullable|integer|min:0',
            'nbr_jeune' => 'nullable|integer|min:0',
            'nbr_handicape' => 'nullable|integer|min:0',
            'rapport' => 'required|file|mimes:pdf,doc,docx,zip|max:512000',
            'ninea' => 'nullable|file|mimes:pdf,doc,docx,zip|max:512000',
            'rccm' => 'nullable|file|mimes:pdf,doc,docx,zip|max:512000',
            'agrement' => 'nullable|file|mimes:pdf,doc,docx,zip|max:512000',
            'decret' => 'nullable|file|mimes:pdf,doc,docx,zip|max:512000',
            'quitus' => 'nullable|file|mimes:pdf,doc,docx,zip|max:512000',
        ];

        // Si 'autre' est sélectionné dans les secteurs, rendre le champ 'secteur_autre' requis
        if (in_array('autre', $secteurs)) {
            $validationRules['secteur_autre'] = 'required|string|max:255';
        }

        // Validation des règles et messages
        $validationMessages = [
            'required' => 'Une fois que "Autre" est sélectionné, le champ "Secteur autre" devient obligatoire.',
            'required_without_all' => 'Au moins un des champs :values doit être rempli.',
            'exists' => 'L\'élément sélectionné pour :attribute est invalide.',
            'file' => 'Le fichier pour :attribute doit être valide.',
            'mimes' => 'Le fichier pour :attribute doit être de type :values.',
            'max' => 'Le fichier pour :attribute ne doit pas dépasser :max Ko.',
        ];

        // Validation du formulaire avec les règles et les messages personnalisés
        $request->validate($validationRules, $validationMessages);

        // Si 'secteur_autre' est renseigné, vérifier si ce nom existe déjà dans la table
        if (in_array('autre', $secteurs) && !empty($request->secteur_autre)) {
            $existingSecteur = SecteurIntervention::where('designation_secteur', $request->secteur_autre)->first();
            if ($existingSecteur) {
                // Si le secteur existe déjà, ajouter une erreur personnalisée
                return back()->withErrors(['secteur_autre' => 'Le secteur que vous souhaitez ajouter existe déjà dans la base de données. Veuillez simplement le sélectionner dans la liste.']);
            }
        }

        // Les données sont validées et prêtes à être utilisées
        $validatedData = $request->all(); // Vous pouvez maintenant accéder aux données validées

        // Vous pouvez maintenant enregistrer dans la base de données
        // Exemple: SecteurIntervention::create([...]);


        // Gestion des fichiers
        $filePaths = [];
        foreach (['rapport', 'ninea', 'rccm', 'agrement', 'decret', 'quitus'] as $file) {
            if ($request->hasFile($file)) {
                $extension = $request->file($file)->getClientOriginalExtension();
                $structureName = $structure->nom_structure ? Str::slug($structure->nom_structure) : 'structure-inconnue';
                $filename = $structureName . '_' . $file . '.' . $extension;
                $filePaths[$file] = $request->file($file)->storeAs('documents', $filename, 'public');
            } else {
                $filePaths[$file] = null;
            }
        }
    
        return DB::transaction(function () use ($validatedData, $filePaths, $structure, $request) {
            $currentYear = date('Y');
            $prix = Prix::where('annee', $currentYear)->first();
    
            if (!$prix) {
                return redirect()->back()->with('error', 'Aucun prix trouvé pour l\'année en cours.');
            }
    
            // Création ou mise à jour du dossier de candidature
            $candidature = DossierCandidature::updateOrCreate(
                ['id_structure' => $structure->id],
                array_merge($validatedData, [
                    'rapport_activite' => $filePaths['rapport'],
                    'fichier_ninea' => $filePaths['ninea'],
                    'fichier_rccm' => $filePaths['rccm'],
                    'fichier_agrement' => $filePaths['agrement'],
                    'decret_creation' => $filePaths['decret'],
                    'quitus_fiscal' => $filePaths['quitus'],
                    'id_prix' => $prix->id,
                    'updated_at' => now(),
                ])
            );
    
            // Mettre à jour l'intervention nationale
            Pays::updateOrCreate(
                ['candidature_id' => $candidature->id],
                ['national' => $request->has('national') ? 1 : 0]
            );
    
            // Gestion des relations avec les zones d'intervention
            if ($request->has('national')) {
                DB::table('region_derouler')->where('id_candidature', $candidature->id)->delete();
                DB::table('dept_deroule')->where('id_candidature', $candidature->id)->delete();
                DB::table('commune_derouler')->where('id_candidature', $candidature->id)->delete();
            } else {
                foreach (['regions' => 'region_derouler', 'departements' => 'dept_deroule', 'communes' => 'commune_derouler'] as $key => $table) {
                    DB::table($table)->where('id_candidature', $candidature->id)->delete();
                    if (!empty($validatedData[$key])) {
                        foreach ($validatedData[$key] as $id) {
                            DB::table($table)->insert([
                                'id_candidature' => $candidature->id,
                                'id_' . rtrim($key, 's') => $id,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                }
            }
    
            // Gestion des secteurs
            DB::table('secteur_toucher')->where('id_candidature', $candidature->id)->delete();
            foreach ($validatedData['secteurs'] as $secteurId) {
                if ($secteurId === 'autre') {
                    $nouveauSecteur = SecteurIntervention::create([
                        'designation_secteur' => $validatedData['secteur_autre'],
                        'descripion_secteur' => 'autre',
                    ]);
                    $secteurId = $nouveauSecteur->id;
                }
                DB::table('secteur_toucher')->insert([
                    'id_candidature' => $candidature->id,
                    'id_secteur' => $secteurId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
    
            // Gestion des cibles
            DB::table('viser_activites')->where('id_candidature', $candidature->id)->delete();
            foreach ($validatedData['cibles'] as $id) {
                DB::table('viser_activites')->insert([
                    'id_candidature' => $candidature->id,
                    'id_cible' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
    
            return redirect('/struct/candidater')->with('success', 'Votre dossier a été enregistré avec succès.');
        });
    }
    
    public function update(Request $request, $id)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        // Récupérer la candidature à mettre à jour
        $candidature = DossierCandidature::findOrFail($id);
    
        // Vérifier si la candidature est validée, évaluée ou terminée
        if (in_array($candidature->etat, ['validé', 'évalué', 'terminé'])) {
            return redirect()->back()->with('error', 'Cette candidature ne peut plus être modifiée.');
        }
    
        // Définir les règles de validation
        $validationRules = [
            'intitule_activite' => 'required|string|max:255',
            'description_activite' => 'required|string',
            'effet_impact' => 'required|string',
            'innovation' => 'nullable|string',
            'date_debut_intervention' => 'required|date',
            'date_fin_intervention' => 'required|date|after_or_equal:date_debut_intervention',
            'national' => 'nullable|boolean',
            // Validation des régions, départements et communes, selon la sélection de national
            'regions' => $request->has('national') && $request->national != 1 ? 'nullable|array' : 'nullable|array',
            'regions.*' => $request->has('national') && $request->national != 1 ? 'exists:regions,id' : 'nullable',
            'departements' => $request->has('national') && $request->national != 1 ? 'nullable|array' : 'nullable|array',
            'departements.*' => $request->has('national') && $request->national != 1 ? 'exists:departements,id' : 'nullable',
            'communes' => $request->has('national') && $request->national != 1 ? 'nullable|array' : 'nullable|array',
            'communes.*' => $request->has('national') && $request->national != 1 ? 'exists:communes,id' : 'nullable',
            // Autres règles de validation...
        ];
    
        // Validation des données
        $validatedData = $request->validate($validationRules);
    
        // Récupérer la structure associée
        $structure = Structure::where('id_user', Auth::id())->first();
        if (!$structure) {
            return redirect()->back()->with('error', 'Structure non trouvée.');
        }
    
        // Préparation des chemins de fichiers et autres traitements...
    
        return DB::transaction(function () use ($validatedData, $request, $candidature, $structure) {
            // Mise à jour de la candidature avec les autres champs...
            $candidature->update([
                // Mise à jour des autres champs de la candidature...
            ]);
    
            // Mise à jour de la table 'pays' pour la zone nationale
            if ($request->has('national') && $request->national == 1) {
                // Si national est coché, mettre à jour ou créer l'enregistrement avec la valeur 1
                Pays::updateOrCreate(
                    ['candidature_id' => $candidature->id],
                    ['national' => 1]
                );
            } else {
                // Si national n'est pas coché, supprimer l'enregistrement dans la table 'pays'
                Pays::where('candidature_id', $candidature->id)->delete();
            }
    
            // Traitement des relations en fonction de la valeur de 'national'
            if ($request->has('national') && $request->national == 1) {
                // Si national est coché, supprimer toutes les relations régionales
                DB::table('region_derouler')->where('id_candidature', $candidature->id)->delete();
                DB::table('dept_deroule')->where('id_candidature', $candidature->id)->delete();
                DB::table('commune_derouler')->where('id_candidature', $candidature->id)->delete();
            } else {
                // Si national n'est pas coché, traiter les régions, départements et communes
                $regionalRelations = [
                    'regions' => 'region_derouler',
                    'departements' => 'dept_deroule',
                    'communes' => 'commune_derouler',
                ];
    
                foreach ($regionalRelations as $key => $table) {
                    // Supprimer les anciennes relations
                    DB::table($table)->where('id_candidature', $candidature->id)->delete();
    
                    // Ajouter les nouvelles relations
                    if (isset($validatedData[$key]) && is_array($validatedData[$key])) {
                        foreach ($validatedData[$key] as $id) {
                            DB::table($table)->insert([
                                'id_candidature' => $candidature->id,
                                'id_' . rtrim($key, 's') => $id,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                }
            }
    
            // Traitement des autres relations (secteurs, cibles, etc.)...
    
            return redirect('/struct/candidater')->with('success', 'Votre dossier a été mis à jour avec succès.');
        });
    }
    
    
/**
 * Télécharger un fichier spécifique
 */
public function telechargerFichier($type, $filename)
{
    // Vérifier si l'utilisateur est connecté
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    
    Log::info("Tentative de téléchargement: Type=$type, Filename=$filename");
    
    // Vérifier si le type est valide
    if (!in_array($type, ['ninea', 'rapport', 'rccm', 'agrement', 'decret', 'quitus'])) {
        abort(404, 'Type de document non valide');
    }
    
    // Récupérer la structure de l'utilisateur connecté
    $structure = Structure::where('id_user', Auth::id())->first();
    
    if (!$structure) {
        abort(404, 'Structure non trouvée');
    }
    
    // Récupérer la candidature associée à cette structure
    $candidature = DossierCandidature::where('id_structure', $structure->id)->first();
    
    if (!$candidature) {
        abort(404, 'Candidature non trouvée');
    }
    
    // Déterminer le nom de champ correspondant au type
    $fieldMap = [
        'ninea' => 'fichier_ninea',
        'rapport' => 'rapport_activite',
        'rccm' => 'fichier_rccm',
        'agrement' => 'fichier_agrement',
        'decret' => 'decret_creation',
        'quitus' => 'quitus_fiscal'
    ];
    
    $field = $fieldMap[$type];
    $storedFilename = $candidature->$field;
    
    Log::info("Valeur stockée en base: $storedFilename");
    
    // Vérifier si le fichier demandé existe dans le dossier documents
  

    if (Storage::disk('public')->exists('documents/' . basename($filename))) {
        $path = storage_path('app/public/documents/' . basename($filename));
        return response()->download($path);
    }
    
    // Vérifier si le fichier stocké en base existe
   
    
    if (!empty($storedFilename)) {
        $filePath = storage_path('app/public/documents/' . basename($storedFilename));
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
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
            $filePath = storage_path('app/public/' . $file); // Chemin absolu du fichier
        
            if (file_exists($filePath)) {
                return response()->download($filePath);
            }
        }
    }
    
    // Si le fichier n'a pas été trouvé après toutes les vérifications
    abort(404, 'Le fichier demandé n\'a pas été trouvé sur le serveur.');
}

}
