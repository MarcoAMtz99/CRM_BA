<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    public function importCSV(Request $request)
    {
            // Valida y sube el archivo CSV
            $request->validate([
                'csv_file' => 'required|file|mimes:csv,txt',
            ]);
            $invalidRecords = [];

            if ($request->hasFile('csv_file')) {
                $csvFile = $request->file('csv_file');
                $csv = Reader::createFromPath($csvFile->getPathname(), 'r');
                $csv->setHeaderOffset(0); // Supongamos que la primera fila es el encabezado
                $successCount= 0;
                foreach ($csv as $row) {

                    if (!empty(array_filter($row))) {
                            $data = [
                            'idUnico' => $row['idUnico'],
                            'idCampania' => $row['idCampania'],
                            'idPais' => $row['idPais'],
                            'idCanal' => $row['idCanal'],
                            'idSucursal' => $row['idSucursal'],
                            'folio' => $row['folio'],
                            'nombre' => empty($row['nombre']) ? 'x' : str_replace("'", "", $row['nombre']),
                            'apellidoPaterno' => empty($row['apellidoPaterno']) ? 'x' : str_replace("'", "", $row['apellidoPaterno']),
                            'apellidoMaterno' => empty($row['apellidoMaterno']) ? 'x' : str_replace("'", "", $row['apellidoMaterno']),
                            'semanasAtraso' => $row['semanasAtraso'],
                            'saldo' => $row['saldo'],
                            'saldoCapital' => $row['saldoCapital'],
                            'pagoRequerido' => $row['pagoRequerido'],
                            'telefono1' => $row['telefono1'],
                            'telefono2' => $row['telefono2'],
                            'telefono3' => $row['telefono3'],
                            'telefono4' => $row['telefono4'],
                            'telefono5' => $row['telefono5'],
                            'telefono6' => $row['telefono6'],
                            'telefono7' => $row['telefono7'],
                            'telefono8' => $row['telefono8'],
                            'telefono9' => $row['telefono9'],
                            'telefono10' => $row['telefono10'],
                            'correo' => $row['correo'],
                            'diaPago' => $row['diaPago'],
                            'diasAtraso' => $row['diasAtraso'],
                            'pagoMinimo' => $row['pagoMinimo'],
                            'pagoNoGeneraIntereses' => $row['pagoNoGeneraIntereses'],
                            'pagoDisponible' => $row['pagoDisponible'],
                            'abonoPuntual' => $row['abonoPuntual'],
                            'abonoSemanal' => $row['abonoSemanal'],
                            'capacidadPago' => $row['capacidadPago'],
                            'creditoActivo' => $row['creditoActivo'],
                            'fechaProximaPago' => date('Y-m-d H:i:s', strtotime($row['fechaProximaPago'])),
                            'fechaVencimiento' => date('Y-m-d H:i:s', strtotime($row['fechaVencimiento'])),
                            'creditoAutorizado' => $row['creditoAutorizado'],
                            'tasaInteres' => $row['tasaInteres'],
                            'calle' => DB::connection()->getPdo()->quote($row['calle']),
                            'numeroInterior' => DB::connection()->getPdo()->quote($row['numeroInterior']),
                            'numeroExterior' => DB::connection()->getPdo()->quote($row['numeroExterior']),
                            'colonia' => DB::connection()->getPdo()->quote($row['colonia']),
                            'codigoPostal' => DB::connection()->getPdo()->quote($row['codigoPostal']),
                            'producto'=>$row['producto'] ?? '',
                        ];

                        // Reemplaza los valores vacíos con NULL
                        foreach ($data as $key => $value) {
                            if (empty($value)) {
                                $data[$key] = null;
                            }
                        }

                        try {
                        Client::create($data);
                        $successCount++;
                        } catch (\Exception $e) {
                           $invalidRecord = $data;
    
                            // Agrega el registro inválido al array
                            $invalidRecords[] = $invalidRecord;
                            
                            Log::info("Excepción al procesar registro: " . $e);
                            Log::info("Registro inválido: " . json_encode($invalidRecord));
                        }
                    }
                    
                }

                 return redirect()->back()->with('success', 'Se importaron ' . $successCount . ' registros exitosamente.')->with('invalidRecords', $invalidRecords);
            }
        }

     public function form()
    {
        return view('admin.import');


    }

}
