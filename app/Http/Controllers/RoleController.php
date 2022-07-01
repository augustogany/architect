<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
//use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.create')->only(['create','store']);
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.edit')->only(['edit','update']);
        $this->middleware('can:roles.show')->only('show');
        $this->middleware('can:roles.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::pluck('name','id');
        return view('roles.create', compact('permissions'));
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
        $rules = [
            'name' => 'required|unique:roles',
            'permissions' => 'required'
        ];

        $messages = [
            'name.unique' => 'El nombre de este rol ya existe.',
            'permissions.required' => 'Debe seleccionar al menos un permiso para este rol.'
        ];

        $this->validate($request, $rules, $messages);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->get('permissions'));

        toast('Registro insertado con éxito!','success');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::pluck('name','id');

        return view('roles.edit', compact('role', 'permissions'));
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
        $role = Role::findOrFail($id);
        $role->update($request->all());
        $role->permissions()->sync($request->get('permissions'));

        toast('Registro actualizado con éxito!','success');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id)->delete();
        //toast('Eliminado correctamente!','warning');
        toast('Registro eliminado con éxito!','warning');
        return back();
        //return back()->with('info', 'Eliminado correctamente');
    }
}
