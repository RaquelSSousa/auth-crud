<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discipline;
use Inertia\Inertia;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        return Inertia::render('Disciplines/Index', [
            'disciplines' => Discipline::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'code' => 'required|string|max:30|unique:disciplines,code',
            'ch' => 'required|integer|min:1000',
            'active' => 'boolean',
        ]);

        Discipline::create($request->all());

        return redirect()->route('disciplines.index')->with('success', 'Disciplina criada com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discipline $discipline)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'code' => 'required|string|max:30|unique:disciplines,code,' . $discipline->id,
            'ch' => 'required|integer|min:1000',
            'active' => 'boolean',
        ]);

        $discipline->update($request->all());

        return redirect()->route('disciplines.index')->with('success', 'Disciplina atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discipline $discipline)
    {
        $discipline->delete();

        return redirect()->route('disciplines.index')->with('success', 'Disciplina deletada com sucesso.');
    }
}
