<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('actividades',function(Blueprint $table){
      	$table->increments('id');
      	$table->integer('ciclo_productor_id')->unsigned();
      	$table->foreign('ciclo_productor_id')->references('id')->on('ciclos_productores')->onDelete('cascade');
      	$table->boolean('suelo')->default(0);
      	$table->boolean('lab_suelo')->default(0);
      	$table->boolean('planificacion')->default(0);
      	$table->boolean('vuelo')->default(0);
      	$table->boolean('tejido')->default(0);
      	$table->boolean('lab_tejido')->default(0)->comment('Laboratorio tejido');
      	$table->boolean('esp_tejido')->default(0)->comment('Especialista tejido');
      	$table->boolean('procesamiento')->default(0);
      	$table->boolean('mapa_web')->default(0)->comment('Mapas e indices');
      	$table->boolean('attr_web')->default(0)->comment('Informe de especialista');
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
      Schema::dropIfExists('actividades');
    }
}
