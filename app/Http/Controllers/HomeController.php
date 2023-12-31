<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function encryptJson(Request $request)
    {

       if (empty($request->Data['folio'])) {
            return response()->json(['error' => 'El campo folio está vacío'], 400);
        }

        $json = '{
        "clienteUnico": {
        "idPais": 1,
        "idCanal": 1,
        "idSucursal": 162,
        "folio": "' . $request->Data['folio'] . '"
            },
            "numeroTelefono": "4878725518",
            "idCampana": 1738,
            "numeroEmpleado": "800046",
            "token": "Cobranza2022",
            "idOrigen": 2,
            "idDespacho": 1,
            "fecha": "' . Carbon::now()->format('d/m/Y H:i:s') . '"
        }';

        $key = "192cY7vUQbodWq4q";

        $iv = "192cY7vUQbodWq4q";

        $cipherText = openssl_encrypt($json, 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);

        // $cipherTextBase64 = base64_encode($cipherText);

         $cipherTextBase64 = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($cipherText));
         $safeUrl= "https://www.gestioncobranzabaz.com.mx/regional/front-gestiones/index.html#/front-cobranza/credimax/".$cipherTextBase64;
        return response()->json([
            'status' => true,
            'message' => "Link generado con exito!",
            'cipherText' => $safeUrl
        ],200);
    
    }
}
