<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
         Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('idUnico');
            $table->integer('idCampania');
            $table->integer('idPais');
            $table->integer('idCanal');
            $table->integer('idSucursal');
            $table->integer('folio');
            $table->string('nombre');
            $table->string('apellidoPaterno');
            $table->string('apellidoMaterno');
            $table->integer('semanasAtraso')->nullable();
            $table->integer('saldo')->nullable();
            $table->integer('saldoCapital')->nullable();
            $table->integer('pagoRequerido')->nullable();
            $table->string('telefono1')->nullable();
            $table->string('telefono2')->nullable();
            $table->string('telefono3')->nullable();
            $table->string('correo')->nullable();
            $table->integer('diaPago')->nullable();
            $table->integer('diasAtraso')->nullable();
            $table->integer('pagoMinimo')->nullable();
            $table->integer('pagoNoGeneraIntereses')->nullable();
            $table->integer('pagoDisponible')->nullable();
            $table->integer('abonoPuntual')->nullable();
            $table->integer('abonoSemanal')->nullable();
            $table->integer('capacidadPago')->nullable();
            $table->integer('creditoActivo')->nullable();
            $table->string('fechaProximaPago')->nullable();
            $table->string('fechaVencimiento')->nullable();
            $table->string('creditoAutorizado')->nullable();
            $table->string('tasaInteres')->nullable();
            $table->string('calle')->nullable();
            $table->string('numeroInterior')->nullable();
            $table->string('numeroExterior')->nullable();
            $table->string('colonia')->nullable();
            $table->string('codigoPostal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
