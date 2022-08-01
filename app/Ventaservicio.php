<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventaservicio extends Model
{

    protected $fillable = [
        'user_id',
        'sucursal_id',
        'persona_id',
        'fecharegistro',
        'observacion',
        'estado'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function detalle()
    {
        return $this->hasMany(Detalleventaservicio::class);
    }

    public function persona_pago(){
        return $this->hasOne(PersonasPago::class, 'ventaservicio_id');
    }
}
