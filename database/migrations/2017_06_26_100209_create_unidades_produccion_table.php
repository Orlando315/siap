<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesProduccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('unidades_produccion',function(Blueprint $table){
      	$table->increments('id');
      	$table->integer('productor_id')->unsigned();
      	$table->foreign('productor_id')->references('id')->on('productores')->onDelete('cascade');
      	$table->string('unidad');
      	$table->string('ubicacion');
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
      Schema::dropIfExists('unidades_produccion');
    }
}
