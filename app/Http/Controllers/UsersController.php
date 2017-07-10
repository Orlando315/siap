<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Bitacora;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::all();
    	return view('users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'nombres' => 'required',
          'apellidos' => 'required',
          'email' =>'required|email|unique:users',
          'password' => 'required|min:6|max:15|confirmed',
          'password_confirmation' => 'required|min:6|max:15|same:password'
          ]);

        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));

      if($user->save()){
          return redirect("users")->with([
            'flash_message' => 'Usuario agregado correctamente.',
            'flash_class' => 'alert-success'
            ]);
      	}else{
          return redirect("users")->with([
              'flash_message' => 'Ha ocurrido un error.',
              'flash_class' => 'alert-danger',
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
      $user = user::findOrFail($id);
      return view("users.view", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = user::findOrFail($id);
      return view("users.edit", ["user" => $user]);
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
        $user = User::findOrFail($id);

        $this->validate($request, [
          'nombres' => 'required',
          'apellidos' => 'required',
          'email' =>'required|email|unique:users,email,'.$user->email.",id",
          'password' => 'required|min:6|max:15|confirmed',
          'password_confirmation' => 'required|min:6|max:15|same:password'
          ]);

        $user->fill($request->all());

        if($user->save()){
            return redirect("users")->with([
              'flash_message' => 'Usuario agregado correctamente.',
              'flash_class' => 'alert-success'
              ]);
          }else{
            return redirect("users")->with([
                'flash_message' => 'Ha ocurrido un error.',
                'flash_class' => 'alert-danger',
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

        $user = User::findOrFail($id);

       //Registro en la bitaora
          $bitacora = New Bitacora;
          $bitacora->usuario = Auth::user()->email;
          $bitacora->modulo = 'Usuarios';
          $bitacora->accion = 'Se elemino el usuario '.$user->email;
          $bitacora->save();
          // fin bitacora
          
        if($user->delete()){
        return redirect("users")->with([
            'flash_message' => 'Usuario eliminado correctamente.',
            'flash_class' => 'alert-success'
            ]);
      }else{
        return redirect("users")->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
          ]);
      }
    }

    public function perfil(){
    	$perfil = User::findOrFail(Auth::user()->id);
    	return view('perfil',['perfil'=>$perfil]);
    }

    public function update_perfil(Request $request)
    {
    	$user = User::find(Auth::user()->id);

      $this->validate($request, [
        'nombres' => 'required',
        'apellidos' => 'required',
        'email' =>'required|email|unique:users,email,'.$user->id.',id'
        ]);
      if($request->input('checkbox') === "Yes"){
      	$this->validate($request,[
          'password' => 'required|min:6|max:15|confirmed',
          'password_confirmation' => 'required|min:6|max:15|same:password'
    		]);
  			$user->password = bcrypt($request->input('password'));
      }

    	$user->fill($request->all());

    	if($user->save()){
        return redirect("perfil")->with([
            'flash_message' => 'Cambios guardados correctamente.',
            'flash_class' => 'alert-success'
            ]);
    	}else{
        return redirect("perfil")->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
          ]);
    	}
    }
}
