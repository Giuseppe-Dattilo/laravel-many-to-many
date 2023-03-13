<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::paginate(10);
       return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();

        return view('admin.technologies.create',compact('technology')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|unique:technologies',
            'color' => 'nullable|string|',
          
        ], [
            'label.required' => 'La tecnologia deve avere un label',
            'label.unique' => 'Esiste già una tecnologia con questo nome',
            'color.max' => 'Il nome del colore è troppo lungo',    
        ]);
        
        $data = $request->all();
        $technology = new Technology();
        $technology->fill($data);
        $technology->save();

        return to_route('admin.technologies.index')->with('type', 'success')->with('msg','Nuova Tecnologia creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.index', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'label' => ['required', 'string', Rule::unique('technologies')->ignore($technology->id)],
            'color' => 'nullable|string|',
          
        ], [
            'label.required' => 'La tecnologia deve avere un label',
            'label.unique' => 'Esiste già una tecnologia con questo nome',
            'color.max' => 'Il nome del colore è troppo lungo',    
        ]);

        $data = $request->all();
        $technology = new Technology();
        $technology->fill($data);
        $technology->save();

        return to_route('admin.technologies.index')->with('type', 'success')->with('msg','Nuovo Tecnologia creata con successo!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('type', 'success')->with('msg', "Teconologia '$technology->label' cancellata con successo");
    }
}
