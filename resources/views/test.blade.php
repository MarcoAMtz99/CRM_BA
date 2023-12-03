@extends('layouts.test')

@section('content')

    <h1>Prueba test para conexiones</h1>

    <hr>

    La hora del servidor es: {{ now()->format('Y-m-d H:i:s') }}

    <hr>

    La zona horaria actual es: {{ \Illuminate\Support\Carbon::now()->timezoneName }}
    <hr>
    Fecha:
    {{\Illuminate\Support\Carbon::now()}}
    <hr>
    La zona horaria de Apache es: {{ $_SERVER['TZ'] ?? 'No se pudo obtener la zona horaria' }}
    <hr>

@endsection
