<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
  protected $table = 'unidades_produccion';
  protected $primaryKey = 'id';
  protected $fillable = ['productor_id','unidad','ubicacion'];

  public function lotes()
  {
  	return $this->hasMany('App\Lote','unidad_id')->get();
  }

  public function lotes_qty()
  {
  	return $this->hasMany('App\Lote','unidad_id')->count();
  }

  public function productor()
  {
  	return $this->belongsTo('App\Productor','productor_id');
  }
}
