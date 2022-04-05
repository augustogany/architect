<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $appends = ['fullName'];

    public function getFullNameAttribute(){
        return $this->nombre. ' ' . $this->apaterno . ' ' . $this->amaterno;
    }

    public function documentation()
    {
        return $this->hasOne(Documentation::class);
    }

    public function deudas()
    {
        return $this->hasMany(Deuda::class);
    }
    
}
