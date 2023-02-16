<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class personasPagosAnual extends Model
{
    protected $table = 'personas_pagos_anuales';
    protected $fillable = [
        'user_id', 'sucursal_id', 'persona_id', 'gestion_id', 'fecha_pago', 'monto_pagado', 'monto_descuento', 'observacion'
    ];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function gestion(){
        return $this->belongsTo(Gestion::class, 'gestion_id');
    }

    public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
