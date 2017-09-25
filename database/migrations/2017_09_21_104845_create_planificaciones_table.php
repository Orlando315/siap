<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('planificaciones',function(Blueprint $table){
      	$table->increments('id');
      	$table->integer('productor_id')->unsigned();
      	$table->foreign('productor_id')->references('id')->on('productores')->onDelete('cascade');
      	$table->integer('lote_id')->unsigned();
      	$table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
      	$table->timestamp('fecha_siembra');
      	$table->string('variacion')->nullable();
      	$table->string('cultivo');
      	$table->float('superficie',4,2)->nullable();
      	$table->timestamp('fecha_vm')->comment('Fecha de vuelo y muestreo');
      	$table->string('plan')->nullable()->comment('Plan de vuelo');
      	$table->string('sup_planeada')->comment('Superficie planeada');

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
      Schema::dropIfExists('planificaciones');
    }
}
