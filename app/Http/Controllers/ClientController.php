<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\EmployeeNumber;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Carbon;


class ClientController extends Controller
{
    public function getClientsToday()
    {
        $today = Carbon::today(); // Obtener la fecha de hoy
        $clients = Client::whereDate('created_at', $today)
            ->select(
                'id',
                'idCampania',
                'idPais',
                'idCanal',
                'idSucursal',
                'folio',
                'nombre',
                'apellidoPaterno',
                'apellidoMaterno',
                'telefono1',
                'telefono2',
                'telefono3'
            )
            ->get(); // Filtrar los clientes creados hoy

        return response()->json(['clients' => $clients], 200);
    }


    public function getClientsView(Request $request)
    {
        $employee = Auth::user()->employeeNumber->number;
        return view('clients.consult',['employee'=>$employee]);
    }
    
}
