<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectourbanizacion extends Model
{
    public function categoriaurbanizacion()
    {
        return $this->belongsTo(Categoriaurbanizacion::class);
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

    protected function getVisadoSusCategoriaAttribute($value)
    {
        return number_format($value,2,",",".");
    }

    protected function getVisadoBsCategoriaAttribute($value)
    {
        return number_format($value,2,",",".");
    }
}
