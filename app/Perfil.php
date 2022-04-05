<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
	protected $fillable = ['user_id','nombre','apaterno','amaterno','ci','telefono','direccion'];

	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expedicion()
    {
        return $this->belongsTo(Expedicion::class);
    }
}
