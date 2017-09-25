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
      $planificacion->fecha_vm = $request->fecha_vuelo;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function search(Request $request)
    {
    	return response()->json("s");
    }
}
