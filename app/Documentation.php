<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = ['id','curriculo','serv_militar','nit','persona_id'];

    public function archivo()
    {
        return $this->morphOne(Archivo::class, 'archivo');
    }

    protected function getCurriculoAttribute()
    {
        if ($this->archivo)
            return 'kardex/' .$this->archivo['url'];
        
        return asset('theme/dist/img/pdf.png');
    }
}
