<?php

namespace App\Http\Controllers;

use App\Models\Camiseta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Exception;
use Illuminate\Support\Facades\Storage;
use App\Mail\EnviarMensaje;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CamisetaCrear;

class CamisetaController extends Controller
{
    /*Mostrar*/
    public function mostrarCamiseta(){
        $listaCamiseta = DB::table('tbl_camiseta')->select('*')->get();
        return view('principal', compact('listaCamiseta'));
    }

    /*Crear*/
    public function crearCamiseta(){
        return view('crear');
    }

    public function crearCamisetaPost(CamisetaCrear  $request){
        $datos = $request->except('_token');
        if($request->hasFile('foto_cami')){
            $datos['foto_cami'] = $request->file('foto_cami')->store('uploads','public');
        }else{
            $datos['foto_cami'] = NULL;
        }

        try{
            DB::beginTransaction();
            $id = DB::table('tbl_camiseta')->insertGetId(["foto_cami"=>$datos['foto_cami'],"nombre_cami"=>$datos['nombre_cami'],"precio"=>$datos['precio']]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('principal_admin');
    }

    /*Eliminar*/
    public function eliminarCamiseta($id){
        try{
            DB::beginTransaction();
            DB::table('tbl_camiseta')->where('id','=',$id)->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('principal_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Camiseta  $camiseta
     * @return \Illuminate\Http\Response
     */
    public function show(Camiseta $camiseta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Camiseta  $camiseta
     * @return \Illuminate\Http\Response
     */
    public function edit(Camiseta $camiseta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Camiseta  $camiseta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camiseta $camiseta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Camiseta  $camiseta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Camiseta $camiseta)
    {
        //
    }
}
