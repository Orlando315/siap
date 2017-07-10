<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
  protected $table = 'lotes';
  protected $primaryKey = 'id';
  protected $fillable = ['unidad_id','lote','nombre'];

  public function unidad()
  {
  	return $this->belongsTo('App\Unidad','unidad_id','id');
  }
}
