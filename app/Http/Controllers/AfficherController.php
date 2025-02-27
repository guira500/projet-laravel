<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\EmploiDeTemps;

class AfficherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::all();

        // Récupérer les emplois du temps classés par niveau
        $emplois = [];
        foreach ($niveaux as $niveau) {
            $emplois[$niveau->nom] = EmploiDeTemps::where('niveau_id', $niveau->id)
                ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
                ->get();
        }

        // Récupérer uniquement les emplois publiés
        $emploisPublies = [];
        foreach ($niveaux as $niveau) {
            $emploisPublies[$niveau->nom] = $emplois[$niveau->nom]->where('publié', true);
        }

        return view('affiches.afficher', compact('niveaux', 'emplois', 'emploisPublies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
