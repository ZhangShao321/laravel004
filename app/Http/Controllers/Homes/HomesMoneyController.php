<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\userDetail;
use App\Http\Model\user;
use DB;

class HomesMoneyController extends Controller
{
    //
    public function index()
    {
    	return view('/homes/money');
    }

    public function add(Request $request)
    {
    	$money = $request->input('money');

    	if($money > 0){
	    	$res = DB::table('userDetail')->where('uid',session('uid'))->first();

	    	// var_dump($res);
	    	$money1 = $res->umoney;

	    	$moneys['umoney'] = $money1 + $money;

	    	$res1 = DB::table('userDetail')->where('uid',session('uid'))->update($moneys);

	    	if($res1){
	    		return redirect('/homes/moneys')->with('msg','充值成功!!!');
	    	}else{
	    		return redirect('/homes/moneys')->with('msg','充值失败!!!');
	    	}
	    }else{

	    	return redirect('/homes/moneys')->with('msg','充值数额不正确,请重新操作!!!');

	    }




    	 
    }


    public function store()
    {
    	$res = DB::table('userDetail')->where('uid',session('uid'))->first();

    	// var_dump($res);die;

    	return view('homes/balance',['res'=>$res]);
    }
}
