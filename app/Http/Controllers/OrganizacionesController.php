<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organizacion;
use App\Productor;

class OrganizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$organizaciones = Organizacion::all();
      return view('organizaciones.index',['organizaciones'=>$organizaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('organizaciones.create');
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
      	'organizacion' => 'required|unique:organizaciones,organizacion'
      ]);

      $organizacion = new Organizacion;
      $organizacion->fill($request->all());

      if($organizacion->save()){
      	return redirect('/organizaciones')->with([
      			'flash_class' => 'alert-success',
      			'flash_message' => 'Organizacion creada con exito.'
      		]);
      }else{
      	return redirect('/organizaciones')->with([
      			'flash_class' => 'alert-success',
      			'flash_message' => 'Ha ocurrido un error.',
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
    	$organizacion = Organizacion::findOrFail($id);
      return view('organizaciones.view',['organizacion'=>$organizacion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$organizacion = Organizacion::findOrFail($id);
      return view('organizaciones.edit',['organizacion'=>$organizacion]);
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
      $organizacion = Organizacion::findOrFail($id);

      $this->validate($request,[
      	'organizacion' => 'required'
      ]);

      $organizacion->fill($request->all());

      if($Organizacion->save()){
      	return redirect('organizaciones.index')->with([
      			'flash_class' => 'alert-success',
      			'flash_message' => 'Organizacion actualizada con exito.'
      		]);
      }else{
      	return redirect('organizaciones.index')->with([
      			'flash_class' => 'alert-success',
      			'flash_message' => 'Ha ocurrido un error.',
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
      $organizacion = Organizacion::findOrFail($id);

      if($organizacion->productores_qty() === 0){
      	if($organizacion->delete()){
	      	return redirect('/organizaciones')->with([
	      		'flash_class'     => 'alert-success',
	      		'flash_message'   => 'Organizacion eliminada con exito.'
	      	]);
	      }else{
	      	return redirect('/organizaciones/'.$id)->with([
	      		'flash_class'     => 'alert-danger',
	      		'flash_message'   => 'Ha ocurrido un error',
	      		'flash_important' => true
	      	]);
	      }
      }else{
      	return redirect('/organizaciones/'.$id)->with([
	      		'flash_class'     => 'alert-error',
	      		'flash_message'   => 'La organizacion tiene productores registrados.',
	      		'flash_important' => true
	      	]);
      }

    }//destroy

    public function add($id)
    {
    	$organizacion = Organizacion::findOrFail($id);
    	$productores  = Productor::all();

    	return view('organizaciones.add',['organizacion'=>$organizacion,'productores'=>$productores]);
    }

    public function add_productor(Request $request)
    {
    	$organizacion = Organizacion::findOrFail($request->organizacion);
    	$this->validate($request,[
    		'organizacion' => 'required',
    		'productor'    => 'required'
    	]);

    	$productor = Productor::findOrFail($request->productor);
    	$productor->organizacion_id = $request->organizacion;

    	if($productor->save()){
    		return redirect('/organizaciones/'.$request->organizacion)->with([
    			'flash_class'   => 'alert-success',
    			'flash_message' => 'Productor agregado correctamente.'
    		]);
    	}else{
    		return redirect('/organizaciones/'.$request->organizacion)->with([
    			'flash_class'     => 'alert-danger',
    			'flash_message'   => 'Ha ocurrido un error.',
    			'flash_important' => true
    		]);
    	}
    }

    //Sacar al productor de la organizacion
    public function sacar(Request $request)
    {
    	$productor = Productor::findOrFail($request->productor_id);

    	$productor->organizacion_id = NULL;

    	if($productor->save()){
    		return redirect('/organizaciones/'.$request->organizacion)->with([
    			'flash_class'   => 'alert-success',
    			'flash_message' => 'Productor retirado correctamente.'
    		]);
    	}else{
    		return redirect('/organizaciones/'.$request->organizacion)->with([
    			'flash_class'     => 'alert-danger',
    			'flash_message'   => 'Ha ocurrido un error.',
    			'flash_important' => true
    		]);
    	}
    }//sacar_productor
}
