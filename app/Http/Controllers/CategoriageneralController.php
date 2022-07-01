<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoriageneral;
use App\Proyectogeneral;
use DB;

class CategoriageneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categoria_general.create')->only(['create','store']);
        $this->middleware('can:categoria_general.index')->only('index');
        $this->middleware('can:categoria_general.edit')->only(['edit','update']);
        $this->middleware('can:categoria_general.show')->only('show');
        $this->middleware('can:categoria_general.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriagenerals = Categoriageneral::get();
        return view('categoriageneral.index', compact('categoriagenerals'));
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
        $categoriageneral = Categoriageneral::findOrFail($id);
        return view('categoriageneral.edit',compact('categoriageneral'));
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
        $categoriageneral = Categoriageneral::findOrFail($id);
        $categoriageneral->nombre = $request->nombre;
        $categoriageneral->costo = $request->costo;
        $categoriageneral->update();

        toast('Registro actualizado con éxito!','success');
        return redirect()->route('categoriageneral.index');
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

    public function pg_por_categorias_report(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $categoriageneral_id = $request->categoriageneral_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $proyectogenerals = Proyectogeneral::with('categoriageneral','persona')
            ->where('sucursal_id',$sucursal_id)
            ->where('categoriageneral_id',$categoriageneral_id)
            ->orderBy(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")','asc'))
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $pdf = \PDF::loadview('pdf.pg_por_categorias', compact('proyectogenerals'))->setPaper('A4','landscape');
        return $pdf->stream('CATEGORIA '.$proyectogenerals[0]->categoriageneral->nombre.' - '.date('d-m-Y').'.pdf');
    }

    public function print_categoria_general()
    {
        $print_categoria_generals = Categoriageneral::all();
    
        $pdf = \PDF::loadview('pdf.print_categoria_general', compact('print_categoria_generals'));
        return $pdf->stream('CATEGORIA GENERAL.pdf');
    }
}
