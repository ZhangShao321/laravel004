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

use Illuminate\Support\Facades\Redis;


use Session;

class HomesCenterController extends Controller
{
    //个人订单
     public function index()
    {
    	
    	if(!session('uid')){
    		
    		return view('/homes/login');
    		die;
    	}
         
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

            //电影院地址
            $v->address = DB::table('cininfo')->where('cid',$cid)->first()->address;

            //电影
            $fid = $v->fid;
            $v->filmname = DB::table('film')->where('id',$fid)->first()->filmname;

            //影厅
            $rid = $v->rid;
            $v->roomname = DB::table('roominfo')->where('id',$rid)->first()->roomname;
            
            //放映
            $showid = $v->showid;
            $show = DB::table('showfilm')->where('id',$showid)->first();
            // var_dump($show);die;
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


    //未完成订单
    public function weiwc()
    {
        
        if(!session('uid')){
            
            return view('/homes/login');
            die;
        }
       

        //获取票
        // $res = DB::table('ticket')->where('status',1)->where('uid',session('uid'))->get();
        $res = Redis::keys('seat_*');
        // var_dump($res);die;
        $arr = array();
        foreach ($res as $kk => $vv) {

            $arr[$kk] = Redis::hgetall($vv);
        }

        //去掉非本用户的订单
        $data = array();
        foreach ($arr as $key => $value) {
            if($value['uid'] != session('uid')){
                unset($arr[$key]);
            } else {

                $data[$key] = $value;
            }
        }

        //排序
        sort($data);
        
        $aaaa = array();

        //遍历
        foreach($data as $k => $v){

            //用户
            $uid = $v['uid'];
            $phone = DB::table('user')->where('id',$uid)->first();
            $v['phone'] = $phone->phone;
            $aaaa[$k]['phone'] = $phone->phone;

            //电影院
            $cid = $v['cid'];
            $cinema = DB::table('cinema')->where('id',$cid)->first();
            $v['cinema'] = $cinema->cinema;
            $aaaa[$k]['cinema'] = $cinema->cinema;
            //电影
            $fid = $v['fid'];
            $filmname = DB::table('film')->where('id',$fid)->first();
            $v['filmname'] = $filmname->filmname;
            $aaaa[$k]['filmname'] = $filmname->filmname;

            //影厅
            $rid = $v['rid'];
            $roomname = DB::table('roominfo')->where('id',$rid)->first();
            $v['roomname'] = $roomname->roomname;
            $aaaa[$k]['roomname'] = $roomname->roomname;
            
            //放映
            $showid = $v['showid'];
            $show = DB::table('showfilm')->where('id',$showid)->first();
            $v['showtime'] = $show->time;
            $aaaa[$k]['showtime'] = $show->time;

            //座位
            $seat = $v['seat'];
            //拆分字符串
            $aaa = explode('_',$seat);
            $v['hang'] = $aaa['0'];
            $v['lie'] = $aaa['1'];
            $aaaa[$k]['hang'] = $aaa['0'];
            $aaaa[$k]['lie'] = $aaa['1'];
        }
        // echo "<pre>";
        // var_dump($aaaa);
        // var_dump($data);die;

        return view('/homes/center_w',['res'=>$data,'aaaa'=>$aaaa]);
    }



    //修改订单状态
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

    //删除未付款订单
    public function dodel(Request $request)
    {

        $num = $request->only('num')['num'];

        $num = 'seat_'.$num;

        // echo json_encode($num);die;

        $bool = Redis::del($num);

        if($bool) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
