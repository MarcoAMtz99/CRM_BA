<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\EmployeeNumber;
use App\Models\Client;
use Illuminate\Support\Carbon;
class ExportController extends Controller
{
    public function exportClientsView(Request $request)
    {
        return view('admin.dates');

    }

    public function exportClients(Request $request)
    {
       // Validar las fechas
        $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $employee = Auth::user()->employeeNumber->number;
        $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->endOfDay();

        $clients = Client::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                'id',
                'idUnico',
                'idCampania',
                'idPais',
                'idCanal',
                'idSucursal',
                'folio',
                'nombre',
                'apellidoPaterno',
                'apellidoMaterno',
                'semanasAtraso',
                'saldo',
                'saldoCapital',
                'pagoRequerido',
                'telefono1',
                'telefono2',
                'telefono3',
                'telefono4',
                'telefono5',
                'telefono6',
                'telefono7',
                'telefono8',
                'telefono9',
                'telefono10',
                'correo',
                'diaPago',
                'diasAtraso',
                'pagoMinimo',
                'pagoNoGeneraIntereses',
                'pagoDisponible',
                'abonoPuntual',
                'abonoSemanal',
                'capacidadPago',
                'creditoActivo',
                'fechaProximaPago',
                'fechaVencimiento',
                'creditoAutorizado',
                'tasaInteres',
                'calle',
                'numeroInterior',
                'numeroExterior',
                'colonia',
                'codigoPostal',
                'producto',
            )
            ->get();

        return response()->json(['clients' => $clients,'employee'=>$employee], 200);
    }
    
}
