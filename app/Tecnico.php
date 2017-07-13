<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
  protected $table = 'tecnicos';

  protected $fillable = [
  	'nombres',
  	'apellidos',
  	'email',
  	'cedula',
  	'estado',
  	'tlf_personal',
  	'tlf_opcional'
  ];

  public function productores()
  {
  	return $this->hasMany('App\Productor','tecnico_id')->get();
  }
}
