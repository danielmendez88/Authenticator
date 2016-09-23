<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class Istype
{
    /**
     * @var Guard
     */
    private $auth;

    public function __construct(Guard $auth)
    {
        # code...
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($request->user() === null) {
            # code...
           return redirect()->guest('login');
        }

        switch (Auth::guard($guard)->user()->isAdmin()) {
            case 'miembro':
                # code...
                return Response(view('mensajes.msj_restric')->with('msj','No tienes permisos para acceder a este contenido, sólo administradores pueden ingresar.'));
                break;
            
            default:
                # code...
                return $next($request);
                break;
        }

    }
}
