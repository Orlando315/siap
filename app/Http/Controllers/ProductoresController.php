<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Tecnico;
use App\Productor;

class ProductoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $productor = Productor::all();
    	return view("productores.index",["productores"=>$productor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$tecnicos = Tecnico::all();
      return view("productores.create", ["tecnicos" => $tecnicos]);
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
    		'tecnico'         => 'required',
    		'nombres'        => 'required',
    		'apellidos'      => 'required_if:tipo,V',
        'tipo'           => 'required',
        'identificacion' => 'required|numeric|unique:productores',
    		'email'          => 'required|email|unique:productores',
    		'estado'         => 'required',
    		'tlf_personal'   => 'required|numeric',
        'tlf_oficina'    => 'nullable|numeric',
        'tlf_administracion' => 'nullable|numeric',
    	]);

    	$productor = new Productor;
      $productor->fill($request->all());
      $productor->tecnico_id = $request->input('tecnico');

    	if($productor->save()){
      	return redirect("productores")->with([
            "flash_message" => "Productor agregado correctamente.",
            "flash_class"   => "alert-success"
          ]);
      }else{
      	return redirect("productores")->with([
          "flash_message"   => "Ha ocurrido un error.",
          "flash_class"     => "alert-danger",
          "flash_important" => true
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
      $productor = Productor::findOrFail($id);
      $unidades  = $productor->unidades();

      return view("productores.view",["productor" => $productor,"unidades"=>$unidades]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $productor = Productor::findOrFail($id);
      $tecnicos  = Tecnico::all();
      return view("productores.edit", ["productor" => $productor,'tecnicos'=>$tecnicos]);
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
        $productor = Productor::findOrFail($id);

        $this->validate($request, [
	        "tecnico"        => "required",
	        "nombres"        => "required",
	    		"apellidos"      => "required_if:tipo,V",
	        "tipo"           => "required",
	        "identificacion" => "required|numeric|unique:productores,identificacion,".$id.",id",
	        "email"          => "required|email|unique:productores,email,".$id.",id",
	        "estado"         => "required",
	        "tlf_personal"   => "required|numeric",
	        "tlf_oficina"    => "nullable|numeric",
	        "tlf_administracion" => "nullable|numeric",
        ]);

        $productor->fill($request->all());
      	$productor->tecnico_id = $request->input('tecnico');

        if($productor->save()){
          return redirect("productores/")->with([
            "flash_message" => "Productor editado correctamente.",
            "flash_class"   => "alert-success"
          ]);
        }else{
          return redirect("productores/")->with([
            "flash_message"   => "Ha ocurrido un error.",
            "flash_class"     => "alert-danger",
            "flash_important" => true
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
      $productor = Productor::findOrFail($id);

      if($productor->unidades_qty()===0){
      	if($productor->delete()){
	      	return redirect('productores')->with([
	      			'flash_class' => 'alert-success',
	      			'flash_message' => 'Productor eliminado con exito.'
	      		]);
	      }else{
	      	return redirect('productores/'.$id)->with([
	      			'flash_class' => 'alert-danger',
	      			'flash_message' => 'Ha ocurrido un error.',
	      			'flash_important' => true
	      		]);
	      }
      }else{
      	return redirect('productores/'.$id)->with([
      			'flash_class' => 'alert-danger',
      			'flash_message' => 'El Productor tiene unidades registradas.',
      			'flash_important' => true
      		]);
      }
    }
}
