<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

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

        if (! Auth::guard($guard)->user()->isAdmin()) {
            # code...
            return response('no perteneces aquí', 401);
        }
        //dd(Auth::guard($guard)->user());
        return $next($request);
    }
}
