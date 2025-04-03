<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluatorController extends Controller
{
       // La page/vue dashboard.blade.php
   public function doc1(){
    return view('evaluator.evalue');
}

       // La page/vue dashboard.blade.php
       public function index1(){
        return view('evaluator.critereEvaluation');
    }

      // La page/vue dashboard.blade.php
      public function index(){
        return view('evaluator.listeCandidat');
    }
    public function index2(){
        return view('evaluator.laureat');
        }
}
