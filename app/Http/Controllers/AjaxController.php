<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Departamento;
use App\Movimiento;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function get_departamentos( Request $request )
    {
        $departamentos = Departamento::select('id', 'numero')->with('movimientos')->withCount('movimientos');

        return DataTables::eloquent( $departamentos )
                        ->addColumn('deuda_actual', function ($departamento) {
                            return $departamento->get_deuda_actual();    
                        })
                        ->addColumn('cantidad_de_movimientos', function ($departamento) {
                            return $departamento->movimientos->count();
                        })
                        ->addColumn('action', function ($departamento) {
                            return '<a href="'.route('departamentos.show', ['dept_id' => $departamento->id]).'" class="btn btn-sm btn-info">Ver Detalle</a>';
                        })
                        ->orderColumn('cantidad_de_movimientos', function ($query, $order) {
                            $query->orderBy('movimientos_count', $order); // el metodo withCount() entrega por defecto "talleres_count".
                        })
                        ->setRowClass('font-weight-bold')
                        ->toJson();
    }

    public function get_movimientos( Request $request )
    {
        $columnas = ['id', 'codigo_identificador', 'monto', 'tipo', 'status', 'fecha_de_confirmacion', 'departamento_id', 'created_at'];
        $relaciones = ['departamento'];
        $movimientos = Movimiento::where('departamento_id', $request->get('departamento_id'))->select($columnas)->with($relaciones);

        return DataTables::eloquent( $movimientos )
                        ->addColumn('codigo', function ($movimiento) {
                            return $movimiento->codigo_identificador;
                        })
                        ->editColumn('monto', function ($movimiento) {
                            $obj['monto'] = number_format( $movimiento->monto, 0, ',', '.' );
                            $obj['tipo'] = $movimiento->tipo == 1 ? "Deuda" : "Pago";

                            return $obj;
                        })
                        ->editColumn('tipo', function ($movimiento) {
                            return $movimiento->tipo == 1 ? "Deuda" : "Pago";
                        })
                        ->editColumn('status', function ($movimiento) {
                            return $movimiento->status == 1 ? "Confirmado" : "Por Confirmar";
                        })
                        ->editColumn('fecha_de_confirmacion', function ($movimiento) {
                            return $movimiento->fecha_de_confirmacion ? Carbon::parse($movimiento->fecha_de_confirmacion)->format('d/m/Y') : "-";
                        })
                        ->addColumn('fecha_de_registro', function ($movimiento) {
                            return $movimiento->created_at ? Carbon::parse($movimiento->created_at)->format('d/m/Y') : "-";
                        })
                        ->addColumn('action', function ($departamento) {
                            return $departamento->id;
                        })
                        ->setRowClass('font-weight-bold')
                        ->toJson();
    }
}
