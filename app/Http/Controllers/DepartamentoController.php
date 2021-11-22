<?php

namespace App\Http\Controllers;

use App\Departamento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return view('departamentos.index', [
            'departamentos' => $departamentos
        ]);
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'numero' => 'required|integer|unique:departamentos,numero',
        ])->validate(); // Este metodo validate() hace la redirección junto con los mensajes de error.

        $departamento = new Departamento();
        $departamento->numero = $request->get('numero');
        $departamento->save();

        return redirect()->back()->with('success', "Nuevo departamento {$departamento->numero} se agregó correctamente.");
    }

    public function show(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|integer|exists:departamentos,id',
        ])->validate(); // Este metodo validate() hace la redirección junto con los mensajes de error.

        $departamento = Departamento::where('id', $request->get('id'))->first();
        return view('departamentos.show', ['departamento' => $departamento]);
    }

    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        //
    }
}
