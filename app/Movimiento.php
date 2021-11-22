<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $dates = ['deleted_at'];
    
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at', 'pivot'
    ];

    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'departamento_id');
    }
}
