<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\ticket;
use App\Http\Model\user;
use App\Http\Model\cinema;
use App\Http\Model\money;
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

    	if(0 < $money ){


	    	$res = DB::table('ticket')->where('uid',session('uid'))->first();

	    	$cid = $res->cid;

	    	$res1 = DB::table('money')->where('cid',$cid)->first();
	    	// var_dump($res1);die;

	    	$id = $res1->cid;
	    	$money1 = $res1->money;
	 

	    	$res1 = $money + $money1;
	    	
	    	$res2['money'] = $res1;
	    	// $res2['id']  = 
	    	 
	    	$res3 = DB::table('money')->where('cid',$id)->update($res2);

	    	if($res3){
	    		return redirect('homes/moneys')->with('msg','充值成功!!');
	    	}else{
	    		return redirect('homes/moneys')->with('msg','充值失败,请重新操作!!');
	    	}
	    }else{
	    	return redirect('homes/moneys')->with('msg','充值数额不正确,请重新操作!');
	    }
    }


    public function store()
    {
    	$res = DB::table('ticket')->where('uid',session('uid'))->first();

	    $cid = $res->cid;

	    $res1 = DB::table('money')->where('cid',$cid)->get();

    	return view('homes/balance',['res1'=>$res1]);
    }
}
