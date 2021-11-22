<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use App\Departamento;

class AjaxController extends Controller
{
    public function get_departamentos( Request $request )
    {
        $departamentos = Departamento::select('id', 'numero')->with('movimientos')->withCount('movimientos');

        return DataTables::eloquent( $departamentos )
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
}
