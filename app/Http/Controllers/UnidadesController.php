<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Unidad;
use App\Productor;

class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$unidades = Unidad::all();
      return view('unidades.index',['unidades'=>$unidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = NULL)
    {
      $productores = Productor::all();
      return view('unidades.create',['productores'=>$productores,'id'=>$id]);
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
      	'productor' => 'required',
      	'unidad'    => 'required',
      	'ubicacion' => 'required'
      ]);

      $unidad = new Unidad;
      $unidad->fill($request->all());
      $unidad->productor_id = $request->input('productor');

      if($unidad->save()){
      	return redirect('/unidades')->with([
      			'flash_class'   => 'alert-success',
      			'flash_message' => 'Unidad agregada con exito.'
      		]);
    	}else{
      	return redirect('/unidades')->with([
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
      $unidad = Unidad::findOrFail($id);
      $lotes  = $unidad->lotes();
      return view('unidades.view',['unidad'=>$unidad,'lotes'=>$lotes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $unidad = Unidad::findOrFail($id);
      $productores = Productor::all();

      return view('unidades.edit',['unidad'=>$unidad,'productores'=>$productores]);
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
      $this->validate($request,[
      		'productor' => 'required',
      		'unidad' => 'required',
      		'ubicacion' => 'required'
      	]);

      $unidad = Unidad::findOrFail($id);

      $unidad->fill($request->all());
      $unidad->productor_id = $request->input('productor');

      if($unidad->save()){
      	return redirect('/unidades/'.$id)->with([
      			'flash_class'   => 'alert-success',
      			'flash_message' => 'Unidad modificada con exito.'
      		]);
    	}else{
      	return redirect('/unidades/'.$id)->with([
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
      $unidad = Unidad::findOrFail($id);

      if($unidad->lotes_qty()===0){
      	if($unidad->delete()){
	      	return redirect('unidades')->with([
	      			'flash_class' => 'alert-success',
	      			'flash_message' => 'Unidad eliminada con exito.'
	      		]);
	      }else{
	      	return redirect('unidades/'.$id)->with([
	      			'flash_class' => 'alert-danger',
	      			'flash_message' => 'Ha ocurrido un error.',
	      			'flash_important' => true
	      		]);
	      }
      }else{
      	return redirect('unidades/'.$id)->with([
      			'flash_class' => 'alert-danger',
      			'flash_message' => 'La unidad tiene lotes registrados.',
      			'flash_important' => true
      		]);
      }
    }

    public function search(Request $request)
    {
    	$unidades = Unidad::select('id','unidad')->where('productor_id',$request->productor_id)->get()->toArray();

    	return response()->json($unidades);
    }
}
