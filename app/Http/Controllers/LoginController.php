<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Productor;
use App\Ciclo;

class LoginController extends Controller
{
    public function index()
    {
    	$productores = Productor::all();
    	$ciclos      = Ciclo::all();
 			return view('dashboard',['productores'=>$productores,'ciclos'=>$ciclos]);
	 }

	public function login()
	{
		return view('login');
	}


	 public function auth(Request $request)
	 {
    	$this->validate($request, [
    		'email' =>'required|email',
    		'password' => 'required|max:8',
    		]);

      if (Auth::attempt($request->only(['email' , 'password']))){
      	return redirect()->intended('dashboard');
      }else{
      	return redirect()->route('login')->withErrors('An error has occurred, check your credentials');
      }
	 }

	 public function logout()
	 {
	 	Auth::logout();
	 	return view('login');

	 }
    
}
