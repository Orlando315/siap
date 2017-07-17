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
      	$table->string('actividad');
      	$table->boolean('status')->default(0);
      	$table->timestamp('fecha0')->nullable()->comment('Status 0');
      	$table->timestamp('fecha1')->nullable()->comment('Status 1');
      	$table->timestamp('fecha2')->nullable()->comment('Status 2');
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
