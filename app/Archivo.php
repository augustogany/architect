<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $fillable = ['name','url','archivo_id','archivo_type'];
    public function archivo()
    {
        return $this->morphTo();
    }
}
