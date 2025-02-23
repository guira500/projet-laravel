<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elements = Element::orderBy('created_at', 'DESC')->get();

        return view('elements.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('elements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Element::create($request->all());

        return redirect()->route('admin/elements')->with('success', 'element ajouter avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $elements = Element::findOrFail($id);

        return view('elements.show', compact('elements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $elements = Element::findOrFail($id);

        return view('elements.edit', compact('elements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $elements = Element::findOrFail($id);

        $elements->update($request->all());

        return redirect()->route('admin/elements')->with('success', 'element mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $elements = Element::findOrFail($id);

        $elements->delete();

        return redirect()->route('admin/elements')->with('success', 'element supprimer avec succès');
    }
}
