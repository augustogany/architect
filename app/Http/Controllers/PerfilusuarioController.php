<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use App\Perfil;
use App\Persona;
use App\user;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $perfil = Perfil::with('user','expedicion')->where('user_id',auth()->user()->id)->first();
        //return $perfils;
        return view('perfilusuario.index', compact('perfil'));
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
            $perfil = Perfil::findOrFail($id);
            $perfil->nombre_completo = $request->nombre_completo;
            $perfil->telefono = $request->telefono;
            $perfil->email = $request->email;
            $perfil->direccion = $request->direccion;
            if($request->imagen){
                $perfil->imagen = $this->agregar_imagenes($request->imagen);
            }
            if($request->cv){
                $perfil->cv = $this->agregar_archivo($request->cv, 'cv');
            }
            $perfil->update();

            if ($request->password) {
                $user = User::findOrFail($perfil->user_id);
                $user->password = Hash::make($request->password);
                $user->update();
            }

            toast('Información actualizado con éxito!','success');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            toast('Ocurrió un error!','error');
            return redirect()->route('home');
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

    public function deudores_pdf()
    {
        $deudores = Persona::with('deudas')
                            ->whereHas('deudas', function(Builder $query){
                                $query->where('montorestante','>',0.00);
                            })->get();

        $pdf = \PDF::loadview('pdf.deudores', compact('deudores'));
        return $pdf->stream('LISTA DEUDORES - '.date('d-m-Y').'.pdf');
    }

    public function agregar_imagenes($file){
        Storage::makeDirectory('perfil/'.date('F').date('Y'));
        $base_name = Str::random(20);

        // imagen normal
        $filename = $base_name.'.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->fit(1000, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $path =  'perfil/'.date('F').date('Y').'/'.$filename;
        $image_resize->save(public_path('storage/'.$path));
        $imagen = $path;

        // imagen pequeña
        $filename_small = $base_name.'_small.'.$file->getClientOriginalExtension();
        $image_resize = Image::make($file->getRealPath())->orientate();
        $image_resize->fit(256, 256, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $path_small = 'perfil/'.date('F').date('Y').'/'.$filename_small;
        $image_resize->save(public_path('storage/'.$path_small));

        return $imagen;
    }
}
