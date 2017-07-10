<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CicloProductor extends Model
{
  protected $table = 'ciclos_productores';
  protected $fillable = ['ciclo_id','productor_id','unidad_id'];
  
  //Verificar que la unidad no se encuentre agregada en ese ciclo
  public function verificarRepetido($ciclo,$productor,$unidad){
  	return $this->where([['ciclo_id',$ciclo],['productor_id',$productor],['unidad_id',$unidad]])->count();
  }

  public function productor()
  {
  	return $this->belongsTo('App\Productor','productor_id')->groupBy('id');
  }

  public function unidad()
  {
  	return $this->belongsTo('App\Unidad','unidad_id');
  }

  public function actividad()
  {
  	return $this->hasOne('App\Actividad','ciclo_productor_id','id');
  }
}
