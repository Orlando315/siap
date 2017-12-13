<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planificacion;
use App\Productor;

class PlanificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$planificaciones = Planificacion::all();
      return view('planificaciones.index',['planificaciones'=>$planificaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $productores = Productor::all();
      return view('planificaciones.create',['productores'=>$productores]);
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
      	'productor_id' => 'required|numeric',
      	'lote' => 'required|numeric',
      	'fecha_siembra' => 'required',
      	'superficie' => 'nullable|numeric',
      	'fecha_vm' => 'requried',
      	'sup_planeada' => 'nullable|numeric'
      ]);

      $planificacion = new Planificacion;
      $planificacion->fill($request->all());
      $planificacion->lote_id = $request->lote;
      $planificacion->fecha_siembra = date('Y-m-d',strtotime($request->fecha_siembra));
      $planificacion->fecha_vm = date('Y-m-d',strtotime($request->fecha_vuelo));

      if($planificacion->save()){
      	return redirect('/planificaciones')->with([
      		'flash_class'   => 'alert-success',
      		'flash_message' => 'Planificacion agregada con exito.'
      	]);
      }else{
      	return redirect('/planificaciones')->with([
      		'flash_class'     => 'alert-success',
      		'flash_message'   => 'Planificacion agregada con exito.',
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
    	$planificacion = Planificacion::findOrFail($id);
      return view('planificaciones.view',['planificacion'=>$planificacion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $planificacion = Planificacion::findOrFail($id);
      return view('planificaciones.edit',['planificacion'=>$planificacion]);
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
      $planificacion = Planificacion::findOrFail($id);

      $this->validate($request,[
      	'productor_id' => 'required|numeric',
      	'lote' => 'required|numeric',
      	'fecha_siembra' => 'required',
      	'superficie' => 'nullable|numeric',
      	'fecha_vm' => 'requried',
      	'sup_planeada' => 'nullable|numeric'
      ]);
      $planificacion->fill($request->all());

      if($planificacion->save()){
      	return redirect('/planificaciones')->with([
      		'flash_class'     => 'alert-success',
      		'flash_message'   => 'Planificacion actualizada con exito.'
      	]);
      }else{
      	return redirect('/planificaciones')->with([
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
      $planificacion = Planificacion::findOrFail($id);

      if($planificacion->destroy()){
      	return redirect('/planificaciones')->with([
      		'flash_class'     => 'alert-success',
      		'flash_message'   => 'Planificacion eliminada con exito.'
      	]);
      }else{
      	return redirect('/planificaciones')->with([
      		'flash_class'     => 'alert-danger',
      		'flash_message'   => 'Ha ocurrido un error',
      		'flash_important' => true
      	]);
      }
    }

    public function search(Request $request)
    {
    	return response()->json("s");
    }
}
