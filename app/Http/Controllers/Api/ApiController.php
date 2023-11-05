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
            $response = Http::get('https://www.gestioncobranzabaz.com.mx/GestionesCC/v1/consulta-campania', [
                'idDespacho' => 15,
            ]);

            $data = $response->json();
            return response()->json(['Data' => $data], 200);
            // return $data;
            // Verifica que se haya obtenido una respuesta válida
            if ($response->successful()) {
                $campanias = $data['resultado']['campanias'] ?? [];

                // Obtén los IDs de las campañas
                $ids = array_map(function ($camp) {
                    return $camp['id'];
                }, $campanias);

                // Llama a la función para consultar el endpoint B con los IDs
                $resultados = $this->consultarEndpointB($ids);

                // Haz lo que necesites con los resultados
                return response()->json(['resultados' => $resultados]);
            } else {
                // Maneja el caso de una respuesta no exitosa según tus necesidades
                return response()->json(['error' => 'No se pudo obtener datos de la API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function consultarEndpointB($ids)
    {
        $resultados = [];

        foreach ($ids as $id) {
            // Realiza la solicitud a endpoint B y agrega los resultados al array
            $response = Http::get("https://tu-api-endpoint-b/{$id}");
            if ($response->successful()) {
                $resultados[] = $response->json();
            }
        }

        return $resultados;
    }
}
