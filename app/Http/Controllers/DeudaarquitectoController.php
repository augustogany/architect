<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Tipopago;
use App\Deuda;
use App\Meses;
use App\Detalledeuda;
use Carbon\Carbon;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use DB;

class DeudaarquitectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('deudaarquitecto.index');
    }

    public function getdeuda()
    {
        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        return datatables()->eloquent(Deuda::with('tipopago','persona','detalledeudas')
            ->whereIn('sucursal_id',$id_sucursales))
            ->addColumn('detalledeudas', function($row){
                return $row->detalledeudas()->sum('totalbs');
            })
            ->addColumn('btn_edit', function($row)
            {
                if ($row->montodeuda != $row->detalledeudas()->sum('totalbs') + $row->desc_total) 
                {
                    if(auth()->user()->hasPermissionTo('deudapersona.edit')){ return '<a href="'.route('deudaarquitectos.edit', $row->id).'" title="Editar deuda" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>';
                    }else{
                        return '';
                    }
                }
            })
            ->addColumn('btn_pdfdetalledeuda', function($row)
            {
                return '<a href="'.route('pdfdetalledeuda', $row->id).'" title="Imprimir Detalle de Pago" target="_blank" class="btn btn-outline-success"><i class="fas fa-print"></i></a>';
            })
            ->addColumn('btn_add_payment', function($row)
            {
                if (!$row->cuotas > 0 && $row->montodeuda != $row->detalledeudas()->sum('totalbs')) {
                    return '<a data-target="#modal-addpayment" data-pagoid='.$row->id.' data-toggle="modal" title="Agregar pago atrasado." type="button" class="btn btn-outline-success"><i class="fas fa-clipboard"></i></a>';
                }
                
            })
            ->rawColumns(['btn_edit','btn_pdfdetalledeuda','btn_add_payment'])
            ->toJson();
            
    }

    public function pdfdetalledeuda($id)
    {
        $deudas = Deuda::with('tipopago','persona','detalledeudas.mes','sucursal')->findOrFail($id);

        $pdf = \PDF::loadview('pdf.comprobantepago',compact('deudas'));
        return $pdf->stream('COMPROBANTE DE PAGO.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$isEdit = auth()->user()->hasPermissionTo('deudapersona.edit');
        //dd($isEdit);

        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        $personas = Persona::orderBy('nombre', 'asc')->where('condicion','=',1)->get();
        $tipopagos = Tipopago::where('condicion_aux','=',1)->get();
        $meses = Meses::all();


        return view('deudaarquitecto.create',compact('sucursales', 'personas','tipopagos','meses'));
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

        //Cuotas restantes
        $cuotas = $request->cuotas;
        $cantidad_cuotaspagadas = $request->meses_id ? count($request->meses_id) : 0;
        $operacion_cuotas = $cuotas - $cantidad_cuotaspagadas;

        //sum parcial de deuda
        $monto_parcialPagado = $request->totalbs ? array_sum($request->totalbs) : 0;

        //Monto restante de la deuda
        $montodeuda = $request->montodeuda;
        $operacion_montorestante = $montodeuda - $monto_parcialPagado;

        //captura el año - gestion
        $date = Carbon::now();
        $gestion = $date->format('Y');

        //capyura ip del usuario
        $clientIP =\Request::ip ();

        try{
            DB::beginTransaction();
            //registra datos de la tabla deudas
            $deuda = new Deuda;
            $deuda->user_id = Auth::user()->id;
            $deuda->sucursal_id = $request->sucursal_id;
            $deuda->persona_id = $request->persona_id_input;
            $deuda->tipopago_id = $request->tipopago_id_input;
            $deuda->montodeuda = $request->montodeuda;
            $deuda->fecharegistro = $request->fecharegistro;
            $deuda->cuotas = $request->cuotas;
            $deuda->observacion = $request->observacion;
            $deuda->clientIP = $clientIP;
            $deuda->gestion = $gestion;
            $deuda->cuotaspagadas = $cantidad_cuotaspagadas;
            $deuda->cuotasrestantes = $operacion_cuotas;
            $deuda->montopagado = $monto_parcialPagado;
            $deuda->montorestante = $operacion_montorestante;
            $deuda->desc_porcent = $request->descuentoporcentaje;
            $deuda->desc_total = $request->descuentobs;
            $deuda->save();

            //registra datos de la tabla detalledeudas
            $cont = 0;
            if ($request->meses_id) {
                while ($cont < count($request->meses_id)) {
                    $detalledeuda = new Detalledeuda;
                    $detalledeuda->deuda_id = $deuda->id;
                    $detalledeuda->mese_id = $request->meses_id[$cont];
                    $detalledeuda->preciomes = $request->preciomes[$cont];
                    $detalledeuda->observacioncuota = $request->observacioncuota[$cont];
                    $detalledeuda->fechapagomes = $request->fechapagomes[$cont];
                    $detalledeuda->totalbs = $request->totalbs[$cont];
                    $detalledeuda->clientIP = $clientIP;
                    $detalledeuda->clientIP_update = $clientIP;             
                    $detalledeuda->save();
                    $cont++;
                }
            }

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        toast('Registro insertado con éxito!','success');
        return redirect()->route('deudaarquitectos.index');

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
        //dd($id);
         $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        $deudas = Deuda::with('tipopago','persona','sucursal','detalledeudas.mes')->findOrFail($id);

        //return $deudas;

        $personas = Persona::orderBy('nombre', 'asc')->where('condicion','=',1)->get();
        $tipopagos = Tipopago::all();
        $meses = Meses::all();


        return view('deudaarquitecto.edit',compact('deudas','sucursales', 'personas','tipopagos','meses'));
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
        //dd($request);
        //total de cuotas
        $total_cuotas = $request->total_cuotas;

        //count cuotas
        $cantidad_cuotaspagadas = count($request->meses_id);

        $operacion_cuotas = $total_cuotas - $cantidad_cuotaspagadas;
        //dd($operacion_cuotas);

        //sum parcial de deuda
        $monto_parcialPagado = array_sum($request->totalbs);


         //Cuotas restantes
        //$cuotas = $request->cuotas;
        //$cantidad_cuotaspagadas = count($request->meses_id);
        //$operacion_cuotas = $cuotas - $cantidad_cuotaspagadas;

        //sum parcial de deuda
        //$monto_parcialPagado = array_sum($request->totalbs);

        //Monto restante de la deuda
        $montodeuda = $request->montodeuda;
        $operacion_montorestante = $montodeuda - $monto_parcialPagado;


        //capyura ip del usuario
        $clientIP =\Request::ip ();

        try{
            DB::beginTransaction();

            $deuda = Deuda::findOrFail($id);
            $deuda->cuotaspagadas = $cantidad_cuotaspagadas;
            $deuda->montopagado = $monto_parcialPagado;
            $deuda->cuotasrestantes = $operacion_cuotas;
            $deuda->montorestante = $operacion_montorestante;
            $deuda->update();

            //registra datos de la tabla deudas
            $deuda->detalledeudas()->delete();

            //registra datos de la tabla detalledeudas
            $cont = 0;
            while ($cont < count($request->meses_id)) {
                $detalledeuda = new Detalledeuda;
                //$detalledeuda->user_id = Auth::user()->id;
                //$detalledeuda->sucursal_id = $request->sucursal_id;
                $detalledeuda->deuda_id = $deuda->id;
                $detalledeuda->mese_id = $request->meses_id[$cont];
                $detalledeuda->preciomes = $request->preciomes[$cont];
                $detalledeuda->observacioncuota = $request->observacioncuota[$cont];
                $detalledeuda->fechapagomes = $request->fechapagomes[$cont];
                $detalledeuda->totalbs = $request->totalbs[$cont];
                $detalledeuda->clientIP = $request->registro_clientIP;
                $detalledeuda->clientIP_update = $clientIP;             
                $detalledeuda->save();
                $cont++;
            }

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        toast('Registro insertado con éxito!','success');
        return redirect()->route('deudaarquitectos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addpayment(Request $request, $id){
        $deuda = Deuda::findOrFail($id);

        $montopago = $deuda->montodeuda - $deuda->detalledeudas()->sum('totalbs');

        if ($request->monto <= $montopago) {
            $deuda->detalledeudas()->create([
                'totalbs' => $request->monto,
                'fechapagomes'=> Carbon::now()
            ]);

            return response()->json([
                'deuda' => $deuda,
                'message' =>'Registro con exito'
            ]);
        } else {
            return response()->json([
                'deuda' => null,
                'message' =>'El monto es mayor a la deuda'
            ]);
        }
    }
}
