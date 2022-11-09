<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Galeria;

class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeria = Galeria::where('deleted_at', NULL)->get();
        return view('galeria.index', compact('galeria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo = 'create';
        return view('galeria.create-edit', compact('tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Galeria::create([
                'tipo' => $request->tipo,
                'titulo' => $request->titulo,
                'detalles' => $request->detalles,
                'archivo' => $this->agregar_imagenes($request->archivo, 'galeria')
            ]);
            toast('Imagen guardada con éxito!','success');
            return redirect()->route('galerias.index');
        } catch (\Throwable $th) {
            //throw $th;
            toast('Ocurrió un error!','error');
            return redirect()->route('galerias.index');
        }
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
        $tipo = 'edit';
        $imagen = Galeria::find($id);
        return view('galeria.create-edit', compact('tipo', 'imagen'));
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
        try {
            $galeria = Galeria::find($id);
            $galeria->tipo = $request->tipo;
            $galeria->titulo = $request->titulo;
            $galeria->detalles = $request->detalles;
            if($request->archivo){
                $galeria->archivo = $this->agregar_imagenes($request->archivo, 'galeria');
            }
            $galeria->update();

            toast('Imagen editar con éxito!','success');
            return redirect()->route('galerias.index');
        } catch (\Throwable $th) {
            //throw $th;
            toast('Ocurrió un error!','error');
            return redirect()->route('galerias.index');
        }
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
}
