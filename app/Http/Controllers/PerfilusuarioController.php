<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use App\Perfil;
use App\Persona;
use DB;

class PerfilusuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //x = Perfil::with('user')->get();
        //return $x;
        $perfils = Perfil::with('user','expedicion')->where('user_id',auth()->user()->id)->get();
        //return $perfils;
        return view('perfilusuario.index', compact('perfils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $perfil = Perfil::where('user_id',$user->id)->first();
        $persona = $perfil ?? Persona::where('id',$user->persona_id)->first();
        $expedicions = DB::table('expedicions')->orderBy('nombre', 'asc')->get();
        return view('perfilusuario.create', compact('expedicions','persona'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $perfil = Perfil::where('user_id',$user->id)->first();

        if ($perfil) {
            $perfil->nombre = $request->nombre;
            $perfil->apaterno = $request->apaterno;
            $perfil->amaterno = $request->amaterno;
            $perfil->ci = $request->ci;
            $perfil->expedicion_id = $request->expedicion_id;
            $perfil->telefono = $request->telefono;
            $perfil->direccion = $request->direccion;
            $perfil->update();
        }else{
            $perfil = new Perfil;
            $perfil->nombre = $request->nombre;
            $perfil->apaterno = $request->apaterno;
            $perfil->amaterno = $request->amaterno;
            $perfil->ci = $request->ci;
            $perfil->expedicion_id = $request->expedicion_id;
            $perfil->telefono = $request->telefono;
            $perfil->direccion = $request->direccion;
            $perfil->user_id = Auth::user()->id;
            $perfil->save(); 
        }
        
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->update();

        toast('Registro insertado con ??xito!','success');
        return redirect()->route('perfilusuario.index');
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
        $perfil = Perfil::findOrFail($id);
        return view("perfilusuario.edit", compact('perfil'));
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
        $perfil = Perfil::findOrFail($id);
        $perfil->nombre = $request->nombre;
        $perfil->apaterno = $request->apaterno;
        $perfil->amaterno = $request->amaterno;
        $perfil->ci = $request->ci;
        $perfil->telefono = $request->telefono;
        $perfil->direccion = $request->direccion;
        $perfil->update();

        toast('Registro actualizado con ??xito!','success');
        return redirect()->route('perfilusuario.index');
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

    public function deudores_pdf()
    {
        $deudores = Persona::with('deudas')
                            ->whereHas('deudas', function(Builder $query){
                                $query->where('montorestante','>',0.00);
                            })->get();

        $pdf = \PDF::loadview('pdf.deudores', compact('deudores'));
        return $pdf->stream('LISTA DEUDORES - '.date('d-m-Y').'.pdf');
    }
}
