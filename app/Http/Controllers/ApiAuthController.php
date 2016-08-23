<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends Controller
{
    //creamos una función para solicitar al usuario 
    public function UserAuth(Request $request)
    {
    	# code...
    	$credentials = $request->only('email', 'password');
    	$token = null;

    	#creamos una excepción para

    	try {
    		if (!$token = JWTAuth::attempt($credentials)) {
    			# code...
    			return response()->json(['error'=> 'invalid_credentials']);
    		}
    	} catch (JWTException $ex) {
    		//para enviarlo y en el debugger del navegador y poder manipularlo con Angular
    		return response()->json(['error'=>'something_went_wrong'], 500);
    	}

    	return response()->json(compact('token'));
    }
}
