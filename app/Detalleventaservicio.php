<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleventaservicio extends Model
{
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function ventaservicio()
    {
    	return $this->belongsTo(Ventaservicio::class);
    }
}
