<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Ciclo;
use App\Unidad;
use App\Actividad;
use App\Productor;
use App\Organizacion;
use App\CicloProductor;

class CiclosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$ciclos = Ciclo::all();

    	return view('ciclos.index',['ciclos'=>$ciclos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('ciclos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
      	'anio'  => 'required|numeric',
      	'ciclo' => 'required|unique:ciclos'
      	]);

      $ciclo = new Ciclo;
      $ciclo->fill($request->all());

      if($ciclo->save()){
      	return redirect('/ciclos')->with([
      		'flash_class'   => 'alert-success',
      		'flash_message' => 'Ciclo agredado con exito.'
      		]);
      }else{
      	return redirect('/ciclos')->with([
      		'flash_class'     => 'alert-danger',
      		'flash_message'   => 'Ha ocurrido un error.',
      		'flash_important' => true
      		]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$ciclo = Ciclo::findOrFail($id);
    	$productores = $ciclo->productores();
    	return view('ciclos.view',['ciclo'=>$ciclo,'productores'=>$productores]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $ciclo = Ciclo::findOrFail($id);
    	return view('ciclos.edit',['ciclo'=>$ciclo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $ciclo = Ciclo::findOrFail($id);

      $this->validate($request,[
      	'anio'  => 'required|numeric',
      	'ciclo' => 'required|unique:ciclos,ciclo,'.$id.',id'
      	]);

      $ciclo->fill($request->all());

      if($ciclo->save()){
      	return redirect('/ciclos')->with([
      		'flash_class'   => 'alert-success',
      		'flash_message' => 'Ciclo editado con exito.'
      		]);
      }else{
      	return redirect('/ciclos')->with([
      		'flash_class'     => 'alert-danger',
      		'flash_message'   => 'Ha ocurrido un error.',
      		'flash_important' => true
      		]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add($id)
    {
    	$ciclo = Ciclo::findOrFail($id);
    	$productores = Productor::all();

    	return view('ciclos.add',['ciclo'=>$ciclo,'productores'=>$productores]);
    }

    public function add_unidad(Request $request)
    {
    	$this->validate($request,[
    			'ciclo' => 'required',
    			'unidad' => 'required'
    		]);
    	$unidad = Unidad::findOrFail($request->input('unidad'));

    	$ciclo_id     = $request->input('ciclo');
    	$productor_id = $unidad->productor_id;
    	$unidad_id    = $unidad->id;
    	
    	$x = new CicloProductor;
    	$repetido = $x->verificarRepetido($ciclo_id,$productor_id,$unidad_id);

    	if($repetido === 0){    		

	    	$x->ciclo_id     = $ciclo_id;
	    	$x->productor_id = $productor_id;
	    	$x->unidad_id    = $unidad_id;
	    	
	    	if($x->save()){
	    		$actividad = new Actividad;
	    		$x->actividad()->save($actividad);

	    		return redirect('ciclos/'.$ciclo_id)->with([
	    				'flash_class' => 'alert-success',
	    				'flash_message' => 'Unidad agregada correctamente.'
	    			]);
	    	}else{
	    		return redirect('ciclos/'.$ciclo_id)->with([
	    				'flash_class' => 'alert-danger',
	    				'flash_message' => 'Ha ocurrido un error.',
	    				'flash_important' => true
	    			]);
	    	}
	    }else{
	    		return redirect('ciclos/'.$ciclo_id)->with([
	    				'flash_class' => 'alert-danger',
	    				'flash_message' => 'Esta unidad ya se encuentra registrada en este ciclo.',
	    				'flash_important' => true
	    			]);
	    }
    }

    public function cerrar($id)
    {
    	$ciclo = Ciclo::findOrFail($id);
    	$ciclo->status = 0;

    	if($ciclo->save()){
    		return redirect('ciclos/'.$id)->with([
    				'flash_class' => 'alert-success',
    				'flash_message' => 'Ciclo cerrado correctamente.'
    			]);
    	}else{
    		return redirect('ciclos/'.$id)->with([
    				'flash_class' => 'alert-danger',
    				'flash_message' => 'Ha ocurrido un error.',
    				'flash_important' => true
    			]);
    	}
    }

    public function search()
    {
    	$ciclos = Ciclo::all();
    	$organizaciones = Organizacion::all();
    	return view('ciclos.search',['ciclos'=>$ciclos,'organizaciones'=>$organizaciones]);
    }

    public function searchProductores(Request $request,$render = false)
    {
    	$ciclo = Ciclo::findOrFail($request->input('ciclo'));

    	$resumen = $request->input('resumen')?true:false;

    	if($render){
	    	$productores = $ciclo->selectProductores($request->input('productores'),$request->input('organizacion'));
	    	return view('partials.box_productores',['ciclo'=>$ciclo,'productores'=>$productores,'resumen'=>$resumen]);
	    }else{
	    	$p = array('organizaciones'=>array(),'productores'=>array(),'resumen'=>$resumen);

	    	foreach ($ciclo->organizaciones() as $organizacion){
		    	$p['organizaciones'][] = array(
		    												'id'=>$organizacion->productor->organizacion->id,
		    												'organizacion'=>$organizacion->productor->organizacion->organizacion
		    											);
		    }
		    if($request->input('organizacion') > 0){
		    	$productores = $ciclo->productores($request->input('organizacion'));
		    }else{
		    	$productores = $ciclo->productores();
		    }

		    foreach ($productores as $productor){
		    	$p['productores'][] = array(
		    												'id'=>$productor->productor->id,
		    												'nombre'=>$productor->productor->nombres." ".$productor->productor->apellidos
		    											);
		    }
	    	return response()->json($p);
	    }
    }
}
