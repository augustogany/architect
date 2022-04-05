<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Proyectogeneral;
use App\Proyectourbanizacion;
use App\Persona;
use App\Categoriageneral;
use App\Categoriaurbanizacion;

class VistasreportesController extends Controller
{
	//PROYECTOS GENERALES:
    public function pg_por_rango_de_fechas_view()
    {
        $sucursales = Auth::user()->sucursales;
    	return view ('vistasreportes.proyectogeneral.pg_por_rango_de_fechas',compact('sucursales'));
    }

    public function pg_por_arquitectos_view()
    {	
    	//$personas = Persona::orderBy('nombre', 'asc')->get();
        $personas = Persona::orderBy('nombre', 'asc')->where('condicion','=',1)->get();
        $sucursales = Auth::user()->sucursales;
    	return view ('vistasreportes.proyectogeneral.pg_por_arquitectos',compact('personas','sucursales'));
    }

    public function pg_por_categorias_view()
    {	
    	$categoriagenerals = Categoriageneral::all();
        $sucursales = Auth::user()->sucursales;
    	return view ('vistasreportes.proyectogeneral.pg_por_categorias',compact('categoriagenerals','sucursales'));
    }

    //PROYECTOS URBANIZACIONES:
    public function pu_por_rango_de_fechas_view()
    {
        $sucursales = Auth::user()->sucursales;
        return view ('vistasreportes.proyectourbanizacion.pu_por_rango_de_fechas',compact('sucursales'));
    }

    public function pu_por_arquitectos_view()
    {   
        //$personas = Persona::orderBy('nombre', 'asc')->get();
        $personas = Persona::orderBy('nombre', 'asc')->where('condicion','=',1)->get();
        $sucursales = Auth::user()->sucursales;
        return view ('vistasreportes.proyectourbanizacion.pu_por_arquitectos',compact('personas','sucursales'));
    }

    public function pu_por_categorias_view()
    {   
        $categoriaurbanizacions = Categoriaurbanizacion::all();
        $sucursales = Auth::user()->sucursales;
        return view ('vistasreportes.proyectourbanizacion.pu_por_categorias',compact('categoriaurbanizacions','sucursales'));
    }

    public function pagodeuda_rangofecha_view()
    {   
        $sucursales = Auth::user()->sucursales;
        return view ('vistasreportes.pagodeudas.pagodeuda_rangofecha',compact('sucursales'));
    }

    public function ventaservicio_rangofecha_view()
    {   
        $sucursales = Auth::user()->sucursales;
        return view ('vistasreportes.ventas.ventaservicio_rangofecha',compact('sucursales'));
    }
}
