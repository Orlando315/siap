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
		$x = $actividad->{$request->input('campo')} + $request->input('opt');
		switch ($request->input('opt')) {
			case 1:
				$msj = "Actividad avanzada correctamente.";
			break;
			case -1:
				$msj = "Actividad atrasada correctamente.";
			break;
		}
		
		$actividad->{$request->input('campo')} = $x;
		
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