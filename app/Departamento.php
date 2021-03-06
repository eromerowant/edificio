<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'pivot', 'deleted_at', 'created_at', 'updated_at'
    ];

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento', 'departamento_id');
    }

    public function get_deuda_actual()
    {
        if ( count($this->movimientos) > 0 ) {
            $deuda_actual = 0;
            foreach ($this->movimientos as $movimiento) {
                if ( $movimiento->status == 1 ) { // movimiento confirmado
                    if ( $movimiento->tipo == 1 ) { // deuda
                        $deuda_actual -= $movimiento->monto;
                    } elseif ( $movimiento->tipo == 2 ) { // Pago
                        $deuda_actual += $movimiento->monto;
                    }
                }
            }
            return number_format( $deuda_actual, 0, ',', '.' );    
        } else {
            return 0;
        }    
    }
}
