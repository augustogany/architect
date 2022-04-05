<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    public function tipopago()
    {
        return $this->belongsTo(Tipopago::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
    
    public function detalledeudas()
    {
        return $this->hasMany(Detalledeuda::class);
    }

}
