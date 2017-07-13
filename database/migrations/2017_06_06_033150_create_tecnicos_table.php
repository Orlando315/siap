<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tecnicos',function(Blueprint $table){
      	$table->increments('id');
      	$table->string('nombres');
      	$table->string('apellidos');
      	$table->string('email');
      	$table->string('cedula');
      	$table->string('estado');
      	$table->string('tlf_personal');
      	$table->string('tlf_opcional')->nullable();
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
      Schema::dropIfExists('tecnicos');
    }
}
