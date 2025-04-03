<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
          // La page/vue dashboard.blade.php
   public function index(){
    return view('admin.administrateur');
    }

    public function user(){
        return view('admin.listeUser');
        }

    public function editer(){
        return view('admin.editUser');
        }
    
    public function critere(){
        return view('admin.critereAdmin');
        }
}
