<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectogeneral extends Model
{

    protected $fillable = [
        'user_id',
        'sucursal_id',
        'persona_id',
        'categoriageneral_id',
        'costocategoria',
        'proyecto',
        'propietario',
        'superficiemts2',
        'totalbs',
        'descuento',
        'fecharegistro',
        'archivo',
        'condicion',
        'condicion_aux',
        'estado'
    ];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function categoriageneral()
    {
        return $this->belongsTo(Categoriageneral::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function getGetArchivoAttribute()
    {
    	if($this->archivo)
    		return url("storage/$this->archivo");
    }

    public function persona_pago(){
        return $this->hasOne(PersonasPago::class, 'proyectogeneral_id');
    }
}
