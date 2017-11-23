<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\userDetail;
use App\Http\Model\user;
use DB;

class HomesDetailController extends Controller
{
    //
    public function index()
    {
    	return view('homes/detail');
    }

    public function store(Request $request)
    {
    	 
    	 $res = $request->except('_token');
    	 // dd($res);die;
    	 if($request -> hasFile('license'))
        {

           //文件名
            $name = rand(11111,99999).time();

            //获取后缀名
            $jpg = $request -> file('license')->getClientOriginalExtension();
          
            //移动图片
            $request ->file('license') -> move('./public/UserDetail/Uploads',$name.'.'.$jpg); 
        }  

        $license = './public/UserDetail/Uploads/'.$name.$name.'.'.$jpg;
        $res['license'] = $license;

    }
}
