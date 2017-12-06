<?php

namespace App\Http\Middleware;

use Closure;

use DB;

class HomeMiddleware
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
        

        //判断平台是否开启
        $bool = DB::table('config')->first()->status;

        if($bool == 0){

            return redirect('/404');
        
        } else {
            
            return $next($request);
        }
    }
}
