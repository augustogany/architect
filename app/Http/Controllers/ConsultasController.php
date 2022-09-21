<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

// Modelos
use App\Proyectogeneral;
use App\Proyectourbanizacion;
use App\Ventaservicio;
use App\PersonasPago;

class ConsultasController extends Controller
{
    public function proyectos_index(){
        return view('reportes.proyectos_index');
    }

    public function proyectos_list(Request $request){   
        $proyectos = [];
        $tipo = $request->tipo;
        if($request->tipo == 'general'){
            $proyectos = Proyectogeneral::whereRaw($request->persona_id ? 'persona_id = '.$request->persona_id : 1)
                            ->whereRaw($request->inicio ? 'date(fecharegistro) >= "'.$request->inicio.'"' : 1)
                            ->whereRaw($request->fin ? 'date(fecharegistro) <= "'.$request->fin.'"' : 1)
                            ->where('deleted_at', NULL)->get();
        }else{
            $proyectos = Proyectourbanizacion::whereRaw($request->persona_id ? 'persona_id = '.$request->persona_id : 1)
                            ->whereRaw($request->inicio ? 'date(fecharegistro) >= "'.$request->inicio.'"' : 1)
                            ->whereRaw($request->fin ? 'date(fecharegistro) <= "'.$request->fin.'"' : 1)
                            ->where('deleted_at', NULL)->get();
        }
        return view('reportes.proyectos_list', compact('proyectos', 'tipo'));
    }

    public function ventas_index(){
        return view('reportes.ventas_index');
    }

    public function ventas_list(Request $request){   
        $ventas = Ventaservicio::whereRaw($request->persona_id ? 'persona_id = '.$request->persona_id : 1)
                    ->whereRaw($request->inicio ? 'date(fecharegistro) >= "'.$request->inicio.'"' : 1)
                    ->whereRaw($request->fin ? 'date(fecharegistro) <= "'.$request->fin.'"' : 1)
                    ->where('deleted_at', NULL)->get();
        return view('reportes.ventas_list', compact('ventas'));
    }

    public function mensualidades_index(){
        return view('reportes.mensualidades_index');
    }

    public function mensualidades_list(Request $request){   
        $pagos = PersonasPago::where('persona_id', $request->persona_id)
                            // ->whereRaw($request->gestion_id ? 'gestion_id = '.$request->gestion_id : 1)
                            ->where('deleted_at', NULL)->get();
        return view('reportes.mensualidades_list', compact('pagos'));
    }
}
