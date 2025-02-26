<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use App\Models\Salle;
use App\Models\Niveau;

class HomeController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $modules = $user->modules;

        return view('home', compact('modules'));
    }

    public function adminHome()
    {
        $user = auth()->user();

        $salle = Salle::all();
        $niveau = Niveau::all();
        $us = User::all();
        
        // Récupérer tous les modules, incluant leur semestre
        $modules = Module::with('semestre') // Charger la relation semestre
            ->get()
            ->groupBy(function($module) {
                // Grouper par niveau
                return $module->niveau; // Exemple : "niveau 1", "niveau 2", etc.
            });

        return view('bureau', compact('modules', 'salle', 'niveau', 'us'));
    }
}
