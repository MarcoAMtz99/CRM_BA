<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    //
    public function consultarAPI()
    {
        try {
            $idDespacho = 15;
            $url = "https://www.gestioncobranzabaz.com.mx/GestionesCC/v1/consulta-campania?idDespacho={$idDespacho}";

            // Define los encabezados personalizados
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('JeYXUErLkDgWzA9Pp8c2uMOkSppDq9YafWQzXVkv6itpvVrGejXSf:kDF3NFAPwKyPU8JS+Q25nAb0Fn66/RrtlJ3kofnJ8VOcbiraA0nU6w'),
                'x-api-key' => 'SDRgX_Jv8vziBFIQHSCNcCIkc6pmJHlPcDUFl8lWajg=',
            ];

            // Realiza la solicitud HTTP con los encabezados personalizados
            $response = Http::withHeaders($headers)->post($url);
            $data = $response->json();

            // return response()->json(['Data' => $data], 200);

            if ($response->successful()) {
                $campanias = $data['resultado']['campanias'] ?? [];

                // Obtén los IDs de las campañas
                $ids = array_map(function ($camp) {
                    return $camp['id'];
                }, $campanias);

                $resultados = $this->consultClients($ids);

                return response()->json(['resultados' => $resultados]);
            } else {
                return response()->json(['error' => 'No se pudo obtener datos de la API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function consultClients($idCampanas)
    {
        $resultados = [];

        try {
            $idDespacho = 15;
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('JeYXUErLkDgWzA9Pp8c2uMOkSppDq9YafWQzXVkv6itpvVrGejXSf:kDF3NFAPwKyPU8JS+Q25nAb0Fn66/RrtlJ3kofnJ8VOcbiraA0nU6w'),
                'x-api-key' => 'SDRgX_Jv8vziBFIQHSCNcCIkc6pmJHlPcDUFl8lWajg=',
            ];

            foreach ($idCampanas as $idCampana) {

                $url = "https://www.gestioncobranzabaz.com.mx/GestionesCC/v2/consulta-clientes?idDespacho={$idDespacho}&idCampana={$idCampana}";
                dd($url);
                $response = Http::withHeaders($headers)->post($url);
                return response()->json(['RESPONSE CLIENT' => $response], 200);
                $data = $response->json();

                if ($response->successful() && isset($data['resultado']['clientes']) && is_array($data['resultado']['clientes'])) {
                    foreach ($data['resultado']['clientes'] as $item) {
                        // Limita la lista de teléfonos a tres si es que vienen
                        $telefonos = [];
                        if (isset($item['telefonos']) && is_array($item['telefonos'])) {
                            for ($i = 0; $i < min(count($item['telefonos']), 3); $i++) {
                                $telefonos[] = $item['telefonos'][$i]['numero'];
                            }
                        }

                        $telefono1 = isset($telefonos[0]) ? $telefonos[0] : null;
                        $telefono2 = isset($telefonos[1]) ? $telefonos[1] : null;
                        $telefono3 = isset($telefonos[2]) ? $telefonos[2] : null;

                        $resultados[] = [
                            'idCampania' => $item['idCampania'],
                            'idPais' => $item['idPais'],
                            'idCanal' => $item['idCanal'],
                            'idSucursal' => $item['idSucursal'],
                            'folio' => $item['folio'],
                            'semanasAtraso' => $item['semanasAtraso'],
                            'saldo' => $item['saldo'],
                            'saldoCapital' => $item['saldoCapital'],
                            'pagoRequerido' => $item['pagoRequerido'],
                            'nombre' => $item['nombre'],
                            'apellidoPaterno' => $item['apellidoPaterno'],
                            'apellidoMaterno' => $item['apellidoMaterno'],
                            'telefono1' => $telefono1,
                            'telefono2' => $telefono2,
                            'telefono3' => $telefono3,
                            'correos' => isset($item['correos']) && is_array($item['correos']) ? $item['correos'] : [],
                            'diaPago' => $item['diaPago'],
                            'diasAtraso' => $item['diasAtraso'],
                            'pagoMinimo' => $item['pagoMinimo'],
                            'pagoNoGeneraIntereses' => $item['pagoNoGeneraIntereses'],
                            'pagoDisponible' => $item['pagoDisponible'],
                            'abonoPuntual' => $item['abonoPuntual'],
                            'abonoSemanal' => $item['abonoSemanal'],
                            'capacidadPago' => $item['capacidadPago'],
                            'creditoActivo' => $item['creditoActivo'],
                            'fechaProximaPago' => $item['fechaProximaPago'],
                            'fechaVencimiento' => $item['fechaVencimiento'],
                            'creditoAutorizado' => $item['creditoAutorizado'],
                            'tasaInteres' => $item['tasaInteres'],
                            'calle' => $item['calle'],
                            'numeroInterior' => $item['numeroInterior'],
                            'numeroExterior' => $item['numeroExterior'],
                            'colonia' => $item['colonia'],
                            'codigoPostal' => $item['codigoPostal'],
                            // Agrega otros atributos según sea necesario
                        ];
                    }
                } else {
                    // Puedes manejar el error de la solicitud, por ejemplo, registrándolo o tomando alguna otra acción necesaria.
                }
            }

            return response()->json(['resultados' => $resultados]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
