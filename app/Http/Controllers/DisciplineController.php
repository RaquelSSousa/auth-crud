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
    public function index()
    {
        return Inertia::render('disciplines', [
            'disciplines' => Discipline::all(),
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
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome não pode ter mais de 40 caracteres.',
            'code.required' => 'O campo código é obrigatório.',
            'code.max' => 'O campo código não pode ter mais de 30 caracteres.',
            'code.unique' => 'O código informado já está em uso.',
            'ch.required' => 'O campo carga horária é obrigatório.',
            'ch.integer' => 'O campo carga horária deve ser um número inteiro.',
            'ch.min' => 'A carga horária mínima é de 1000 horas.',
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
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome não pode ter mais de 40 caracteres.',
            'code.required' => 'O campo código é obrigatório.',
            'code.max' => 'O campo código não pode ter mais de 30 caracteres.',
            'code.unique' => 'O código informado já está em uso.',
            'ch.required' => 'O campo carga horária é obrigatório.',
            'ch.integer' => 'O campo carga horária deve ser um número inteiro.',
            'ch.min' => 'A carga horária mínima é de 1000 horas.',
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
