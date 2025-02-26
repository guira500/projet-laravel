<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Semestre;
use App\Models\User;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $module = Module::orderBy('created_at', 'DESC')->get();
        $semestres = Semestre::all();
        $professeurs = User::all();

        //dd($module);

        return view('modules.index', compact('module', 'semestres', 'professeurs'));
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
        //dd($request->all());

        $request->validate([
            'code' => 'required|string',
            'nom' => 'required|string',
            'coefficient' => 'required|integer',
            'semestre_id' => 'required|exists:semestres,id',
            'professeur_id' => 'required|exists:users,id',
        ]);
    
        Module::create([
            'code' => $request->code,
            'nom' => $request->nom,
            'coefficient' => $request->coefficient,
            'semestre_id' => $request->semestre_id,
            'professeur_id' => $request->professeur_id
        ]);

        return redirect()->route('admin/module')->with('success', 'element ajouter avec succès');
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
