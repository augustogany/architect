<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyectogeneral;
use App\Proyectourbanizacion;
use App\Deuda;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{
    public function proyectos_index(){
        return view('consultas.proyectos.general_index');
    }

    public function getProyectos()
    {
        $sucursales = auth()->user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }
        $udpersona = (auth()->user()->persona_id > 0) ? auth()->user()->persona_id : 0;
        return datatables()
            ->eloquent(Proyectogeneral::with('categoriageneral','persona')
            ->whereHas('persona', function (Builder $query) {
                if (!(auth()->user()->role == 'admin')) {
                    $query->where('id',auth()->user()->persona_id);
                }
                })
            ->where('estado','pendiente')
            ->whereIn('sucursal_id',$id_sucursales))
            ->toJson();
    }

    public function proyectosurbaniz_index(){
        return view('consultas.proyectos.urbanizacion_index');
    }

    public function getProyectosUrbanizacion()
    {
        $sucursales = auth()->user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }
        $udpersona = (auth()->user()->persona_id > 0) ? auth()->user()->persona_id : 0;
        
        return datatables()
            ->eloquent(Proyectourbanizacion::with('categoriaurbanizacion','persona')
            ->whereHas('persona', function (Builder $query) {
                if (!(auth()->user()->role == 'admin')) {
                    $query->where('id',auth()->user()->persona_id);
                }
                })
            ->where('estado','pendiente')
            ->whereIn('sucursal_id',$id_sucursales)
            ->orderBy('id','desc'))
            ->toJson();
    }

    public function deudas_index(){
        return view('consultas.deudas.index');
    }

    public function getdeuda()
    {
        $sucursales = auth()->user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        return datatables()->eloquent(Deuda::with('tipopago','persona')
            ->whereHas('persona', function (Builder $query) {
                if (!(auth()->user()->role == 'admin')) {
                    $query->where('id',auth()->user()->persona_id);
                }
            })
            ->where('montorestante','>',0)
            ->whereIn('sucursal_id',$id_sucursales))
            ->toJson();
            
    }
}
