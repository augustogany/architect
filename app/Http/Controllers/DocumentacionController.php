<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Documentation;
use App\Experiencia;
use App\Persona;

class DocumentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $persona = Persona::where('id',$user->persona_id)->first();
        $documentacion = Documentation::where('persona_id',$persona->id)->first();
        $experiencias = Experiencia::where('persona_id',$persona->id)->first();
        return view('perfilusuario.kardex.documentacion',[
                    'documentacion' => $documentacion,
                    'experiencias' => $experiencias,
                    'persona' => $persona
                ]);
    }

    public function guardar($request,$documento){
       
        $file=$request->file("urlpdf");
       
        if($file->guessExtension()=="pdf"){
            $customFileName = uniqid() . '_.' . $file->extension();
            $nombre_original = $file->getClientOriginalName();
            $request->file('urlpdf')->storeAs('public/kardex', $customFileName);
            $imageName = $documento->archivo ? $documento->archivo['url'] : null;
            DB::beginTransaction();
            try {
                if ($imageName != null) {
                    $documento->archivo()->update([
                        'name'=> $nombre_original,
                        'url' => $customFileName
                    ]);
                }else {
                    $documento->archivo()->create([
                        'name'=> $nombre_original,
                        'url' => $customFileName
                    ]);
                }
                if ($imageName != null) {
                    if (file_exists('storage/kardex/' . $imageName)) {
                        unlink('storage/kardex/' . $imageName);
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
            return response()->json([
                'documento' => Documentation::find($documento->id),
                'message' => 'Archivo guardado correctamente'
            ]);
        }else{
            return response()->json([
                'documento' => null,
                'message' => 'NO ES UN PDF'
            ]);
        }
    }

    public function getexperiencia()
    {
        return datatables()->eloquent(Experiencia::query())
            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = null;
        try {
            $documento = Documentation::where('id', request('id'))->first();
            
            if ($documento !== null) {
                $documento->update([
                    'curriculo' => $request->curriculo,
                    'serv_militar' => $request->serv_militar,
                    'nit' => $request->nit
                ]);
            } else {
                $documento = Documentation::create([
                    'curriculo' => $request->curriculo,
                    'serv_militar' => $request->serv_militar,
                    'nit' => $request->nit,
                    'persona_id' => $request->persona_id
                ]);
            }
            if ($request->hasFile("urlpdf")) {
                $data = $this->guardar($request,$documento);
            }
            return $data?? response()->json([
                                      'documento' => $documento,
                                      'message' => 'Datos Actualizados correctamente'
                                    ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function store_experiencia(Request $request){
        $experiencia = new Experiencia;
        $experiencia->empresa = $request->get('empresa');
        $experiencia->cargo = $request->get('cargo');
        $experiencia->desde = $request->get('desde');
        $experiencia->hasta = $request->get('hasta');
        $experiencia->persona_id = $request->get('persona_id');
        $experiencia->save();

        toast('Experiencia registrada!','info')->timerProgressBar();
        return redirect()->back();
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
        //
    }

    public function update_experiencia(Request $request){
        $item_id = $request->get('item_id');
        $item = Experiencia::find($item_id);
        if(empty($item)) {
            return response()->json([
                'success' => false,
                'message' => 'No existe el item',
            ], 404);
        } else {
            $item->empresa = $request->get('empresa');
            $item->cargo = $request->get('cargo');
            $item->desde = $request->get('desde');
            $item->hasta = $request->get('hasta');
            $item->save();
            return response()->json([
                'success' => true,
                'message' => 'Experienci actualizada.',
            ], 200);
        }
    }

    public function delete(Request $request) {
        $item_id = $request->get('item_id');
        $item = Experiencia::find($item_id);
        if(empty($item)) {
            return response()->json([
                'success' => false,
                'message' => 'Item no encontrado!',
            ], 200); // 404
        } else {
            $item->delete();
            return response()->json([
                'success' => true,
                'message' => 'Experiencia eliminada con exito.',
            ], 200);
        }
    }
}
