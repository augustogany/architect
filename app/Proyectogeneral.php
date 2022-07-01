<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectogeneral extends Model
{
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
}
