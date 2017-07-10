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
      'nombres',
      'apellidos',
      'tipo',
      'identificacion',
      'email',
      'tlf_personal',
      'tlf_oficina',
      'tlf_administracion',
      'direccion',
      'contacto'
  ];

  public function unidades()
  {
  	return $this->hasMany('App\Unidad','productor_id')->get();
  }

  public function unidades_qty()
  {
  	return $this->hasMany('App\Unidad','productor_id')->count();
  }

  public function organizacion()
  {
  	return $this->belongsTo('App\Organizacion','organizacion_id');
  }
}
