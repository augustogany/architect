<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopago extends Model
{
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
