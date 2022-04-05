<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Sucursal;
use DB;

//use RealRashid\SweetAlert\Facades\Alert;

class SucursalController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:sucursales.create')->only(['create','store']);
        $this->middleware('can:sucursales.index')->only('index');
        $this->middleware('can:sucursales.edit')->only(['edit','update']);
        $this->middleware('can:sucursales.show')->only('show');
        $this->middleware('can:sucursales.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Sucursal::paginate();
        return view('sucursales.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'sucursal' => 'unique:sucursals'
        ];

        $messages = [
            'sucursal.unique' => 'El nombre de sucursal ya existe.'
        ];

        $this->validate($request, $rules, $messages);

        $sucursal = new Sucursal;
        $sucursal->sucursal = $request->sucursal;
        $sucursal->ubicacion = $request->ubicacion;
        $sucursal->save();

        toast('Registro insertado con éxito!','success');
        return redirect()->route('sucursales.index');
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
        $sucursal = Sucursal::findOrFail($id);
        return view("sucursales.edit", compact('sucursal'));
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
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->sucursal = $request->sucursal;
        $sucursal->ubicacion = $request->ubicacion;
        $sucursal->update();

        toast('Registro actualizado con éxito!','success');
        return redirect()->route('sucursales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        // $sucursal = Sucursal::findOrFail($id);
        // $sucursal->delete();
        //$var_sucursal = $request->sucursal_id;

        $var_sucursal = DB::table('sucursal_user')
            ->select('sucursal_id')
            ->where('sucursal_id','=', $id)
            ->first();

            //dd($var_sucursal);

        if ($var_sucursal) {
            return redirect()->route('sucursales.index')->with(['notice' => 'Alerta, Esta sucursal no se puede eliminar porque tiene usuarios asignados!']);
        }

        $sucursal = Sucursal::findOrFail($id)->delete();

        toast('Registro eliminado con éxito!','warning');
        return redirect()->route('sucursales.index');
    }
}
