<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalPhoneColumnsToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('telefono4')->nullable()->after('telefono3');
            $table->string('telefono5')->nullable()->after('telefono4');
            $table->string('telefono6')->nullable()->after('telefono5');
            $table->string('telefono7')->nullable()->after('telefono6');
            $table->string('telefono8')->nullable()->after('telefono7');
            $table->string('telefono9')->nullable()->after('telefono8');
            $table->string('telefono10')->nullable()->after('telefono9');
            // Puedes seguir agregando más columnas de la misma manera si es necesario
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['telefono4', 'telefono5', 'telefono6', 'telefono7', 'telefono8', 'telefono9', 'telefono10']);
        });
    }
}
