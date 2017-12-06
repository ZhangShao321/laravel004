<?php

namespace App\Http\Controllers\Film;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class SeachController extends Controller
{
    //执行搜索
    public function seach(Request $request)
    {
        $phone = $request->only('phone')['phone'];

        if($phone){
        	//获取用户id
        	$data = DB::table('user')->where('phone',$phone)->first();
        	//获取用户订单
        	$tic = DB::table('ticket')
        			->where('uid',$data->id)
        			->where('cid',session('cid'))
        			->where('status',0)
        			->orderBy('time','desc')
        			->paginate(10);


        	foreach ($tic as $k => $v) {
	            //用户
	            $uid = $v->uid;

	            if($uid == 0){
	                $v->phone = '电影院直售';
	                $v->nick = 'www';
	            } else {
	                $phone = DB::table('user')->where('id',$uid)->first();
	                $v->phone = $phone->phone ?? '该用户已不存在';

	                $names = DB::table('userDetail')->where('uid',$uid)->first();
	                $v->nick = $names->nickName ?? '该用户已不存在';
	            }


	            
	            //电影
	            $fid = $v->fid;
	            $v->filmname = DB::table('film')->where('id',$fid)->first()->filmname ?? '该电影已不存在';

	            //影厅
	            $rid = $v->rid;
	            $v->roomname = DB::table('roominfo')->where('id',$rid)->first()->roomname ?? '该影厅已不存在';
	            
	            //放映
	            $showid = $v->showid;
	            $show = DB::table('showfilm')->where('id',$showid)->first();
	            $v->showtime = $show->time ?? 0;
	            $v->price = $show->price ?? 0;

	            //座位
	            $seat = $v->seat;

	            //状态
	            $status=$v->status;
	            //拆分字符串
	            $aaa = explode('_',$seat);
	            $v->hang = $aaa['0'];
	            $v->lie = $aaa['1'];
	        }

	        return view('FIlmAdmins.seach.list',['res'=>$tic,'request'=>$request]);
        } else {

        	return back();
        }

        
    }

    //取消订单
    public function delete(Request $request)
    {
    	$id = $request->only('id')['id'];

    	$bool = DB::table('ticket')->where('id',$id)->delete();

    	if($bool){

    		
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
}
