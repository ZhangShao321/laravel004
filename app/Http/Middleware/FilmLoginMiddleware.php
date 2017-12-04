<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class FilmLoginMiddleware
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
        $id = session('cid');

         //判断平台是否开启
        $bool = DB::table('config')->first()->status;

        if($bool == 0){

            return redirect('/404');
        }

        if($id){

            $ip = $request->ip();

            $str = '['.date('Y-m-d H:i:s',time()).']::ip地址'.$ip."\r\n";

            file_put_contents('FileLoginid.txt',$str,FILE_APPEND);

            return $next($request);
        } else {
            
            return redirect("/FilmAdmins/FilmLogin");

        }




    }
}
