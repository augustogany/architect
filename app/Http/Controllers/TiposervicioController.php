<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Servicio;

class TiposervicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('configuracion.tiposervicio.index');
    }

    public function gettiposervicio()
    {
        return datatables()->eloquent(Servicio::query())
            ->addColumn('btn_actions', 'configuracion.tiposervicio.partials.btn_actions')
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
        return view('configuracion.tiposervicio.create');
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


        $tiposervicio = new Servicio;
        $tiposervicio->nombre = $request->nombre;
        $tiposervicio->precio = $request->precio;
        $tiposervicio->save();

        toast('Registro insertado con éxito!','success');
        return redirect()->route('tiposervicios.index');
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
        $tiposervicio = Servicio::findOrFail($id);
        return view('configuracion.tiposervicio.edit', compact('tiposervicio'));
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
        $tiposervicio = Servicio::findOrFail($id);
        $tiposervicio->nombre = $request->nombre;
        $tiposervicio->precio = $request->precio;
        $tiposervicio->update();

        toast('Registro actualizado con éxito!','info');
        return redirect()->route('tiposervicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiposervicio = Servicio::findOrFail($id);

        if ($tiposervicio->estado == 'ACTIVO') {
            $tiposervicio->estado = 'DESHABILITADO';
            $tiposervicio->update();
            toast('Tipo Servici inhabilitado!','warning');
            return redirect()->route('tiposervicios.index');
        }
        else{
            $tiposervicio->estado='ACTIVO';
            $tiposervicio->update();
            toast('Tipo Servici habilitado!','warning');
            return redirect()->route('tiposervicios.index');
        }
    }
}
