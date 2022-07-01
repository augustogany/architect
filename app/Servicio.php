<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    public function detalleventaservicios()
    {
        return $this->hasMany(Detalleventaservicio::class);
    }
}
