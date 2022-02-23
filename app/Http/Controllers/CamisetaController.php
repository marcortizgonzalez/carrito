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

    public function mostrarCamisetaLog(){
        $listaCamiseta = DB::table('tbl_camiseta')->select('*')->get();
        return view('principal_log', compact('listaCamiseta'));
    }

    /*Mostrar ADMIN*/
    public function mostrarCamisetaAdm(){
        $listaCamiseta = DB::table('tbl_camiseta')->select('*')->get();
        return view('principal_admin', compact('listaCamiseta'));
    }
  
    /*LogIn*/
    public function login(){
        return view('principal_log');
    }

    public function loginusu(){
        return view('login');
    }

    public function loginPost(Request $request){
        //recogemos los datos, teniendo exepciones, como el token que utiliza laravel y el método
        $datos = $request->except('_token', '_method');
        //Validación datos por parte del server, es necesario aunque pase por JS 
        // $request->validate([
        //     'correo_usu' => 'required|string|max:60',
        //     'pass_usu' => 'required|string|max:255'
        // ]);

        try {
            //Hacemos la consulta con la DB, la cual contará nuestros resultados 1-0
            $queryId = DB::table('tbl_usuario')->where('correo_usu', '=', $datos['correo_usu'])->where('pass_usu', '=', ($datos['pass_usu']))->count();
            //Obtenemos todos los resultados de la DB, posteiriormente cogeremos un campo en concreto, obtenemos el primer resultado
            $userId = DB::table('tbl_usuario')->where('correo_usu', '=', $datos['correo_usu'])->where('pass_usu', '=', ($datos['pass_usu']))->first();
            //De los datos obtenidos consultamos el campo en concreto
            $rol_usu = $userId->rol_usu;
            $correo_usu=$datos['correo_usu'];
            //En caso de que la query $queryId devuelva como resultado 1(Coincidenci de datos haz...)
            if ($queryId == 1){
                //Establecemos sesión, solcitando el dato a Request
                $request->session()->put('correo_usu', $request->correo_usu);
                if($rol_usu == 'admin'){
                    $request->session()->put('rol_usu', $rol_usu);
                    return redirect("/principal_admin");
                    //return $datos;
                }else{
                    $request->session()->put('rol_usu', $rol_usu);
                    $request->session()->put('correo_usu', $correo_usu);
                    return redirect("/principal");
                    //return $datos;
                }
            }else{
                //No establecemos sesión y lo devolvemos a login
                return redirect('/');
            }
        } catch (\Throwable $e) {
            //En caso de error impredecible obtendremos el mismo error mediante $e
            //return $e->getMessage();
            return redirect('/');
        }
    }

    /*Logout*/
    public function logout(Request $request){
        //Eliminar todas las variables de sesion
        $request->session()->flush();
        return redirect('/');
    }
  
    /*Eliminar camiseta*/
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
        return $datos;
        try{
            DB::beginTransaction();
                DB::table('tbl_camiseta')->insertGetId(["foto_cami"=>$datos['foto_cami'],"nombre_cami"=>$datos['nombre_cami'],"precio_cami"=>$datos['precio_cami']]);
            DB::commit();
            return redirect('principal_admin');
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /*COMPRAR PROCESO Y MANDAR CORREO */
    //Enviar correo al propietario
    public function comprar(Request $request){
    $sub = "Compra realizada con exito";
    $msj = "Detalle del pedido: ".$request->input('array_pedido')." 
    \r\nSe ha realizado la compra con el correo: ".session('correo_usu')."
    \r\nCualquier inconveniente no dude en contactarnos. \r\n Atentamente el equipo de BBB CAMISETAS DE FÚTBOL";
    $datos = array('message'=>$msj);
    $enviar = new EnviarMensaje($datos);
    $enviar->sub = $sub;
    Mail::to(session('correo_usu'))->send($enviar);
    }
}
