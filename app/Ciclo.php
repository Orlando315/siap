<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
  protected $table = 'ciclos';
  protected $fillable = ['ciclo','anio'];
  protected $media = [
  	'suelo'=> 0,
  	'lab_suelo'=> 0,
  	'planificacion'=> 0,
  	'vuelo'=> 0,
  	'tejido'=> 0,
  	'lab_tejido'=> 0,
  	'esp_tejido'=> 0,
  	'procesamiento'=> 0,
  	'mapa_web'=> 0,
  	'attr_web'=> 0,
  	'null' => 0 //Indice vacio para la ultima consulta
  ];

  //Iteraciones de unidades por productor
  public $iteraciones = 0;

  public function productores($organizacion = 0)
  {
  	if($organizacion > 0){
  		$productores = $this->hasMany('App\CicloProductor','ciclo_id')
					  							->join('productores','ciclos_productores.productor_id','=','productores.id')
					  							->where('productores.organizacion_id',$organizacion)
					  							->groupBy('productor_id')
					  							->get();
  	}else{
			$productores = $this->hasMany('App\CicloProductor','ciclo_id')->groupBy('productor_id')->get();
  	}

  	return $productores;
  }

  public function selectProductores($ids)
  {
		$productores = $this->hasMany('App\CicloProductor','ciclo_id')
												->whereIn('productor_id',$ids)
												->groupBy('productor_id')
												->get();

  	return $productores;
  }

  public function organizaciones()
  {
  	return $this->hasMany('App\CicloProductor','ciclo_id')
  							->join('productores','ciclos_productores.productor_id','=','productores.id')
  							->whereNotNull('productores.organizacion_id')
  							->groupBy('productores.organizacion_id')
  							->get();
  }

  public function unidades($productor)
  {
  	return $this->hasMany('App\CicloProductor','ciclo_id')->where('productor_id',$productor)->get();
  }

  public function productores_qty()
  {
  	return $this->hasMany('App\CicloProductor','ciclo_id')->groupBy('productor_id')->get()->count();
  }

  public function unidades_qty()
  {
  	return $this->hasMany('App\CicloProductor','ciclo_id')->count();
  }

  public function valoracion($status,$campo = 'null')
  {
  	switch ($status) {
  		case 0:
  			$this->media[$campo]+=1;
  			$label = '<span class="label label-danger">Nada</span>';
  		break;
  		case 1:
  			$this->media[$campo]+=2;
  			$label = '<span class="label label-warning">Medio</span>';
  		break;
  		case 2:
  			$this->media[$campo]+=3;
  			$label = '<span class="label label-success">Completo</span>';
  		break;
  		default:
  			$label = '<span class="label label-default">Error</span>';
  		break;
  	}
  	return $label;
  }

  //Reiniciar contadores
  public function reset()
  {
  	foreach ($this->media as $key => $val){
  		$this->media[$key] = 0;
  	}
  }

  public function promedio($campo){
  	$promedio = $this->media[$campo]/$this->total_iteracion;

  	if($promedio === 3){
  		$valor = 2;
  	}elseif($promedio>=2 && $promedio < 3){
  		$valor = 1;
  	}else{
  		$valor = 0;
  	}

  	return $this->valoracion($valor);
  }

  public function iteraciones($iteraciones)
  {
  	$this->total_iteracion = $iteraciones;
  }
}
