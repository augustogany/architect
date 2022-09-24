<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
	protected $fillable = ['user_id','nombre_completo','telefono','email','direccion','imagen','cv'];

	public function user(){
        return $this->belongsTo(User::class);
    }
}
