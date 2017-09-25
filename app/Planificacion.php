<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planificacion extends Model
{
  protected $primaryKey = 'id';
	protected $table = 'planificaciones';
	protected $fillable = [
		'productor_id',
		'lote_id',
		'fecha_siembra',
		'variacion',
		'cultivo',
		'superficie',
		'fecha_vm',
		'plan',
		'sup_planeada'
	];

	public function productor()
	{
		return $this->belongsTo('App\Productor','productor_id','id');
	}

	public function lote()
	{
		return $this->belongsTo('App\Lote','lote_id');
	}
}
