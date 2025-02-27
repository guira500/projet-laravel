<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploiDeTemps;
use App\Models\User;
use App\Models\Module;
use App\Models\Salle;
use App\Models\Niveau;
use App\Models\Semestre;
use Illuminate\Support\Facades\DB;


class EmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::all();
        $semestres = Semestre::all();
        $modules = Module::all();
        $professeurs = User::all();
        $salles = Salle::all();

        //$emplois = EmploiDeTemps::orderBy('created_at', 'DESC')->get();

        $emplois = EmploiDeTemps::with(['module', 'professeur', 'salle', 'niveau'])
            ->orderBy('date')
            ->orderBy('heure_debut')
            ->get()
            //->groupBy('niveau.nom');
            ->groupBy(function ($item) {
                return $item->niveau->nom; // Groupement par nom du niveau
            });

        //dd($niveaux);

        return view('emploi.index', compact('emplois', 'niveaux', 'semestres', 'modules', 'professeurs', 'salles'));
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
        $request->validate([
            'niveau_id' => 'required|exists:niveaux,id',
            'semestre_id' => 'required|exists:semestres,id',
            'module_id' => 'required|exists:modules,id',
            'professeur_id' => 'required|exists:users,id',
            'salle_id' => 'required|exists:salles,id',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
        ]);
    
        EmploiDeTemps::create([
            'niveau_id' => $request->niveau_id,
            'semestre_id' => $request->semestre_id,
            'module_id' => $request->module_id,
            'professeur_id' => $request->professeur_id,
            'salle_id' => $request->salle_id,
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'validation_professeur' => 'en attente', // Le prof devra valider plus tard
            'publié' => false,
        ]);
    
        return redirect()->route('admin/emploi')->with('success', 'Emploi du temps créé avec succès.');
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

    public function envoyer(Request $request, Niveau $niveau)
    {
        // Logique de mise à jour de 'publié' à 2
        $emplois = EmploiDeTemps::where('niveau_id', $niveau->id)
            ->where('validation_professeur', 'en attente')
            ->get();
        //dd($emplois);
        foreach ($emplois as $emploi) {
        // Mise à jour du champ 'publié' à 2
            $emploi->envoyé = 1;
            $emploi->save();
        }

        return redirect()->route('admin/emploi')->with('success', 'Emploi du temps publié.');
    }

    public function publier($niveauId)
    {
        $niveau = Niveau::findOrFail($niveauId);

        // Récupérer les emplois du temps associés à ce niveau et dont la validation est 'valide'
        $emplois = DB::table('emploi_de_temps')
            ->where('niveau_id', $niveau->id)
            ->where('validation_professeur', 'valide')  // Récupérer uniquement les emplois validés
            ->get();

        // Vérifier si des emplois du temps validés existent
        if ($emplois->isNotEmpty()) {
            // Mettre à jour l'état 'publié' de chaque emploi du temps validé
            foreach ($emplois as $emploi) {
                DB::table('emploi_de_temps')
                    ->where('id', $emploi->id)
                    ->update(['publié' => true]);
            }

            return redirect()->back()->with('success', 'L\'emploi du temps a été publié.');
        } else {
            // Aucun emploi du temps validé à publier
            return redirect()->back()->with('error', 'Aucun emploi du temps validé à publier.');
        }
    }

    public function retirer($niveauId)
    {
        // Trouver le niveau
    $niveau = Niveau::findOrFail($niveauId);

    // Récupérer les emplois du temps associés au niveau et ayant le statut 'publié' à true
    $emplois = DB::table('emploi_de_temps')
        ->where('niveau_id', $niveau->id)  // Associer les emplois au niveau
        ->where('publié', true)  // Vérifier que le statut 'publié' est à true
        ->get();

    // Vérifier s'il y a des emplois publiés à retirer
    if ($emplois->isNotEmpty()) {
        // Mettre à jour tous les emplois du temps pour les marquer comme non publiés
        DB::table('emploi_de_temps')
            ->where('niveau_id', $niveau->id)  // Associer à ce niveau
            ->update(['publié' => false]);  // Retirer la publication de tous les emplois

        return redirect()->back()->with('success', 'L\'emploi du temps a été retiré de la publication.');
    } else {
        // Aucun emploi du temps publié pour ce niveau
        return redirect()->back()->with('error', 'Aucun emploi du temps publié à retirer.');
    }
    }

}
