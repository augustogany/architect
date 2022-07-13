<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Models
use App\Gestion;

class GestionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestiones = Gestion::where('deleted_at', NULL)->get();
        return view('gestiones.index', compact('gestiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 'create';
        return view('gestiones.create-edit', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $gestion = Gestion::where('gestion', $request->gestion)
        //                 // ->where('sucursal_id', $request->sucursal_id)
        //                 ->where('deleted_at', NULL)->first();
        // if($gestion){
        //     toast('La gestión ya está registrada','warning');
        //     return redirect()->back();
        // }

        try {
            Gestion::create([
                'user_id' => Auth::user()->id,
                'sucursal_id' => $request->sucursal_id,
                'gestion' => $request->gestion,
                'mensualidad' => $request->mensualidad,
                'observacion' => $request->observacion
            ]);
            toast('Gestión registrada correctamente','success');
            return redirect()->route('gestiones.index');
        } catch (\Throwable $th) {
            // dd($th);
            toast('Ocurrió un error','error');
            return redirect()->back();
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = 'edit';
        $gestion = Gestion::find($id);
        return view('gestiones.create-edit', compact('type', 'gestion'));
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
        // $gestion = Gestion::where('id', '<>', $id)
        //                 // ->where('sucursal_id', $request->sucursal_id)
        //                 ->where('gestion', $request->gestion)
        //                 ->where('deleted_at', NULL)->first();
        // if($gestion){
        //     toast('La gestión ya está registrada','warning');
        //     return redirect()->back();
        // }

        try {
            Gestion::where('id', $id)->update([
                'sucursal_id' => $request->sucursal_id,
                'gestion' => $request->gestion,
                'mensualidad' => $request->mensualidad,
                'observacion' => $request->observacion
            ]);
            toast('Gestión actualizada correctamente','success');
            return redirect()->route('gestiones.index');
        } catch (\Throwable $th) {
            // dd($th);
            toast('Ocurrió un error','error');
            return redirect()->back();
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
