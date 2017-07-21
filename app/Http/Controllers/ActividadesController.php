<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Actividad;

class ActividadesController extends Controller
{
	public function avanzar(Request $request)
	{
		$actividad = Actividad::findOrFail($request->actividad_id);

		$status = $actividad->status + $request->input('opt');
		$actividad->status = $status;
		$campo = "fecha{$status}";
		$actividad->{$campo} = date('d-m-Y H:i:s');

		switch ($request->input('opt')){
			case 1:
				$msj = "Actividad avanzada correctamente.";
			break;
			case -1:
				$msj = "Actividad atrasada correctamente.";
				$status = $status+1;
				$campo = "fecha".$status;
				$actividad->{$campo} = NULL;
			break;
		}

		if($actividad->save()){
  		return redirect('ciclos/'.$request->input('ciclo_id'))->with([
  				'flash_class'   => 'alert-success',
  				'flash_message' => $msj
  			]);
		}else{
  		return redirect('ciclos/'.$request->input('ciclo_id'))->with([
  				'flash_class'     => 'alert-danger',
  				'flash_message'   => 'Ha ocurrido un error al avanzar la actividad.',
  				'flash_important' => true
  			]);
		}
	}
}