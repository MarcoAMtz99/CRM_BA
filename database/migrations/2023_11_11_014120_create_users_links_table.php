<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('users_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('safeurl'); 
            $table->string('idUnico'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_links');
    }
};