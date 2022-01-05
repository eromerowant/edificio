<?php

namespace App\Imports;

use App\Movimiento;
use Maatwebsite\Excel\Concerns\ToModel;

use App\Departamento;

class MovimientoImport implements ToModel
{
    public function model(array $row)
    {
        $dept = Departamento::where('numero', $row[0])->first();

        return new Movimiento([
            "monto"           => $row[1],
            "tipo"            => 1, // 1 Deuda. 2 Pago.
            "status"          => 2, // 1 confirmado. 2 por confirmar.
            "departamento_id" => $dept->id ?? null,
            "created_at"      => $row[2],
        ]);
    }
}
