<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalledeuda extends Model
{
    public function mes()
    {
        return $this->belongsTo(Meses::class,'mese_id');
    }
}
