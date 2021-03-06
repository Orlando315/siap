<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('lotes',function(Blueprint $table){
      	$table->increments('id');
      	$table->integer('unidad_id')->unsigned();
      	$table->foreign('unidad_id')->references('id')->on('unidades_produccion')->onDelete('cascade');
      	$table->string('lote');
      	$table->string('nombre')->nullable();
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
      Schema::dropIfExists('lotes');
    }
}
