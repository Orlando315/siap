<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Ciclo;
use App\Tecnico;
use App\Productor;
use App\Organizacion;

class ReportesController extends Controller
{
	public function tecnicos()
	{
		$tecnicos = Tecnico::all();
		$fecha = Date('d-m-Y');

  	$pdf = PDF::loadView('reportes.tecnicos',['tecnicos' => $tecnicos]);
    return $pdf->download('tecnicos'.$fecha.'.pdf');		
	}
	public function productores()
	{
		$productores = Productor::all();
		$fecha = Date('d-m-Y');

  	$pdf = PDF::loadView('reportes.productores',['productores' => $productores]);
    return $pdf->download('productores'.$fecha.'.pdf');
	}

	public function productor($id)
	{
		$fecha = date('d-m-Y');
		$productor = Productor::findOrFail($id);
		$unidades = $productor->unidades();

  	$pdf = PDF::loadView('reportes.productor',['productor' => $productor,'unidades'=>$unidades]);
    return $pdf->download($productor->nombres.$productor->apellidos.$fecha.'.pdf');
	}

	public function custom(Request $request)
	{
  	$ciclo = Ciclo::findOrFail($request->input('ciclo'));

  	$resumen = $request->input('resumen')?true:false;
  	$productores = $ciclo->selectProductores($request->input('productores'));

  	$pdf = PDF::loadView('reportes.customCiclo',['ciclo'=>$ciclo,'productores' => $productores,'resumen'=>$resumen]);
  	return $pdf->download('ciclo-'.$ciclo->ciclo.'.pdf');
	}

	public function ciclo($id,$tecnico = false)
	{
		$ciclo = Ciclo::findOrFail($id);
  	$productores = $ciclo->productores(false,false,$tecnico);
  	$tecnico = Tecnico::find($tecnico);

		$pdf = PDF::loadView('reportes.ciclo',['ciclo'=>$ciclo,'productores'=>$productores,'resumen'=>false,'tecnico'=>$tecnico]);
  	return $pdf->download('ciclo-'.$ciclo->ciclo.'.pdf');
	}

	public function organizaciones()
	{
		$organizaciones = Organizacion::all();
		$fecha = Date('d-m-Y');

  	$pdf = PDF::loadView('reportes.organizaciones',['organizaciones' => $organizaciones]);
    return $pdf->download('organizaciones'.$fecha.'.pdf');
	}

	public function organizacion($id)
	{
		$organizacion = Organizacion::findOrFail($id);
  	$productores = $organizacion->productores();

		$pdf = PDF::loadView('reportes.organizacion',['organizacion'=>$organizacion,'productores'=>$productores]);
  	return $pdf->download($organizacion->organizacion.date('d-m-Y').'.pdf');
	}
}
