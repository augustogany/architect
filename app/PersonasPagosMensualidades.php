<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonasPagosMensualidades extends Model
{
    protected $fillable = [
        'personas_pago_id',
        'gestion_id',
        'mes',
        'monto_pagado',
        'monto_descuento'
    ];

    public function pago(){
        return $this->belongsTo(PersonasPago::class, 'personas_pago_id');
    }

    public function gestion(){
        return $this->belongsTo(Gestion::class, 'gestion_id');
    }
}
