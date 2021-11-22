<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $dates = ['deleted_at'];
    
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at', 'pivot'
    ];

    protected $casts = [
        'fecha_de_confirmacion' => 'datetime:Y-m-d H:i:s',
    ];

    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'departamento_id');
    }
}
