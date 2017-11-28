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
use DB;


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
        /*
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
        $sres=showfilm::where('id',$showid)->get();*/

        //获取票
        $res = DB::table('ticket')->where('status',0)->where('uid',session('uid'))->get();

        // var_dump($res);die;

        //遍历
        foreach ($res as $k => $v) {
            //用户
            $uid = $v->uid;
            $phone = DB::table('user')->where('id',session('uid'))->first();
            $v->phone = $phone->phone;

            //电影院
            $cid = $v->cid;
            $v->cinema = DB::table('cinema')->where('id',$cid)->first()->cinema;

            //电影
            $fid = $v->fid;
            $v->filmname = DB::table('film')->where('id',$fid)->first()->filmname;

            //影厅
            $rid = $v->rid;
            $v->roomname = DB::table('roominfo')->where('id',$rid)->first()->roomname;
            
            //放映
            $showid = $v->showid;
            $show = DB::table('showfilm')->where('id',$showid)->first();
            $v->showtime = $show->time;

            //座位
            $seat = $v->seat;
            //拆分字符串
            $aaa = explode('_',$seat);
            $v->hang = $aaa['0'];
            $v->lie = $aaa['1'];
        }
        // echo "<pre>";
        // var_dump($res);die;

    	return view('/homes/center',['res'=>$res]);
    }

    //未完成订单
    public function weiwc()
    {
        
        if(!session('uid')){
            
            return view('/homes/login');
            die;
        }
       

        //获取票
        $res = DB::table('ticket')->where('status',1)->where('uid',session('uid'))->get();

        // var_dump($res);die;

        //遍历
        foreach ($res as $k => $v) {
            //用户
            $uid = $v->uid;
            $phone = DB::table('user')->where('id',session('uid'))->first();
            $v->phone = $phone->phone;

            //电影院
            $cid = $v->cid;
            $v->cinema = DB::table('cinema')->where('id',$cid)->first()->cinema;

            //电影
            $fid = $v->fid;
            $v->filmname = DB::table('film')->where('id',$fid)->first()->filmname;

            //影厅
            $rid = $v->rid;
            $v->roomname = DB::table('roominfo')->where('id',$rid)->first()->roomname;
            
            //放映
            $showid = $v->showid;
            $show = DB::table('showfilm')->where('id',$showid)->first();
            $v->showtime = $show->time;

            //座位
            $seat = $v->seat;
            //拆分字符串
            $aaa = explode('_',$seat);
            $v->hang = $aaa['0'];
            $v->lie = $aaa['1'];
        }
        // echo "<pre>";
        // var_dump($res);die;

        return view('/homes/center_w',['res'=>$res]);
    }

}
