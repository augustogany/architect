<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Persona;
use App\Categoriaurbanizacion;
use App\Proyectourbanizacion;
use DB;
use NumerosEnLetras;
use Illuminate\Support\Facades\Storage;


class ProyectourbanizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:proyecto_urbanizacion.create')->only(['create','store']);
        $this->middleware('can:proyecto_urbanizacion.index')->only('index');
        $this->middleware('can:proyecto_urbanizacion.edit')->only(['edit','update']);
        $this->middleware('can:proyecto_urbanizacion.show')->only('show');
        $this->middleware('can:proyecto_urbanizacion.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proyectourbanizacion.index');
    }

    public function getProyectourbanizacion()
    {
        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        return datatables()
            ->eloquent(Proyectourbanizacion::with('categoriaurbanizacion','persona')
            ->whereIn('sucursal_id',$id_sucursales)
            ->orderBy('id','desc'))
            ->addColumn('btn_actions', 'proyectourbanizacion.partials.btn_actions')
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
        $categoriaurbanizacions = Categoriaurbanizacion::all();

        return view('proyectourbanizacion.create',compact('sucursales', 'personas','categoriaurbanizacions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $monto_inicial = $request->visado_bs;
        $descuento = $request->descuento;

        $resultado_totalbs = $monto_inicial - $descuento;

        $proyectourbanizacion = new Proyectourbanizacion;
        $proyectourbanizacion->user_id = Auth::user()->id;
        $proyectourbanizacion->sucursal_id = $request->sucursal_id;
        $proyectourbanizacion->persona_id = $request->persona_id_input;
        $proyectourbanizacion->categoriaurbanizacion_id = $request->categoriageneral_id_input;
        $proyectourbanizacion->arancelcategoria = $request->arancel;
        $proyectourbanizacion->costo_pu_categoria = $request->costo_pu;
        $proyectourbanizacion->porcentaje_cab_categoria = $request->porcentaje_cab;
        $proyectourbanizacion->visado_sus_categoria = $request->visado_sus;
        $proyectourbanizacion->visado_bs_categoria = $request->visado_bs;
        $proyectourbanizacion->proyecto = $request->proyecto;
        $proyectourbanizacion->propietario = $request->propietario;
        $proyectourbanizacion->superficiemts2 = $request->superficiemts2;
        $proyectourbanizacion->totalbs = $resultado_totalbs;
        $proyectourbanizacion->descuento = $request->descuento;
        $proyectourbanizacion->fecharegistro = $request->fecharegistro;
        $proyectourbanizacion->estado = $request->estado;

        if($request->hasFile('archivo'))
        {
            $proyectourbanizacion->archivo = $request->file('archivo')->store('proyectourbanizacion','public');
        }

        $proyectourbanizacion->save();

        toast('Registro insertado con éxito!','success');
        return redirect()->route('proyectourbanizacion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyectourbanizacions = Proyectourbanizacion::with('categoriaurbanizacion','persona')->findOrFail($id);

        //return $proyectourbanizacions;

        return view('proyectourbanizacion.show',compact('proyectourbanizacions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyectourbanizacion = Proyectourbanizacion::findOrFail($id);
        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        $personas = Persona::orderBy('nombre', 'asc')->get();
        $categoriaurbanizacions = Categoriaurbanizacion::all();

        return view('proyectourbanizacion.edit',compact('proyectourbanizacion','sucursales', 'personas','categoriaurbanizacions'));
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
        $monto_inicial = str_replace(',','.',$request->visado_bs);
        $descuento = $request->descuento;

        $resultado_totalbs = $monto_inicial - $descuento;

        $proyectourbanizacion = Proyectourbanizacion::findOrFail($id);
        $proyectourbanizacion->user_id = Auth::user()->id;
        $proyectourbanizacion->sucursal_id = $request->sucursal_id;
        $proyectourbanizacion->persona_id = $request->persona_id;
        $proyectourbanizacion->arancelcategoria = $request->arancel;
        $proyectourbanizacion->costo_pu_categoria = $request->costo_pu;
        $proyectourbanizacion->porcentaje_cab_categoria = $request->porcentaje_cab;
        $proyectourbanizacion->visado_sus_categoria = str_replace(',','.',$request->visado_sus);
        $proyectourbanizacion->visado_bs_categoria = str_replace(',','.',$request->visado_bs);
        $proyectourbanizacion->proyecto = $request->proyecto;
        $proyectourbanizacion->propietario = $request->propietario;
        $proyectourbanizacion->superficiemts2 = $request->superficiemts2;
        $proyectourbanizacion->totalbs = $resultado_totalbs;
        $proyectourbanizacion->descuento = $request->descuento;
        $proyectourbanizacion->fecharegistro = $request->fecharegistro;
        $proyectourbanizacion->estado = $request->estado;

        if(!is_null($request->categoriaurbanizacion_id_input))
        {
            $proyectourbanizacion->categoriaurbanizacion_id = $request->categoriaurbanizacion_id_input;
        }

        if($request->hasFile('archivo'))
        {
            Storage::disk('public')->delete($proyectourbanizacion->archivo);
            $proyectourbanizacion->archivo = $request->file('archivo')->store('proyectourbanizacion','public');
        }

        $proyectourbanizacion->update();

        toast('Registro actualizado con éxito!','success');
        return redirect()->route('proyectourbanizacion.index');
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

    public function pu_por_rango_de_fechas_report(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $proyectourbanizaciones = Proyectourbanizacion::with('categoriaurbanizacion','persona')
            ->where('sucursal_id',$sucursal_id)
            ->orderBy(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")','asc'))
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $pdf = \PDF::loadview('pdf.pu_por_rango_de_fechas', compact('proyectourbanizaciones'))->setPaper('A4','landscape');
        return $pdf->stream('PROYECTOS URBANIZACIONES - '.date('d-m-Y').'.pdf');
    }
}
