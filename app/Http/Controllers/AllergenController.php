<?php

namespace App\Http\Controllers;

use App\Models\Allergen;
use Illuminate\Http\Request;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allergens = Allergen::all();
        return view('allergen.index', ["allergens" => $allergens]);
    }
    public function create()
    {
        return view('allergen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $allergen = Allergen::create($request->all());
        return redirect('allergen', ["allergen" => $allergen]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Allergen $allergen)
    {
        return view('allergen.show', ["allergen" => $allergen]);
    }
    // public function show(Allergen $allergen)
    // {
    //     $allergen = Allergen::find($id);
    //     return view('allergen.show', ["allergen" => $allergen]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Allergen $allergen)
    {
        return view('allergen.edit', ["allergen" => $allergen]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Allergen $allergen)
    {
        $allergen->update($request->all());
        return redirect('allergen');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allergen $allergen)
    {
        $allergen->delete();
        return redirect('allergen');
    }
}
