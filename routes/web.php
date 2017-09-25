<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','LoginController@login')->name('login');
Route::post('auth', 'LoginController@auth')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');

//VIEWS ADMIN
//verificar rutas con permiso auth
Route::group(['middleware' => 'auth'],function(){
	Route::get('dashboard', 'LoginController@index')->name('index');
	//Usuarios
	Route::get('perfil','UsersController@perfil')->name('perfil');
	Route::patch('perfil','UsersController@update_perfil')->name('update_perfil');
	Route::resource('/users','UsersController');
	//Tecnicos
	Route::get('/tecnicos/add/{id}','TecnicosController@add')->name('tecnicos.add');
	Route::resource('/tecnicos','TecnicosController');

	//Productores
	Route::resource('/productores','ProductoresController');
	//Bitacora
	Route::get('/bitacora','BitacoraController@index')->name('bitacora.index');
	//Ciclos
	Route::get('/ciclos/add/{id}','CiclosController@add')->name('ciclos.add');
	Route::post('/ciclos/add/','CiclosController@add_unidad')->name('ciclos.add_unidad');
	Route::patch('/ciclos/cerrar/{id}','CiclosController@cerrar')->name('ciclos.cerrar');
	Route::get('/ciclos/search','CiclosController@search')->name('ciclos.search');
	Route::get('/ciclos/{id}/tecnico/{tecnico?}','CiclosController@show')->name('ciclos.tecnico');
	Route::post('/ciclos/search/{render?}','CiclosController@searchProductores')->name('ciclos.searchProductores');
	Route::resource('/ciclos','CiclosController');
	//Unidades
	Route::post('/unidades/search','UnidadesController@search')->name('unidades.search');
	Route::get('/unidades/create/{id}','UnidadesController@create');
	Route::resource('/unidades','UnidadesController');
	//lotes
	Route::post('/lotes/search','LotesController@search')->name('lotes.search');
	Route::get('/lotes/create/{id}','LotesController@create');
	Route::resource('/lotes','LotesController');
	//Actividad
	Route::patch('/actividad','ActividadesController@avanzar')->name('actividad.avanzar');
	//Organizaciones
	Route::resource('/organizaciones','OrganizacionesController');
	//Planificaciones
	Route::post('/planificaciones/search','PlanificacionesController@search')->name('planificaciones.search');
	Route::resource('/planificaciones','PlanificacionesController');

	//Reportes
	Route::get('/reportes/tecnicos','ReportesController@tecnicos')->name('reportes.tecnicos');
	Route::get('/reportes/tecnicos/{id}','ReportesController@tecnico')->name('reportes.tecnico');
	Route::get('/reportes/productores','ReportesController@productores')->name('reportes.productores');
	Route::get('/reportes/productores/{id}','ReportesController@productor')->name('reportes.productor');
	Route::post('/reportes/ciclo','ReportesController@custom')->name('reportes.customCiclo');
	Route::get('/reportes/ciclo/{id}/{tecnico?}','ReportesController@ciclo')->name('reportes.ciclo');
	Route::get('/reportes/organizaciones','ReportesController@organizaciones')->name('reportes.organizaciones');
	Route::get('/reportes/organizacion/{id}','ReportesController@organizacion')->name('reportes.organizacion');

	//TESTER
	Route::get('/test','CiclosController@test');
});