<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventaservicio extends Model
{
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function detalleventaservicios()
    {
        return $this->hasMany(Detalleventaservicio::class);
    }
}
