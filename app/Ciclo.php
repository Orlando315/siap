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
  	'null' => 0 //Indice vacio para la consulta Resumen
  ];

  //Iteraciones de unidades por productor
  public $iteraciones = 0;

  public function tecnicos()
  {
  	return $this->hasMany('App\CicloProductor','ciclo_id')
  							->join('productores','ciclos_productores.productor_id','=','productores.id')
  							->groupBy('productores.tecnico_id')
  							->get();
  }

  public function productores($organizacion = 0, $estado = "")
  {
  	$org = $organizacion > 0;
  	$est = $estado != "";

		$productores = $this->hasMany('App\CicloProductor','ciclo_id')
							  				->join('productores','ciclos_productores.productor_id','=','productores.id')
				                ->when($org, function ($query) use ($organizacion) {
				                   return $query->where('productores.organizacion_id',$organizacion);
				                })
				                ->when($est, function ($query) use ($estado) {
				                   return $query->where('productores.estado',$estado);
				                })
				                ->groupBy('productor_id')
				                ->get();

  	return $productores;
  }

  public function selectProductores($ids)
  {
		return $this->hasMany('App\CicloProductor','ciclo_id')
												->whereIn('productor_id',$ids)
												->groupBy('productor_id')
												->get();
  }

  public function organizaciones()
  {
  	return $this->hasMany('App\CicloProductor','ciclo_id')
  							->join('productores','ciclos_productores.productor_id','=','productores.id')
  							->whereNotNull('productores.organizacion_id')
  							->groupBy('productores.organizacion_id')
  							->get();
  }

  public function estados()
  {
  	return $this->hasMany('App\CicloProductor','ciclo_id')
  							->join('productores','ciclos_productores.productor_id','=','productores.id')
  							->groupBy('productores.estado')
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

  public function valoracion($status,$campo = 'null',$pdf = false)
  {
  	switch ($status) {
  		case 0:
  			$this->media[$campo]+=1;
  			$label = $pdf?'<b style="color:#DD4B39">Nada</b>':'<span class="label label-danger">Nada</span>';
  		break;
  		case 1:
  			$this->media[$campo]+=2;
  			$label = $pdf?'<b style="color:#F39C12">Medio</b>':'<span class="label label-warning">Medio</span>';
  		break;
  		case 2:
  			$this->media[$campo]+=3;
  			$label = $pdf?'<b style="color:#00A65A">Completo</b>':'<span class="label label-success">Completo</span>';
  		break;
  		default:
  			$label = $pdf?'<b style="color:#ccc">Error</b>':'<span class="label label-default">Error</span>';
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

  public function promedio($campo,$pdf = false){
  	$promedio = $this->media[$campo]/$this->total_iteracion;

  	if($promedio === 3){
  		$valor = 2;
  	}elseif($promedio>=2 && $promedio < 3){
  		$valor = 1;
  	}else{
  		$valor = 0;
  	}

  	return $this->valoracion($valor,'null',$pdf);
  }

  public function iteraciones($iteraciones)
  {
  	$this->total_iteracion = $iteraciones;
  }
}
