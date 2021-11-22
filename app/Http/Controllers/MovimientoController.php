<?php

namespace App\Http\Controllers;

use App\Movimiento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store( Request $request )
    {
        Validator::make($request->all(), [
            'monto'                 => 'required',
            'tipo'                  => 'required|integer',
            'codigo_identificador'  => 'nullable|string',
            'created_at'            => 'nullable|date_format:Y-m-d',
            'status'                => 'nullable|integer',
            'fecha_de_confirmacion' => 'nullable|date_format:Y-m-d',
            'dept_id'               => 'required|integer|exists_soft:departamentos,id',
        ])->validate();

        $movimiento = new Movimiento();
        $movimiento->monto = $request->get('monto');
        $movimiento->tipo = $request->get('tipo');
        $movimiento->departamento_id = $request->get('dept_id');

        if ( $request->get('codigo_identificador') ) {
            $movimiento->codigo_identificador = $request->get('codigo_identificador');
        }
        if ( $request->get('created_at') ) {
            $movimiento->created_at = $request->get('created_at');
        }
        if ( $request->get('status') ) {
            $movimiento->status = $request->get('status');
        }
        if ( $request->get('fecha_de_confirmacion') ) {
            $movimiento->fecha_de_confirmacion = $request->get('fecha_de_confirmacion');
        }
        $movimiento->save();

        return redirect()->back()->with('success', "Nuevo movimiento {$movimiento->numero} se agregó correctamente.");
    }

    public function show(Movimiento $movimiento)
    {
        //
    }

    public function edit(Movimiento $movimiento)
    {
        //
    }

    public function update(Request $request, Movimiento $movimiento)
    {
        //
    }

    public function delete( Request $request )
    {
        Validator::make($request->all(), [
            'movimiento_id' => 'required|integer|exists_soft:movimientos,id',
        ])->validate();

        $movimiento = Movimiento::where('id', $request->get('movimiento_id'))->first();
        $movimiento->delete();

        return redirect()->back()->with('success', "El movimiento con id {$request->get('movimiento_id')} se eliminó correctamente.");
    }

    public function destroy(Movimiento $movimiento)
    {
        //
    }
}
