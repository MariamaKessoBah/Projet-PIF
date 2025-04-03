<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Structure; // Assurez-vous d'importer le modèle
use Illuminate\Support\Facades\Auth;


class StructController extends Controller
{
     // La page/vue dashboard.blade.php
     public function index(){
        return view('struct.dashboard');
    }

     // La page/vue dashboard.blade.php
     public function index1(){
        return view('struct.candidater');
    }


    public function store(Request $request)
{
    // Valider les données soumises
    $validatedData = $request->validate([
        'nom_structure' => 'required|string|max:255',
        'siege_social' => 'required|string|max:255',
        'date_creation' => 'required|date',
        'tel_structure' => 'required|string|max:20',
        'ninea_entreprise' => 'nullable|string|max:255',
        'registre_commerce' => 'nullable|string|max:255',
        'agreement' => 'nullable|string|max:255',
        'numdecret' => 'nullable|string|max:255',
        'nbre_membre' => 'required|integer|min:1',
        'nom_contact' => 'required|string|max:255',
        'prenom_contact' => 'required|string|max:255',
        'fonction_contact' => 'required|string|max:255',
        'tel_contact' => 'required|string|max:20',
        'email_contact' => 'required|email|max:255',
    ]);

    // Ajouter l'ID de l'utilisateur connecté
    $validatedData['id_user'] = Auth::id();

    // Créer un nouvel enregistrement dans la base de données
    Structure::create($validatedData);

    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'Informations enregistrées avec succès.');
}
}
