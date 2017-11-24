<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\user;

use Hash;
use DB;


class HomesLoginController extends Controller
{
    //
    public function index()
    {
    	return view('homes/login');
    }

    public function dologin(Request $request)
    {
        
        $res = $request->except('_token');
        $res = $request->input('phone');
        // var_dump($res);

    	$uname = user::where('phone',$res)->first();
        // var_dump($uname);die;
       
        $pass = Hash::check($request->input('password'),$uname->password);
        // $pass = Hash::check($a,$b);
        if ($uname && $pass ){
            
            // 将用户数据保存至session中
            $request->session()->put('uid', $uname->id);

             
            // 跳转至首页
            return redirect('/homes/index');
        } else {
            // 返回登录页(带提示信息）
            return redirect('/home/login')->with('status', '用户名或密码错误，请重新登录。');
        }


         

    }

}
