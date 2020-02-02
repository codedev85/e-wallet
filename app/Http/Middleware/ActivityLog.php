<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use Carbon\Carbon;


class ActivityLog
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
        if(Auth::check()){

            User::where('id',Auth::user()->id)->update([
                'logs'=> Carbon::now(),
            ]);
        }
        return $next($request);
    }
}
