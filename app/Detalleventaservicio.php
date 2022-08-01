<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleventaservicio extends Model
{
    protected $fillable = [
        'ventaservicio_id',
        'servicio_id',
        'precio',
        'cantidad',
        'descuento',
        'observacion'
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function ventaservicio()
    {
    	return $this->belongsTo(Ventaservicio::class);
    }
}
