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
use App\personasPagosAnual;

class ConsultasController extends Controller
{
    public function proyectos_index(){
        return view('reportes.proyectos_index');
    }

    public function proyectos_list(Request $request){   
        $proyectos = [];
        $tipo = $request->tipo;
        if($tipo == 'general'){
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
        if ($request->type == 'pdf') {
            // return view('reportes.proyectos_pdf', compact('proyectos', 'tipo'));
            $pdf = \PDF::loadview('reportes.proyectos_pdf', compact('proyectos', 'tipo'));
            return $pdf->stream('Reporte de proyectos.pdf');
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
        if ($request->type == 'pdf') {
            // return view('reportes.ventas_pdf', compact('ventas'));
            $pdf = \PDF::loadview('reportes.ventas_pdf', compact('ventas'));
            return $pdf->stream('Reporte de ventas.pdf');
        }
        return view('reportes.ventas_list', compact('ventas'));
    }

    public function mensualidades_index(){
        return view('reportes.mensualidades_index');
    }

    public function mensualidades_list(Request $request){   
        $pagos = PersonasPago::where('persona_id', $request->persona_id)
                            // ->whereRaw($request->gestion_id ? 'gestion_id = '.$request->gestion_id : 1)
                            ->where('deleted_at', NULL)->get();
        if ($request->type == 'pdf') {
            // return view('reportes.mensualidades_pdf', compact('pagos'));
            $pdf = \PDF::loadview('reportes.mensualidades_pdf', compact('pagos'));
            return $pdf->stream('Reporte de mensualidades.pdf');
        }
        return view('reportes.mensualidades_list', compact('pagos'));
    }

    public function reporte_diario(){
        $ventas = VentaServicio::with(['persona:id,nombre,apaterno,amaterno'])
                            ->join('detalleventaservicios as dv', 'ventaservicios.id', '=', 'dv.ventaservicio_id')
                            ->join('servicios as s', 'dv.servicio_id', '=', 's.id')
                            ->whereDate('ventaservicios.fecharegistro', '=', date('Y-m-d'))
                            ->select('ventaservicios.id', 'dv.precio', 'dv.cantidad', 's.nombre as servicio',
                            'dv.descuento','ventaservicios.persona_id')
                            ->addSelect(DB::raw("'' as tipo"))
                            ->get();
        
        $proyectos_gnral = Proyectogeneral::with(['persona:id,nombre,apaterno,amaterno'])
                                ->whereRaw('date(fecharegistro) = CURDATE()')
                                ->where('deleted_at', NULL)
                                ->select('id', 'proyecto', 'costocategoria as costo','totalbs as total','persona_id');
        $proyectos = Proyectourbanizacion::with(['persona:id,nombre,apaterno,amaterno'])
                                ->whereRaw('date(fecharegistro) = CURDATE()')                        
                                ->where('deleted_at', NULL)
                                ->select('id', 'proyecto', 'costo_pu_categoria as costo','totalbs as total','persona_id')
                                ->union($proyectos_gnral)
                                ->get();
        $pagos_anual = personasPagosAnual::with([
                                        'persona:id,nombre,apaterno,amaterno',
                                        'gestion:id,gestion'
                                    ])
                                    ->whereRaw('date(fecha_pago) = CURDATE()')
                                    ->select('id', 'monto_descuento as descuento', 'persona_id', 'gestion_id', 'monto_pagado')
                                    ->addSelect(DB::raw("'NACIONAL' as tipo"))
                                    ->where('deleted_at', NULL)
                                    ->groupBy('persona_id') // Agrupar por el ID de la persona
                                    ->selectRaw('persona_id, COUNT(*) as cuotas, SUM(monto_pagado - monto_descuento) as monto')
                                    ->get();
        $pagos = PersonasPago::with([
                                'persona:id,nombre,apaterno,amaterno',
                                'mensualidades:id,personas_pago_id,monto_pagado'
                                ])
                                ->whereRaw('date(fecha_pago) = CURDATE()')
                                ->select('id','descuento','persona_id')
                                ->addSelect(DB::raw("'' as gestion_id, '' as monto,'DPTAL' as tipo"))
                                ->where('deleted_at', NULL)
                                ->get();
        $pdf = \PDF::loadview('reportes.ventageneral_pdf', compact('proyectos', 'ventas','pagos','pagos_anual'));
        return $pdf->stream('ReporteDiario.pdf');
        //return view('reportes.ventageneral_pdf', compact('proyectos', 'ventas','pagos','pagos_anual'));
    }
}
