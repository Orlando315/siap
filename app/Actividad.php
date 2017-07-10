<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
  protected $table    = 'Actividades';
  protected $fillable = [
  	'suelo',
  	'lab_suelo',
  	'planificacion',
  	'vuelo',
  	'tejido',
  	'lab_tejido',
  	'esp_tejido',
  	'procesamiento',
  	'mapa_web',
  	'attr_web',
  	'status'
  ];
}
