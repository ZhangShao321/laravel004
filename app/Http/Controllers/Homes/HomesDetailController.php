<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\userDetail;
use App\Http\Model\user;
use App\Http\Model\film;
use DB;

class HomesDetailController extends Controller
{
    //
    public function index()
    {
        // echo 11111111;die;
    	return view('homes/detail');
    }

    public function store(Request $request)
    {
    	//  if(!session('uid')){
    		
    	// 	return view('/homes/login');
    	// 	die;
    	// }

    	$result = $request->except('_token','phone');

    	$result['uid'] = session('uid');
    	 // dd($res);die;
    	if($request -> hasFile('photo'))
        {

           //文件名
            $name = rand(11111,99999).time();

            //获取后缀名
            $jpg = $request -> file('photo')->getClientOriginalExtension();
          
            //移动图片
            $request ->file('photo') -> move('./public/userDetail/Uploads',$name.'.'.$jpg); 
        }  

        $photo = './public/userDetail/Uploads/'.$name.$name.'.'.$jpg;
        $result['photo'] = $photo;

        userDetail::insert($result);

        $res = film::orderBy('shownum','desc')->limit('3')->get();

        return view('/homes/index',['result'=>$result,'res'=>$res]);



    }
}
