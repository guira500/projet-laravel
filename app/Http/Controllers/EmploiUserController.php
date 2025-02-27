<?php

namespace App\Http\Controllers;

use App\Models\EmploiDeTemps;
use Illuminate\Http\Request;

class EmploiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professeurId = auth()->user()->id;

        // Récupérer les emplois du temps du professeur avec les niveaux, et les modules associés
        $emplois = EmploiDeTemps::with(['module', 'professeur', 'salle', 'niveau'])
            ->where('professeur_id', $professeurId)
            ->where('envoyé', 1) // Seulement les emplois du temps publiés
            ->get()
            ->groupBy('niveau.id'); // Grouper par niveau

        return view('emplois.index', compact('emplois'));
   
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

    public function valider($id)
    {
        $seance = EmploiDeTemps::findOrFail($id);
        $seance->update(['validation_professeur' => 'valide']);

        return back()->with('success', 'Séance validée avec succès !');
    }

    public function refuser($id)
    {
        $seance = EmploiDeTemps::findOrFail($id);
        $seance->update(['validation_professeur' => 'refuse']);

        return back()->with('error', 'Séance refusée.');
    }

    public function soumettre($niveau)
    {
        $emplois = EmploiDeTemps::where('niveau_id', $niveau)->get();

        // Vérifier que toutes les séances sont validées ou refusées
        if ($emplois->every(fn($seance) => $seance->validation_professeur !== 'en attente')) {
            $emplois->each->update(['soumis' => true]);

            return back()->with('success', 'Emploi du temps soumis à l\'administrateur.');
        }

        return back()->with('error', 'Toutes les séances doivent être validées ou refusées avant soumission.');
    }

}
