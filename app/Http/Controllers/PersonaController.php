<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PersonasExport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

// Models
use App\Persona;
use App\Proyectogeneral;
use App\Proyectourbanizacion;
use App\Deuda;
use App\User;
use App\Detalledeuda;
use App\Sucursal;
use App\PersonasPago;
use App\PersonasPagosMensualidades;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:personas.create')->only(['create','store']);
        $this->middleware('can:personas.index')->only('index');
        $this->middleware('can:personas.edit')->only(['edit','update']);
        $this->middleware('can:personas.show')->only('show');
        $this->middleware('can:personas.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('persona.index');
    }

    public function getPersona()
    {
        return datatables()
            ->eloquent(Persona::query())
            ->addColumn('btn_actions', 'persona.partials.btn_actions')
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
        return view('persona.create');
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
            'email' => ['string', 'max:255', 'unique:users']
        ];
        $messages = [
            'email.unique' => 'Este nombre de usuario ya a sido utlizado.'
        ];
        $this->validate($request, $rules, $messages);
        $persona = new Persona;
        $persona->nombre = $request->nombre;
        $persona->apaterno = $request->apaterno;
        $persona->amaterno = $request->amaterno;
        $persona->numeroregistro = $request->numeroregistro;
        $persona->telefonodomicilio = $request->telefonodomicilio;
        $persona->telefonooficina = $request->telefonooficina;
        $persona->telefonocelular = $request->telefonocelular;
        $persona->direccion = $request->direccion;
        $persona->correo = $request->correo;
        $persona->save();
        
        
        if ($request->get('usuario')) {
            $user = new User;
            $user->name = Str::lower($persona->nombre);
            $user->email = $request->get('usuario');
            if ($request->get('password')) {
                $user->password = Hash::make($request->get('password'));
            }
            $user->save();
        }

        toast('Registro insertado con éxito!','success');
        return redirect()->route('personas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::findOrFail($id);
        return view('persona.show',compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::findOrFail($id);
        $user = User::where('persona_id',$persona->id)->first();
        return view('persona.edit',compact('persona','user'));
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
        $user = auth()->user();
        $rules = [
            'email' => 'required', 
            Rule::unique('users', 'email')->ignore($user->id)
        ];
        $messages = [
            'email.unique' => 'Este nombre ya a sido utlizado.'
        ];
        $this->validate($request, $rules, $messages);
        
        $persona = Persona::findOrFail($id);
        $persona->nombre = $request->nombre;
        $persona->apaterno = $request->apaterno;
        $persona->amaterno = $request->amaterno;
        $persona->numeroregistro = $request->numeroregistro;
        $persona->telefonodomicilio = $request->telefonodomicilio;
        $persona->telefonooficina = $request->telefonooficina;
        $persona->telefonocelular = $request->telefonocelular;
        $persona->direccion = $request->direccion;
        $persona->correo = $request->correo;
        $persona->update();
        
        //registramos el usuario para el arquitecto

        $useravailable = User::where('persona_id', $persona->id)->first();
        $user = $useravailable ? $useravailable : null;
        if ($request->get('usuario')) {
            if (!$user) {
                $newuser = new User;
                $newuser->name = Str::lower($persona->nombre);
                $newuser->email = $request->get('usuario');
                $newuser->persona_id = $persona->id;
                if ($request->get('password')) {
                    $newuser->password = Hash::make($request->get('password'));
                }
                $newuser->save();
            }else{
                $user->name = Str::lower($persona->nombre);
                $user->email = $request->get('usuario');
                $user->persona_id = $persona->id;
                if ($request->get('password')) {
                    $user->password = Hash::make($request->get('password'));
                }
                $user->update();
            }
        }
        toast('Registro actualizado con éxito!','success');
        return redirect()->route('personas.index');
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
        $persona = Persona::findOrFail($id);

        if ($persona->condicion == 1) {
            $persona->condicion='0';
            $persona->update();
            toast('Persona inhabilitada!','warning');
            return redirect()->route('personas.index');
        }
        else{
            $persona->condicion='1';
            $persona->update();
            toast('Persona habilitada!','warning');
            return redirect()->route('personas.index');
        }
    }

    // ===================================
    function pagomensualidad_index($id){
        $pagos = PersonasPago::where('persona_id', $id)
                    ->where('deleted_at', NULL)->get();
        return view('persona.pagomensualidad', compact('id', 'pagos'));
    }

    function pagomensualidad_list($id, $gestion_id){
        $pago = PersonasPagosMensualidades::whereHas('pago', function($q) use($id){
                        $q->where('persona_id', $id);
                    })
                    ->where('gestion_id', $gestion_id)->where('deleted_at', null)->get();
        return response()->json($pago);
    }

    function pagomensualidad_store($id, Request $request){
        // dd($request->all());
        DB::beginTransaction();
        try {
            $personas_pago = PersonasPago::create([
                'user_id' => Auth::user()->id,
                'sucursal_id' => $request->sucursal_id,
                'persona_id' => $id,
                'fecha_pago' => $request->fecha_pago,
                'observacion' => $request->observacion
            ]);

            for ($i=0; $i < count($request->mes); $i++) { 
                PersonasPagosMensualidades::create([
                    'personas_pago_id' => $personas_pago->id,
                    'gestion_id' => $request->gestion_id,
                    'mes' => $request->mes[$i],
                    'monto_pagado' => $request->monto_pagado[$i],
                    'monto_descuento' => $request->monto_descuento
                ]);
            }

            DB::commit();

            toast('Pago registrado con éxito','success');
            return redirect()->route('personas.pagomensualidad.index', $id);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            toast('Ocurrió un error','error');
            return redirect()->route('personas.pagomensualidad.index', $id);
        }
    }
    // ===================================

    //Proyectos generales
    public function pg_por_arquitectos_report(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $persona_id = $request->persona_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $proyectogenerals = Proyectogeneral::with('categoriageneral','persona')
            ->where('sucursal_id',$sucursal_id)
            ->where('persona_id',$persona_id)
            ->orderBy(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")','asc'))
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $pdf = \PDF::loadview('pdf.pg_por_arquitectos', compact('proyectogenerals'))->setPaper('A4','landscape');
        return $pdf->stream('ARQUITECTO '.$proyectogenerals[0]->persona->nombre.' - '.date('d-m-Y').'.pdf');
    }

    //Proyectos de urbanizacion
    public function pu_por_arquitectos_report(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $persona_id = $request->persona_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $proyectourbanizaciones = Proyectourbanizacion::with('categoriaurbanizacion','persona')
            ->where('sucursal_id',$sucursal_id)
            ->where('persona_id',$persona_id)
            ->orderBy(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")','asc'))
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $pdf = \PDF::loadview('pdf.pu_por_arquitectos', compact('proyectourbanizaciones'))->setPaper('A4','landscape');
        return $pdf->stream('ARQUITECTO '.$proyectourbanizaciones[0]->persona->nombre.' - '.date('d-m-Y').'.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PersonasExport, 'arquitectos-list.xlsx');
    }
    
    public function exportPDF()
    {
        $personas = Persona::orderBy('nombre','asc')->get();
        //return $personas;
        $pdf = \PDF::loadview('pdf.personas-list', compact('personas'))->setPaper('A4','landscape');
        return $pdf->stream('ARQUITECTOS - '.date('d-m-Y').'.pdf');
    }

    public function pagodeuda_rangofecha_report(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $pagodeudas = Deuda::with('sucursal','persona','tipopago','detalledeudas.mes')
            ->where('sucursal_id',$sucursal_id)
            ->orderBy(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")','asc'))
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $deudatotal_Pagos = DB::table('detalledeudas as detdeuda')
            ->join('deudas','deudas.id','=','detdeuda.deuda_id')
            ->select(DB::raw('sum(detdeuda.totalbs) as sumaTotal'))
            ->where('deudas.sucursal_id',$sucursal_id)
            ->whereBetween(DB::raw('DATE_FORMAT(fecharegistro, "%Y-%m-%d")'),array($fechainicio,$fechafin))
            ->get();

        $sucursal = Sucursal::find($sucursal_id);

        $pdf = \PDF::loadview('pdf.arquitecto_pagodeuda_rangofecha', compact('pagodeudas','deudatotal_Pagos','sucursal'));
        return $pdf->stream('PAGO DEUDAS ARQUITECTOS - '.date('d-m-Y').'.pdf');
    }
}
