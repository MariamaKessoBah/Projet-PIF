<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends Controller
{
     // La page/vue dashboard.blade.php
     public function home(){
        return view('apropos');
    }

    // La page/vue dashboard.blade.php
    public function accueil(){
        return view('accueil');
    }

    // La page/vue dashboard.blade.php
    public function doc(){
        return view('docCandidature');
    }



}
