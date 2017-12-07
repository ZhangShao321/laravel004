<?php

namespace App\Http\Controllers\Film;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class FilmTicketController extends Controller
{
     //电影票
    public function index()
    {
        $cid = session('cid') ?? 1;

        $res = DB::table('showfilm')
                    ->join('roominfo', 'showfilm.rid','=','roominfo.id')
                    ->join('film', 'showfilm.fid','=','film.id')
                    ->select('showfilm.id','showfilm.price','showfilm.cid','showfilm.time','showfilm.timeout','showfilm.status','roominfo.roomname','film.filmname')
                    ->where('showfilm.cid',$cid)->where('showfilm.time','>',time())
                    ->get();
        // echo "<pre>";
        // var_dump($res);die;

        return view('/FilmAdmins/FilmTicket/index',['res'=>$res]);
    }

    //购票
    public function shop($id)
    {
        //获取放映信息
        $res = DB::table('showfilm')->where('id',$id)->first();

        //获取影厅信息
        $seat = DB::table('roominfo')->where('id',$res->rid)->first();
        //获取座位信息
        $data = DB::table('seat')->where('id',$seat->sid)->first();

        //获取座位
        $seat = $data->seat;

        $seats = explode('#',$seat); 

        // var_dump($seat);die;

        return view('/FilmAdmins/FilmTicket/shopseat', ['data'=>$data, 'id'=>$id, 'seat'=>$seats]); 
    }

    //执行售票
    public function shopseat(Request $request,$id)
    {

        $seat = $request->except('_token')['zuo'];

        if(!$seat){

            echo '请选择电影票';die;
        }

        $bbb = DB::table('ticket')->where('showid',$id)->where('seat',$seat)->get();

        if($bbb){
            echo '票已出售';die;
        }

        $res = DB::table('showfilm')->where('id',$id)->first();

        $data = array();

        $data['showid'] = $id;
        $data['uid'] = 0;
        $data['cid'] = $res->cid;
        $data['fid'] = $res->fid;
        $data['rid'] = $res->rid;
        $data['price'] = $res->price;
        $data['seat'] = $request->except('_token')['zuo'];
        $data['time'] = time();

        // $data = $request->except('_token');
        // echo json_encode($data);die;

        $aaa = DB::table('ticket')->insert($data);

        if($aaa){

            $fid = $data['fid'];
            $filmnum = DB::table('film')->where('id',$fid)->first()->shownum;
            $filmnum = $filmnum + 1;
            // echo $filmnum;
            $bbb = DB::table('film')->where('id',$fid)->update(['shownum'=>$filmnum]);

            echo '购买成功';
        }else{
            echo '购买失败';
        }

    }

    //已出售
    public function shopseat_into(Request $request,$id)
    {
        // echo 1;die;
        $res = DB::table('ticket')->where('showid',$id)->get();

        $seat = array();
        $i = 1;
        foreach($res as $k => $v){

            $seat[$i] = $v->seat;
            $i++;
        }

        echo json_encode($seat);
    }

    //订单列表
    public function list(Request $request)
    {
        //获取票
        $res = DB::table('ticket')
                ->leftjoin('showfilm','showfilm.id','=','ticket.showid')
                ->select('ticket.id','ticket.time','ticket.uid','ticket.fid','ticket.rid','ticket.cid','ticket.showid','ticket.seat','ticket.num','ticket.status','showfilm.time')
                ->where('ticket.status','=',0)
                ->where('ticket.cid',session('cid'))
                ->where('showfilm.time','>',time())
                ->where('ticket.num','like','%'.$request->input('search').'%')
                ->orderBy('ticket.time','desc')
                ->paginate($request->input('number',10));

        //遍历
        foreach ($res as $k => $v) {
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


            //座位
            $seat = $v->seat;

            //状态
            $status=$v->status;
            //拆分字符串
            $aaa = explode('_',$seat);
            $v->hang = $aaa['0'];
            $v->lie = $aaa['1'];
        }
       // echo "<pre>";
       // var_dump($res);die;
                       
        return view('FilmAdmins.Filmticket.list',['res'=>$res],['request'=>$request]);
    }


    //已放映订单
    public function list_out(Request $request)
    {
        //获取票
        $res = DB::table('ticket')
                ->leftjoin('showfilm','showfilm.id','=','ticket.showid')
                ->select('ticket.id','ticket.time','ticket.uid','ticket.fid','ticket.rid','ticket.cid','ticket.showid','ticket.seat','ticket.num','ticket.status','showfilm.time')
                ->where('ticket.status','=',0)
                ->where('ticket.cid',session('cid'))
                ->where('showfilm.time','<',time())
                ->where('ticket.num','like','%'.$request->input('search').'%')
                ->paginate($request->input('number',10));

        //遍历
        foreach ($res as $k => $v) {
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

            

            //座位
            $seat = $v->seat;

            //状态
            $status=$v->status;
            //拆分字符串
            $aaa = explode('_',$seat);
            $v->hang = $aaa['0'];
            $v->lie = $aaa['1'];
        }
       // echo "<pre>";
       // var_dump($res);die;
                       
        return view('FilmAdmins.Filmticket.list_out',['res'=>$res],['request'=>$request]);
    }
}
