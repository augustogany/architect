<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    
    public function archivo()
    {
        return $this->morphOne(Archivo::class, 'archivo');
    }
}
