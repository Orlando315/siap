<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
	protected $table = 'productores';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  		'organizacion_id',
  		'tecnico_id',
      'nombres',
      'apellidos',
      'tipo',
      'identificacion',
      'email',
      'estado',
      'tlf_personal',
      'tlf_oficina',
      'tlf_administracion',
      'direccion',
      'contacto'
  ];

  public function tecnico()
  {
  	return $this->belongsTo('App\Tecnico','tecnico_id');
  }

  public function unidades()
  {
  	return $this->hasMany('App\Unidad','productor_id')->get();
  }

  public function unidades_qty()
  {
  	return $this->unidades()->count();
  }

  public function organizacion()
  {
  	return $this->belongsTo('App\Organizacion','organizacion_id');
  }
}
