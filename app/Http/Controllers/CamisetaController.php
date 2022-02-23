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
    public function mostrarCamiseta(Request $request){
        $array3 = $request->session()->get('carrito');
        $listaCamiseta = DB::table('camisetas')->select('*')->get();
        return view('principal', compact('listaCamiseta'),compact('array3'));
    }

    public function mostrarCamisetaLog(){
        $listaCamiseta = DB::table('camisetas')->select('*')->get();
        return view('principal_log', compact('listaCamiseta'));
    }

    /*Mostrar ADMIN*/
    public function mostrarCamisetaAdm(){
        $listaCamiseta = DB::table('camisetas')->select('*')->get();
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
            DB::table('camisetas')->where('id','=',$id)->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('principal_admin');
    }

    /*Âñadir al carro*/
    public function CartAdd(Request $request){
        $producto = Camiseta::find($request->producto_id);
        $comp = $request->session()->get('carrito');
        if (isset($comp)){
            $array1 = $request->session()->get('carrito');
            $array2[] = $producto->id;
            $request->session()->put('carrito',array_merge($array1,$array2));
        } else {
            $array1[] = $producto->id;
            $request->session()->put('carrito', $array1);
        }
        //$array3=$request->session()->get('carrito');
        //return view('carritoview', compact('array3'));
        //return $array3;
        return redirect('principal');
    }
    /*Checkout carro*/
    //public function CartCheckout(){
        //return view('carritoview');
    //}
    public function CartCheckout(Request $request){
        $array3 = $request->session()->get('carrito');

        return view('carritoview', compact('array3'));
    }
    
    public function CartClearOut(Request $request){
        $request->session()->forget('carrito');
        return redirect('principal');
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
                DB::table('camisetas')->insertGetId(["foto_cami"=>$datos['foto_cami'],"nombre_cami"=>$datos['nombre_cami'],"precio_cami"=>$datos['precio_cami']]);
            DB::commit();
            return redirect('principal_admin');
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /*Dinero*/
    public function enviarDinero($precio){
        //$resultado = $precio.','.$id;
        //return $resultado;

        //Aqui generamos la clase ApiContext que es la que hace la conexión
        $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            config('services.paypal.client_id'),     // ClientID
            config('services.paypal.client_secret')      // ClientSecret
        ));

        //Generamos otra clase Payer
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        //Generamos la tercera clase (Amount) que dice la cantidad a pagar
        $amount = new \PayPal\Api\Amount();

        //precio a pagar
        $amount->setTotal($precio);
        $amount->setCurrency('EUR');

        //Generamos otra clase donde le pasamos el precio y la moneda
        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        //le envioa la pagina informacion del id
        //si se cancela lo llevo a la pagina que quiero
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(url("comprado"))->setCancelUrl(url("/"));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($apiContext);
            //me redirige a la pagina de compra
            return redirect()->away( $payment->getApprovalLink());

        }catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }

    }

    public function compra(){
        return "La compra se ha completado con exito";
    }
}
