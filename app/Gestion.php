<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    protected $table = 'gestiones';
    protected $fillable = [
        'user_id',
        'sucursal_id',
        'gestion',
        'mensualidad',
        'observacion'
    ];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
}
