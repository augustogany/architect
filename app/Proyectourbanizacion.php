<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectourbanizacion extends Model
{
    protected $fillable = [
        'user_id',
        'sucursal_id',
        'persona_id',
        'categoriaurbanizacion_id',
        'arancelcategoria',
        'costo_pu_categoria',
        'porcentaje_cab_categoria',
        'visado_sus_categoria',
        'visado_bs_categoria',
        'proyecto',
        'propietario',
        'superficiemts2',
        'totalbs',
        'descuento',
        'fecharegistro',
        'archivo',
        'condicion',
        'estado'
    ];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
    
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

    public function persona_pago(){
        return $this->hasOne(PersonasPago::class, 'proyectourbanizacion_id');
    }
}
