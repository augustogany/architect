<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoriaurbanizacion;
use Yajra\Datatables\Datatables;
use App\Proyectourbanizacion;
use DB;

class CategoriaurbanizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categoria_urbanizacion.create')->only(['create','store']);
        $this->middleware('can:categoria_urbanizacion.index')->only('index');
        $this->middleware('can:categoria_urbanizacion.edit')->only(['edit','update']);
        $this->middleware('can:categoria_urbanizacion.show')->only('show');
        $this->middleware('can:categoria_urbanizacion.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoriaurbanizacion::get();
        return view('categoriaurbanizacion.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $categoriaurbanizacion = Categoriaurbanizacion::findOrFail($id);
        return view('categoriaurbanizacion.edit',compact('categoriaurbanizacion'));
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
        dd($request);
        $categoriaurbanizacion = Categoriaurbanizacion::findOrFail($id);
        $categoriaurbanizacion->mt2_inicio = $request->mt2_inicio;
        $categoriaurbanizacion->mt2_fin = $request->mt2_fin;
        $categoriaurbanizacion->arancel = $request->arancel;
        $categoriaurbanizacion->costo_pu = $request->costo_pu;
        $categoriaurbanizacion->porcentaje_cab = $request->porcentaje_cab;
        $categoriaurbanizacion->visado_sus = $request->visado_sus;
        $categoriaurbanizacion->visado_bs = $request->visado_bs;
        $categoriaurbanizacion->update();

        toast('Registro actualizado con éxito!','success');
        return redirect()->route('categoriaurbanizacion.index');
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

    public function pu_por_categorias_report(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $categoriaurbanizacion_id = $request->categoriaurbanizacion_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $proyectourbanizaciones = Proyectourbanizacion::with('categoriaurbanizacion','persona')
            ->where('sucursal_id',$sucursal_id)
            ->where('categoriaurbanizacion_id',$categoriaurbanizacion_id)
            ->orderBy(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")','asc'))
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $pdf = \PDF::loadview('pdf.pu_por_categorias', compact('proyectourbanizaciones'))->setPaper('A4','landscape');
        return $pdf->stream('CATEGORIA DE: '.$proyectourbanizaciones[0]->categoriaurbanizacion->mt2_inicio.' - A: '.$proyectourbanizaciones[0]->categoriaurbanizacion->mt2_fin.' - '.date('d-m-Y').'.pdf');
    }

    public function print_categoria_urbanizacion()
    {
        $print_categoria_urbanizacions = Categoriaurbanizacion::all();
    
        $pdf = \PDF::loadview('pdf.print_categoria_urbanizacion', compact('print_categoria_urbanizacions'));
        return $pdf->stream('CATEGORIA URBANIZACION.pdf');
    }
}
