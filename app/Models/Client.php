<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   protected $table = 'clients'; 

    protected $fillable = [
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

    ];
}
