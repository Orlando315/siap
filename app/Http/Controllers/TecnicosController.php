<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tecnico;
use App\Productor;

class TecnicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tecnicos = Tecnico::all();

      return view('tecnicos.index',['tecnicos'=>$tecnicos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('tecnicos.create');
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
      		'nombres' => 'required',
      		'apellidos' => 'required',
      		'email' => 'required|email|unique:tecnicos',
      		'cedula' => 'required|numeric|unique:tecnicos',
      		'estado' => 'required',
      		'tlf_personal' => 'required|numeric',
      		'tlf_opcional' => 'nullable|numeric'
      	]);

      $tecnico = new Tecnico;

      $tecnico->fill($request->all());

      if($tecnico->save()){
      	return redirect('/tecnicos')->with([
      		'flash_class'   => 'alert-success',
      		'flash_message' => 'Tecnico agredado con exito.'
      		]);
      }else{
      	return redirect('/tecnicos')->with([
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
    	$tecnico = Tecnico::findOrFail($id);
    	$productores = $tecnico->productores();
    	//dd($ciclos);
    	return view('tecnicos.view',['tecnico'=>$tecnico,'productores'=>$productores]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$tecnico = Tecnico::findOrFail($id);
    	return view('tecnicos.edit',['tecnico'=>$tecnico]);
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
    	$tecnico = Tecnico::findOrFail($id);

    	$this->validate($request,[
      		'nombres' => 'required',
      		'apellidos' => 'required',
      		'email' => 'required|email|unique:tecnicos,email,'.$id.',id',
      		'cedula' => 'required|numeric|unique:tecnicos,cedula,'.$id.',id',
      		'estado' => 'required',
      		'tlf_personal' => 'required|numeric',
      		'tlf_opcional' => 'nullable|numeric'
    		]);

    	$tecnico->fill($request->all());

    	if($tecnico->save()){
    		return redirect('/tecnicos')->with([
    				'flash_class'   => 'alert-success',
    				'flash_message' => 'Cambios realizados con exito.'
    			]);
    	}else{
    		return redirect('/tecnicos')->with([
    				'flash_class'   => 'alert-danger',
    				'flash_message' => 'Ha ocurrido un error.',
    				'flash_important' => true
    			]);
    	}
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
    }

    public function add($id)
    {

    }
}
