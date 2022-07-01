<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Categoriageneral;
use App\Proyectogeneral;
use Illuminate\Support\Facades\Storage;
use DB;

class ProyectogeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:proyecto_general.create')->only(['create','store']);
        $this->middleware('can:proyecto_general.index')->only('index');
        $this->middleware('can:proyecto_general.edit')->only(['edit','update']);
        $this->middleware('can:proyecto_general.show')->only('show');
        $this->middleware('can:proyecto_general.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proyectogeneral.index');
    }

    public function getProyectogeneral()
    {
        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        return datatables()
            ->eloquent(Proyectogeneral::with('categoriageneral','persona')
            ->whereIn('sucursal_id',$id_sucursales))
            ->addColumn('btn_actions', 'proyectogeneral.partials.btn_actions')
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

        $personas = Persona::orderBy('nombre', 'asc')->where('condicion','=',1)->get();
        $categoriagenerals = Categoriageneral::all();

        return view('proyectogeneral.create',compact('sucursales', 'personas','categoriagenerals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $calcular_mts2_costo = $request->superficiemts2*$request->costo;

        $proyectogeneral = new Proyectogeneral;
        $proyectogeneral->user_id = Auth::user()->id;
        $proyectogeneral->sucursal_id = $request->sucursal_id;
        $proyectogeneral->persona_id = $request->persona_id_input;
        $proyectogeneral->categoriageneral_id = $request->categoriageneral_id_input;
        $proyectogeneral->costocategoria = $request->costo;
        $proyectogeneral->proyecto = $request->proyecto;
        $proyectogeneral->propietario = $request->propietario;
        $proyectogeneral->superficiemts2 = $request->superficiemts2;
        $proyectogeneral->totalbs_inicial = $calcular_mts2_costo;
        $proyectogeneral->totalbs = $request->costo_parcial;
        //$proyectogeneral->totalbs_aux = $calcular_descuento;
        $proyectogeneral->descuento = $request->descuento;
        $proyectogeneral->fecharegistro = $request->fecharegistro;
        $proyectogeneral->estado = $request->estado;

        if($request->hasFile('archivo'))
        {
            $proyectogeneral->archivo = $request->file('archivo')->store('proyectogeneral','public');
        }

        $proyectogeneral->save();

        toast('Registro insertado con éxito!','success');
        return redirect()->route('proyectogeneral.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyectogeneral = Proyectogeneral::with('categoriageneral','persona')->findOrFail($id);
        return view('proyectogeneral.show',compact('proyectogeneral'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyectogeneral = Proyectogeneral::findOrFail($id);
        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        $personas = Persona::orderBy('nombre', 'asc')->get();
        $categoriagenerals = Categoriageneral::all();

        return view('proyectogeneral.edit',compact('proyectogeneral','sucursales', 'personas','categoriagenerals'));
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
        $calcular_mts2_costo = $request->superficiemts2*$request->costo;

        $proyectogeneral = Proyectogeneral::findOrFail($id);
        $proyectogeneral->user_id = Auth::user()->id;
        $proyectogeneral->sucursal_id = $request->sucursal_id;
        $proyectogeneral->persona_id = $request->persona_id;
        $proyectogeneral->costocategoria = $request->costo;
        $proyectogeneral->proyecto = $request->proyecto;
        $proyectogeneral->propietario = $request->propietario;
        $proyectogeneral->superficiemts2 = $request->superficiemts2;
        $proyectogeneral->totalbs_inicial = $calcular_mts2_costo;
        $proyectogeneral->totalbs = $request->costo_parcial;
        //$proyectogeneral->totalbs_aux = $request->costo_parcial;
        $proyectogeneral->descuento = $request->descuento;
        $proyectogeneral->fecharegistro = $request->fecharegistro;
        $proyectogeneral->estado = $request->estado;

        if(!is_null($request->categoriageneral_id_input))
        {
            $proyectogeneral->categoriageneral_id = $request->categoriageneral_id_input;
        }

        if($request->hasFile('archivo'))
        {   //
            Storage::disk('public')->delete($proyectogeneral->archivo);
            //
            $proyectogeneral->archivo = $request->file('archivo')->store('proyectogeneral','public');
        }

        $proyectogeneral->update();

        toast('Registro actualizado con éxito!','success');
        return redirect()->route('proyectogeneral.index');
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

    public function pg_por_rango_de_fechas_report(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $proyectogenerals = Proyectogeneral::with('categoriageneral','persona')
            ->where('sucursal_id',$sucursal_id)
            ->orderBy(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")','asc'))
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $pdf = \PDF::loadview('pdf.pg_por_rango_de_fechas', compact('proyectogenerals'))->setPaper('A4','landscape');
        return $pdf->stream('PROYECTOS GENERALES - '.date('d-m-Y').'.pdf');
    }
}
