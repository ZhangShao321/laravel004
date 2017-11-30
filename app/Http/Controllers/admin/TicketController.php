<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\model\ticket;
use App\Http\Model\user;
use App\Http\Model\cinema;
use App\Http\Model\roominfo;
use App\Http\Model\film;
use DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   


        //获取票
        $res = DB::table('ticket')
                ->where('num','like','%'.$request->input('search').'%')
                ->where('status','=',0)
                ->paginate($request->input('number',10));

        //遍历
        foreach ($res as $k => $v) {
            //用户
            $uid = $v->uid;

            if($uid == 0){
                $v->nickName = '电影院直售';
            } else {
                $v->nickName = DB::table('userDetail')->where('uid',$uid)->first()->nickName;
            }     

            $v->nickName = DB::table('userDetail')->where('uid',$uid)->first()->nickName;
            // var_dump($v->nickName);die;
            // $ = $phone->phone;

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

            //状态
            $status=$v->status;
            //拆分字符串
            $aaa = explode('_',$seat);
            $v->hang = $aaa['0'];
            $v->lie = $aaa['1'];
        }
       
                       
        return view('admin.ticket.index',['res'=>$res],['request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //直接删除ticket表里的信息
        $sql=ticket::find($id)->delete();
        if($sql){
            return redirect('/admin/ticket');
        }else{
            echo "删除失败";
        }



    }




    //订单放入回收站和恢复方法
    public function huishou(Request $request)
    {       

           $data = $request->except('_token');
           // var_dump($data);
             if($data['status'] == '1'){

            $res1 = DB::table('ticket')->where('id',$data['id'])->update(['status'=>0]);
            if($res1){
                echo '1';
            }else{
                echo '0';
            }
        }else if($data['status'] == '0'){
            $res2 = DB::table('ticket')->where('id',$data['id'])->update(['status'=>1]);
            if($res2){
                echo '2';
            }else{
                echo '0';
            }
        }

    }




    //加载回收站页面
    public function hspage(Request $request)
    {
           //获取票
        $res = DB::table('ticket')
                ->where('num','like','%'.$request->input('search').'%')
                ->where('status','=',1)
                ->paginate($request->input('number',10));

        //遍历
        foreach ($res as $k => $v) {
            //用户
            $uid = $v->uid;
            $v->nickName = DB::table('userDetail')->where('uid',$uid)->first()->nickName;

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

            //状态
            $status=$v->status;
            //拆分字符串
            $aaa = explode('_',$seat);
            $v->hang = $aaa['0'];
            $v->lie = $aaa['1'];
        }
       
                       
        return view('admin.ticket.huishou',['res'=>$res],['request'=>$request]);
    }



}

    


