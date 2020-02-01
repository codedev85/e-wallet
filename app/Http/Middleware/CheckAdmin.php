<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        dd($request);
        if(Auth::user()->role_id !== 1){

            return redirect('/home')->with('warning','You dont have permission to access this resource !');
        }
        return $next($request);
    }
}
