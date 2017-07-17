<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
	public $timestamps = false;
  protected $table    = 'Actividades';
  protected $fillable = [
  	'actividad',
  	'status',
  	'fecha0',
  	'fecha1',
  	'fecha2'
  ];
}
