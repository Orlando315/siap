<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Lote;
use App\Unidad;

class LotesController extends Controller
{
	public function create($id = NULL)
	{
		$unidades = Unidad::all();
		return view('lotes.create',['unidades'=>$unidades,'id'=>$id]);
	}

	public function store(Request $request)
	{
		$this->validate($request,[
				'unidad' => 'required',
				'lote'   => 'required'
			]);

		$lote = new Lote;
		$lote->fill($request->all());
		$lote->unidad_id = $request->input('unidad');

		if($lote->save()){
			return redirect('unidades/'.$request->input('unidad'))->with([
					'flash_class'   => 'alert-success',
					'flash_message' => 'Lote agregado con exito.'
				]);
		}else{
			return redirect('unidades/'.$request->input('unidad'))->with([
					'flash_class'   => 'alert-danger',
					'flash_message' => 'Ha ocurrido un error.',
					'flash_important' => true
				]);			
		}
	}

	public function edit($id)
	{
		$lote = Lote::findOrFail($id);
		return view('lotes.edit',['lote'=>$lote]);
	}

	public function update(Request $request,$id)
	{
		$this->validate($request,[
				'lote' => 'required'
			]);

		$lote = Lote::findOrFail($id);
		$lote->fill($request->all());

		if($lote->save()){
			return redirect('unidades/'.$lote->unidad_id)->with([
					'flash_class'   => 'alert-success',
					'flash_message' => 'Lote modificado con exito.'
				]);
		}else{
			return redirect('unidades/'.$lote->unidad_id)->with([
					'flash_class'   => 'alert-danger',
					'flash_message' => 'Ha ocurrido un error.',
					'flash_important' => true
				]);
		}
	}

	public function destroy($id)
	{
    $lote = Lote::findOrFail($id);
    $unidad = $lote->unidad_id;
		if($lote->delete()){
			return redirect('unidades/'.$unidad)->with([
					'flash_class'   => 'alert-success',
					'flash_message' => 'Lote eliminado con exito.'
				]);
		}else{
			return redirect('unidades/'.$unidad)->with([
					'flash_class'   => 'alert-danger',
					'flash_message' => 'Ha ocurrido un error.',
					'flash_important' => true
				]);
		}
	}
}