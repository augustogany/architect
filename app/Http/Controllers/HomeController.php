<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Proyectogeneral;
use App\Proyectourbanizacion;
use App\Persona;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sucursales = Auth::user()->sucursales;
        foreach ($sucursales as $key => $value) {
           $id_sucursales[] = $value->id;
        }

        $personas = Persona::count();

        $count_viviendas = Proyectogeneral::where('categoriageneral_id','=','1')
            ->whereIn('sucursal_id',$id_sucursales)
            ->count();

        $count_oficinas = Proyectogeneral::where('categoriageneral_id','=','3')
            ->whereIn('sucursal_id',$id_sucursales)
            ->count();

        $count_urbanizacion = Proyectourbanizacion::where('condicion','=','1')
            ->whereIn('sucursal_id',$id_sucursales)
            ->count();

        return view('home', compact('count_viviendas','count_oficinas','count_urbanizacion','personas'));
    }

    public function visitante()
    {
        return view('visitante.index');
    }
}
