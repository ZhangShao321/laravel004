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
         
        //获取票
<<<<<<< HEAD
        $res = DB::table('ticket')->where('status',0)->where('uid',session('uid'))->get();
=======
        $res = DB::table('ticket')->where('uid',session('uid'))->get();
>>>>>>> 2f72f0f526cc181109b89a3fd15c536815615219

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

    	return view('/homes/center',['res'=>$res]);
    }

<<<<<<< HEAD
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

    //未完成订单自动取消
    public function dodel(Request $request)
    {
        //获取id
        $id = $request->only('id')['id'];
        //删除信息
        $data = DB::table('ticket')->where('id',$id)->delete();

        if ($data) {

            echo 1;
        } else {
            echo 0;
        }
=======

    public function delete($id)
    {

        $aaa='1';

        $res1 = DB::table('ticket')->where('id',$id)->update(['status'=>$aaa]);
         
        if($res1)
        {
            return redirect('/homes/center')->with('msg','删除成功');
        }else{
            return redirect('/homes/center')->with('msg','删除失败'); 
        }
        
>>>>>>> 2f72f0f526cc181109b89a3fd15c536815615219

    }

}
