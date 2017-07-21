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
  	'mapa'=> 0,
  	'attr'=> 0,
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

  public function productores($organizacion = false, $estado = false,$tecnico = false)
  {
		$productores = $this->hasMany('App\CicloProductor','ciclo_id')
							  				->join('productores','ciclos_productores.productor_id','=','productores.id')
				                ->when($organizacion, function ($query) use ($organizacion) {
				                   return $query->where('productores.organizacion_id',$organizacion);
				                })
				                ->when($estado, function ($query) use ($estado) {
				                   return $query->where('productores.estado',$estado);
				                })
				                ->when($tecnico, function ($query) use ($tecnico){
				                	return $query->where('productores.tecnico_id',$tecnico);
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

  public function valoracion($status,$campo = 'null',$pdf = false,$fecha1 = NULL, $fecha2 = NULL)
  {
  	$fecha1 = $fecha1!=""?$fecha1:"N/A";
  	$fecha2 = $fecha2!=""?$fecha2:"N/A";

  	$content = htmlentities("
	    <ul class=\"list-group list-group-unbordered\">
	      <li class=\"list-group-item\">
	    		<span class=\"label label-danger\">Nada</span>&nbsp;&nbsp;<span class=\"pull-right\">-</span>
	      </li>
	      <li class=\"list-group-item\">
	        <span class=\"label label-warning\">Medio</span>&nbsp;&nbsp;<span id=\"fecha1\" class=\"pull-right\">{$fecha1}</span>
	      </li>
	      <li class=\"list-group-item\">
	        <span class=\"label label-success\">Completo</span>&nbsp;&nbsp;<span id=\"fecha2\" class=\"pull-right\">{$fecha2}</span>
	      </li>
	    </ul>");

  	switch ($status) {
  		case 0:
  			$this->media[$this->limpiar($campo)]+=1;
  			$label = $pdf?'<b style="color:#DD4B39">Nada</b>':'<a tabindex="0" class="btn btn-danger btn-flat btn-sm" data-toggle="popover" data-content="'.$content.'" data-trigger="focus" title="'.$campo.'" data-fecha1="'.$fecha1.'" data-fecha2="'.$fecha2.'">Nada</a>';
  		break;
  		case 1:
  			$this->media[$this->limpiar($campo)]+=2;
  			$label = $pdf?'<b style="color:#F39C12">Medio</b>':'<a tabindex="0" class="btn btn-warning btn-flat btn-sm" data-toggle="popover" data-content="'.$content.'" data-trigger="focus" title="'.$campo.'" data-fecha1="'.$fecha1.'" data-fecha2="'.$fecha2.'">Medio</a>';
  		break;
  		case 2:
  			$this->media[$this->limpiar($campo)]+=3;
  			$label = $pdf?'<b style="color:#00A65A">Completo</b>':'<a tabindex="0" class="btn btn-success btn-flat btn-sm" data-toggle="popover" data-content="'.$content.'" data-trigger="focus" title="'.$campo.'" data-fecha1="'.$fecha1.'" data-fecha2="'.$fecha2.'">Completo</a>';
  		break;
  		default:
  			$label = $pdf?'<span class="label label-default">Error</span>':'<span class="label label-default">Error</span>';
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

  //Limpiar el nombre de la actividad para usarlo en el array $media
  public function limpiar($campo)
  {
  	return strtolower(str_replace('. ','_',$campo));
  }
}
