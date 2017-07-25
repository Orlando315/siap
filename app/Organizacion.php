<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
  protected $table = 'organizaciones';
  protected $fillable = ['organizacion'];

  public function productores()
  {
  	return $this->hasMany('App\Productor','organizacion_id')->get();
  }

  public function productores_qty()
  {
  	return $this->productores()->count();
  }
}
