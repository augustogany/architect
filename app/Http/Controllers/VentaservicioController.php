<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Ventaservicio;
use App\Servicio;
use App\Detalleventaservicio;
use App\Sucursal;
use Carbon\Carbon;
use DB;

class VentaservicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ventaservicio.index');
    }

    public function getventaservicio()
    {
        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        return datatables()->eloquent(Ventaservicio::with('persona','detalleventaservicios')
            ->whereIn('sucursal_id',$id_sucursales))
            ->addColumn('btn_actions', 'ventaservicio.partials.btn_actions')
            // ->addColumn('btn_actions', function($row)
            // {
            //     if ($row->estado != "DESHABILITADO") 
            //     {
            //         if(auth()->user()->hasPermissionTo('ventaservicio.destroy')){ return '<a data-target="#modal-delete'.$row->id.'" data-toggle="modal" title="Anular Venta" type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>';
            //         }else{
            //             return '';
            //         }
            //     }
            // })
            ->rawColumns(['btn_actions'])
            ->toJson();
    }

    public function pdfdetalleventa($id)
    {
        $ventaservicios = Ventaservicio::with('persona','detalleventaservicios.servicio','sucursal')->findOrFail($id);
        //return $ventaservicios;

        $pdf = \PDF::loadview('pdf.comprobanteventa',compact('ventaservicios'));
        return $pdf->stream('COMPROBANTE DE VENTA.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        $personas = Persona::orderBy('nombre', 'asc')->where('condicion','=',1)->get();
        $servicios = Servicio::where('estado','=','ACTIVO')->get();

        //return $servicios;

        //$meses = Meses::all();


        return view('ventaservicio.create',compact('sucursales', 'personas','servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $totalventa = array_sum($request->totalbs);

         //captura el año - gestion
        $date = Carbon::now();
        $gestion = $date->format('Y');

        //capyura ip del usuario
        $clientIP =\Request::ip ();

        try{
            DB::beginTransaction();
            //registra datos de la tabla ventaservicio
            $ventaservicio = new Ventaservicio;
            $ventaservicio->user_id = Auth::user()->id;
            $ventaservicio->sucursal_id = $request->sucursal_id;
            $ventaservicio->persona_id = $request->persona_id_input;
            $ventaservicio->fecharegistro = $request->fecharegistro;
            $ventaservicio->gestion = $gestion;
            $ventaservicio->clientIP = $clientIP;
            $ventaservicio->totalbs = $totalventa;
            $ventaservicio->observacion = $request->observacion;
            $ventaservicio->save();

            //registra datos de la tabla detalleventaservicio
            $cont = 0;
            while ($cont < count($request->servicio_id)) {
                $detalleventaservicio = new Detalleventaservicio;
                $detalleventaservicio->ventaservicio_id = $ventaservicio->id;
                $detalleventaservicio->servicio_id = $request->servicio_id[$cont];
                $detalleventaservicio->precioservicio = $request->precioservicio[$cont];
                $detalleventaservicio->cantidad = $request->cantidad[$cont];
                $detalleventaservicio->observacionventa = $request->observacionventa[$cont];
                $detalleventaservicio->fechapagoservicio = $request->fechapagoservicio[$cont];
                $detalleventaservicio->totalbs = $request->totalbs[$cont];
                $detalleventaservicio->save();
                $cont++;
            }

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        toast('Registro insertado con éxito!','success');
        return redirect()->route('ventaservicio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);

        
        try{
            DB::beginTransaction();

            $ventaservicio = Ventaservicio::findOrFail($id);
            $ventaservicio->estado = 'DESHABILITADO';
            $ventaservicio->update();

            //Elimina detalleventaservicio.
            //$detalleventaservicio = Detalleventaservicio::where('ventaservicio_id',$ventaservicio->id)->delete();

            //Elimina ventaservicio.
            //$ventaservicio->delete();

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        toast('Venta de Servicio Anulado!','warning');
        return redirect()->route('ventaservicio.index');
    }

    public function ventaservicio_rangofecha_report(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $ventaservicios = Ventaservicio::with('detalleventaservicios.servicio','persona')
            ->where('sucursal_id',$sucursal_id)
            ->where('estado', '=', 'ACTIVO')
            ->orderBy(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")','asc'))
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $totalventas = DB::table('detalleventaservicios as detventa')
            ->join('ventaservicios','ventaservicios.id','=','detventa.ventaservicio_id')
            ->select(DB::raw('sum(detventa.totalbs) as sumaTotal'))
            ->where('ventaservicios.sucursal_id',$sucursal_id)
            ->where('estado', '=', 'ACTIVO')
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $sucursal = Sucursal::find($sucursal_id);
        
         $pdf = \PDF::loadview('pdf.ventaservicio_rangofecha', compact('ventaservicios','sucursal','totalventas'));
        return $pdf->stream('VENTA DE SERVICIOS - '.date('d-m-Y').'.pdf');
    }
}
