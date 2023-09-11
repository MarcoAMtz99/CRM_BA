<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }

    public function encryptJson()
    {
        $json ='{
           "clienteUnico":{
              "idPais":1,
              "idCanal":1,
              "idSucursal":115,
              "folio":1969
           },
           "numeroTelefono":"559840744",
           "idCampana":1738,
           "numeroEmpleado":"800046",
           "token":"Cobranza2022",
           "idOrigen":2,
           "idDespacho":1,
           "fecha":"19/12/2022 13:20:00"
        }';

        $key = "192cY7vUQbodWq4q";

        $iv = "192cY7vUQbodWq4q";

        $cipherText = openssl_encrypt($json, 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);

        $cipherTextBase64 = base64_encode($cipherText);

        dd("https://www.gestioncobranzabaz.com.mx/regional/front-gestiones/index.html#/front-cobranza/credimax/".$cipherTextBase64);

        // return response()->json(['cipherText' => $cipherTextBase64]);
    
    }
}
