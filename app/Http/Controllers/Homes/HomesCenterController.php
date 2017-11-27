<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\ticket;
use App\Http\Model\user;
use App\Http\Model\cinema;
use App\Http\Model\film;
use App\Http\Model\roominfo;
use App\Http\Model\showfilm;


use Session;

class HomesCenterController extends Controller
{
    //
     public function index()
    {
    	
    	if(!session('uid')){
    		
    		return view('/homes/login');
    		die;
    	}

        $uid = session('uid');
        // dd($uid);die;

        $res=ticket::where('uid',$uid)->get();
        $cid= $res['0']->cid;
        $rid= $res['0']->rid;
        $fid= $res['0']->fid;
        $showid= $res['0']->showid;

        $cres=cinema::where('id',$cid)->get();
        $rres=roominfo::where('id',$rid)->get();
        $fres=film::where('id',$fid)->get();
        $sres=showfilm::where('id',$showid)->get();
          

    	return view('/homes/center',['res'=>$res,'res1'=>$cres,'res2'=>$rres,'res3'=>$fres,'res4'=>$sres]);
    }

}
