<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tipopago;

class TipopagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tipopagos = Tipopago::all();
        //return $tipopagos;
        return view('configuracion.tipopago.index');
    }

    public function gettipopago()
    {
        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        return datatables()->eloquent(Tipopago::with('sucursal')
            ->whereIn('sucursal_id',$id_sucursales))
            ->addColumn('btn_actions', 'configuracion.tipopago.partials.btn_actions')
            ->rawColumns(['btn_actions'])
            ->toJson();
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

        return view('configuracion.tipopago.create',compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //capyura ip del usuario
        $clientIP =\Request::ip ();

        $tipopago = new Tipopago;
        $tipopago->user_id = Auth::user()->id;
        $tipopago->sucursal_id = $request->sucursal_id;
        $tipopago->nombrepago = $request->nombrepago;
        $tipopago->gestion = $request->gestion;
        $tipopago->monto = $request->monto;
        $tipopago->monto_aux = $request->monto;
        $tipopago->descuentoporcentaje = $request->descuentoporcentaje;
        $tipopago->descuentobs = $request->descuentobs;
        $tipopago->cuotas = $request->cuotas;
        $tipopago->clientIP = $clientIP;
        $tipopago->clientIP_update = $clientIP;
        $tipopago->save();

        toast('Registro insertado con éxito!','success');
        return redirect()->route('tipopagos.index');
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
        $tipopago = Tipopago::findOrFail($id);

        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        return view('configuracion.tipopago.edit',compact('tipopago','sucursales'));
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
         //capyura ip del usuario
        $clientIP =\Request::ip ();

        $tipopago = Tipopago::findOrFail($id);
        $tipopago->user_id = Auth::user()->id;
        $tipopago->sucursal_id = $request->sucursal_id;
        $tipopago->nombrepago = $request->nombrepago;
        $tipopago->gestion = $request->gestion;
        $tipopago->monto = $request->monto;
        $tipopago->monto_aux = $request->monto;
        $tipopago->descuentoporcentaje = $request->descuentoporcentaje;
        $tipopago->descuentobs = $request->descuentobs;
        $tipopago->cuotas = $request->cuotas;
        $tipopago->clientIP_update = $clientIP;
        $tipopago->update();

        toast('Registro actualizado con éxito!','info');
        return redirect()->route('tipopagos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipopago = Tipopago::findOrFail($id);

        if ($tipopago->condicion_aux == 1) {
            $tipopago->condicion_aux='0';
            $tipopago->update();
            toast('Tipo de Pago inhabilitado!','warning');
            return redirect()->route('tipopagos.index');
        }
        else{
            $tipopago->condicion_aux='1';
            $tipopago->update();
            toast('Tipo de Pago habilitado!','warning');
            return redirect()->route('tipopagos.index');
        }
    }
}
