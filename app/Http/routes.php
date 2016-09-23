<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

/*
* creamos una ruta para poder acceder al login
*/
Route::group(['middleware' => 'cors'], function(){
	Route::post('/auth_login', 'ApiAuthController@UserAuth');
});

 /*
 *  grupo de rutas para un administrador
 */
 Route::group(['prefix' => 'admin', 'middleware' => 'is_admin'], function(){
 	//function anonima
 	Route::resource('bitacora', 'BinnacleController@index');
 });

