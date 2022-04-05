<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Sucursal_user;
use App\Sucursal;
use App\User;
use DB;

class Sucursal_usuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:sucursal_usuario.create')->only(['create','store']);
        $this->middleware('can:sucursal_usuario.index')->only('index');
        $this->middleware('can:sucursal_usuario.edit')->only(['edit','update']);
        $this->middleware('can:sucursal_usuario.show')->only('show');
        $this->middleware('can:sucursal_usuario.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal_usuarios = DB::table('sucursal_user as suc_usu')
                        ->join('sucursals','sucursals.id','=','suc_usu.sucursal_id')
                        ->join('users','users.id','=','suc_usu.user_id')
                        ->select('suc_usu.id','sucursals.sucursal','users.name')
                        ->orderBy('suc_usu.id', 'asc')
                        ->paginate();

                        //return $sucursal_usuarios;
        return view('sucursal_usuario.index', compact('sucursal_usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = Sucursal::all();
        $users = User::all();

        return view("sucursal_usuario.create", compact('sucursales','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * undocumented constant
         **/
        //dd($request);
        //captura la sucursal
        $var_sucursal = $request->sucursal_id;
        //dd($var_sucursal);
        //captura el usuario
        $var_usuario = $request->user_id;

        $var_sucursal_usuario = DB::table('sucursal_user')
            ->select('sucursal_id','user_id')
            ->where('sucursal_id','=', $var_sucursal)
            ->where('user_id','=',$var_usuario)
            ->first();

        //dd($var_sucursal_usuario);
        if ($var_sucursal_usuario) {
            return redirect()->route('sucursales_usuarios.create')->with(['notice' => 'La asignación de esta sucursal a este usuario ya existe.']);
        }

        $sucursal_usuario = new Sucursal_user;
        $sucursal_usuario->sucursal_id = $request->sucursal_id;
        $sucursal_usuario->user_id = $request->user_id;
        $sucursal_usuario->save();

        toast('Registro insertado con éxito!','success');
        return redirect()->route('sucursales_usuarios.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucursal_usuario = Sucursal_user::findOrFail($id)->delete();
        // $sucursal_usuario = Sucursal_user::findOrFail($id);
        // $sucursal_usuario->delete();

        toast('Registro eliminado con éxito!','warning');
        return redirect()->route('sucursales_usuarios.index');
    }
}
