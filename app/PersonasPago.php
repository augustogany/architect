<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonasPago extends Model
{
    protected $fillable = [
        'user_id',
        'sucursal_id',
        'persona_id',
        'fecha_pago',
        'descuento',
        'observacion'
    ];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function mensualidades(){
        return $this->hasMany(PersonasPagosMensualidades::class, 'personas_pago_id');
    }
}
