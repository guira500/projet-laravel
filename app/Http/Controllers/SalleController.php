<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salle = Salle::orderBy('created_at', 'DESC')->get();

        return view('salle.index', compact('salle'));
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create()
    {
        return view('salle.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Salle::create($request->all());

        return redirect()->route('admin/salle')->with('success', 'element ajouter avec succès');
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
