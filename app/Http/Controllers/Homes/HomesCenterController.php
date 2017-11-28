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
        $res = DB::table('ticket')->where('uid',session('uid'))->get();

        // var_dump($res);die;

        //遍历
        foreach ($res as $k => $v) {
            //用户
            $uid = $v->uid;
            $phone = DB::table('user')->where('id',$uid)->first();
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
        

    }

}
