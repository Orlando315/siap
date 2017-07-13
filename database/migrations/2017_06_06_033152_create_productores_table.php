<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('productores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organizacion_id')->unsigned()->nullable();
            $table->foreign('organizacion_id')->references('id')->on('organizaciones');
            $table->integer('tecnico_id')->unsigned()->nullable();
            $table->foreign('tecnico_id')->references('id')->on('tecnicos');
            $table->string('nombres');
            $table->string('apellidos')->nullable();
            $table->string('tipo');
            $table->string('identificacion');
            $table->string('email');
            $table->string('estado');
            $table->string('tlf_personal')->nullable();
            $table->string('tlf_oficina')->nullable();
            $table->string('tlf_administracion')->nullable();
            $table->string('direccion')->nullable();
            $table->string('contacto')->nullable();
            $table->softDeletes();
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
    	Schema::dropIfExists('productores');
    }
}
