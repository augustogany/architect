<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalledeuda extends Model
{
    protected $fillable = [
        'deuda_id','mese_id','preciomes','observacioncuota','fechapagomes', 
        'totalbs','clientIP','clientIP_update'    
    ];
    public function mes()
    {
        return $this->belongsTo(Meses::class,'mese_id');
    }
}
