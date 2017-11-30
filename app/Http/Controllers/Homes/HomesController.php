<?php

namespace App\Http\Controllers\Homes;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use DB;

//数据库
use App\Http\Model\cinema;
use App\Http\Model\cininfo;
use App\Http\Model\film;
use App\Http\Model\showfilm;
use App\Http\Model\lunbo;
use App\Http\Model\seat;
use App\Http\Model\money;
use App\Http\Model\ticket;

//Redis
use Illuminate\Support\Facades\Redis;

//七牛
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use zgldh\QiniuStorage\QiniuStorage;

class HomesController extends Controller
{

    //1.电影院首页
    public function index()
    {   
        //热映电影数据
        $res = film::join('showfilm','film.id','=','showfilm.fid')
                    ->select('film.filepic','film.summary','film.id','film.filmname','film.director','film.price')
                    ->where('showfilm.status','1')
                    ->orderBy('shownum','desc')
                    ->limit('10')->get();
            //去除重复电影
            $z = array();

            foreach ($res as $k => $v) {

                $x = in_array($v->id,$z);
               
                if($x){

                    unset($res[$k]);
                }

                $z[$k] = $v->id;
     
            }

        //轮播图数据
        $res1 = lunbo::get();

        //即将上映电影数据
        // $res2 = film::where('status','1')->where('showtime','>',time())->limit('4')->get();
        $res2 = film::where('showtime','>',time())->limit('4')->get();

        //加载前台首页
        return view('homes/index',['res' => $res,'res1' => $res1,'res2' => $res2]);
    }



    //2.电影列表页面
    public function filmlist()
    {
        //电影类型数据
        $type = DB::table('filmtype')->where('status','0')->get();

        //电影排行榜数据
        $res1 = film::join('showfilm','film.id','=','showfilm.fid')
                    ->where('film.status','1')
                    ->where('showfilm.status','1')
                    ->select('film.filmname','film.shownum','film.id')
                    ->orderBy('film.shownum','desc')
                    ->limit('10')->get();

            //去除重复电影
            $bbb = array();

            foreach ($res1 as $k => $v) {

                $x = in_array($v->id,$bbb);

                if($x){

                    unset($res1[$k]);
                }

                $bbb[$k] = $v->id;
     
            }

        //电影列表数据
        $res = film::join('showfilm','film.id','=','showfilm.fid')
                    ->select('film.summary','film.id','film.cid','showfilm.timeout','showfilm.cid','showfilm.price','film.filepic','film.shownum','film.director','film.filmname')
                    ->where('showfilm.timeout','>',time())
                    ->where('film.status','1')
                    ->orderBy('shownum','desc')->paginate(3);

            //去除重复电影
            $aaaa = array();

            foreach ($res as $key => $value) {

                $x = in_array($value->id,$aaaa);

                if($x){

                    unset($res[$key]);
                }

                $aaaa[$key] = $value->id;
     
            }

       //加载电影列表
        return view('homes/filmlist',['res' => $res,'res1'=>$res1,'type'=>$type]);
    }



    //3.电影详情页面
    public function filmdetail(Request $request)
    {

        //电影详情数据
        $aaa = film::find($request->id);

        //上映此电影的电影院数据
        $bbb = film::where('filmname',$aaa->filmname)
                ->join('showfilm','film.id','=','showfilm.fid')
                ->join('cinema','showfilm.cid','=','cinema.id')
                ->join('cininfo','cinema.id','=','cininfo.cid')
                ->select('showfilm.id','showfilm.time','cinema.cinema','cininfo.city','cininfo.area','cininfo.address')
                ->where('cinema.status','2')
                ->get();

        //加载电影详情页面
        return view('homes/filmdetail',['aaa' => $aaa,'bbb' => $bbb]);
    }



    //4.电影院列表页面
    public function cinemalist()
    {
        //电影院列表数据
        $res = cinema::where('status','2')->paginate(2);

        //加载电影院列表页面
        return view('homes/cinemalist',['res' => $res]);
    }



    //5.电影院详情
    public function cinemadetail(Request $request)
    {
        //电影院详情数据 
        $id = implode($request->only('id'));
        $res = cinema::find($request->only('id'));
        $res1 = cininfo::where('cid',$id)->get();

        //该影院上映的电影数据
        $res2 = showfilm::where('showfilm.cid','=',$id)
                        ->join('film','film.id','=','showfilm.fid')
                        ->select('film.filmname','film.filepic','film.price','showfilm.id','showfilm.time','showfilm.timeout')
                        ->where('film.status','1')
                        ->where('showfilm.timeout','>',time())
                        ->get();

        //加载电影院详情页面
        return view('homes/cinemadetail',['res' => $res,'res1' => $res1,'res2' => $res2]);
    }



    //6.申请商户
    public function add()
    {
        //加载申请商户的页面
        return view('homes/shenqing');
    }

    public function store(Request $request)
    {
        //获取商户申请的数据
        //cinema
        $res = $request->except('_token','city','area','address');
        //cininfo
        $res1 = $request->only('city','area','address');
        //密码hash加密
        $res['password'] = Hash::make($res['password']);

        //图片上传
        if($request -> hasFile('license'))
        {

            //获取文件
            $file=$request->file('license');

            //初始化七牛
            $disk=QiniuStorage::disk('qiniu');

            //重命名文件名
            $name=md5(rand(1111,9999).time()).'.'.$file->getClientOriginalExtension();

            //上传到文件到七牛
            $bool=$disk->put('Uplodes/image_'.$name,file_get_contents($file->getRealPath()));

            $license = 'image_'.$name;

            $res['license'] = $license;

        }  


        $id = DB::table('cinema')->insertGetId($res);

        if($id){

            //添加cininfo表
            $res1['cid'] = $id;
            $aaa = DB::table('cininfo')->insert($res1);

            //添加cinligin表
            $res2['cinema'] = $res['cinema'];
            $res2['password'] = $res['password'];
            $res2['cid'] = $id;
            $res2['time'] = time();
            $bbb = DB::table('cinlogin')->insert($res2);

            //判断
            if ($aaa && $bbb) {
                return redirect('/homes/index');
            } else {
                DB::table('cinema')->where('id',$id)->delete();
                return back();
            }
        } else {

            return back();
        }

    }    



    //7.搜索的页面
    public function search(Request $request)
    {
        //获取要搜索的字段
        $seach = implode($request->all());

        //模糊查询
        $res = film::join('showfilm','film.id','=','showfilm.fid')->where('film.filmname','like','%'.$seach.'%')->where('showfilm.status','1')->get();

        //加载模糊搜索匹配的电影列表
        return view('homes/search',['res' => $res]);

    }



    //8.查看各种类型电影的页面
    public function type(Request $request)
    {
        //获取该类型的影片数据
        $tid = $request->id;
        $res = film::join('showfilm','film.id','=','showfilm.fid')->where('tid',$tid)->where('showfilm.status','1')->get();

        //加载该类型的影片页面
        return view('homes/search',['res' => $res]);
    }
        
    

    //9.订座的页面
    public function dingpiao(Request $request)
    {
        $id = $request->id;
       
        //获取放映信息
        $res = DB::table('showfilm')->where('id',$id)->first();

        //获取电影院信息
        $cinema = DB::table('cinema')->where('id',$res->cid)->first();

        //获取影厅信息
        $room = DB::table('roominfo')->where('id',$res->rid)->first();

        //获取座位信息
        $data = DB::table('seat')->where('id',$room->sid)->first();

        //获取座位
        $seat = $data->seat;
        $seats = explode('#',$seat); 

        //加载座位的页面
        return view('/homes/shopseat', ['data'=>$data,'room'=>$room, 'id'=>$id, 'seat'=>$seats, 'cinema'=>$cinema]); 
    }

    //执行售票
    public function shopseat(Request $request,$id)
    {

        $seat = $request->except('_token')['zuo'];

        //判断用户是否登陆
        if(!session('uid')){
            
            echo '1'; 

        } else {

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
            $data['uid'] = session('uid') ?? 1;
            $data['cid'] = $res->cid;
            $data['fid'] = $res->fid;
            $data['rid'] = $res->rid;
            $data['price'] = $res->price;
            $data['seat'] = $request->except('_token')['zuo'];
            $data['time'] = time();
            $data['num'] = time().rand(111111,999999);
            

            $bool = Redis::hmset('seat_'.$data['num'],$data);
            Redis::expire('seat_'.$data['num'],300);

            // $aaa = DB::table('ticket')->insertGetId($data);

            if($bool){

                echo 'seat_'.$data['num'];

            }else{

                echo '购买失败';
            }
        }
    }

    //已出售
    public function shopseat_into(Request $request,$id)
    {
        
        $res = DB::table('ticket')->where('showid',$id)->get();

        $seat = array();
        $i = 1;
        foreach($res as $k => $v){

            $seat[$i] = $v->seat;
            $i++;
        }

        echo json_encode($seat);
    }



    //10.确认订单信息的页面
    public function piao(Request $request)
    {

        //票id
        $id = $request->id;
        //订单信息
        // $piao = DB::table('ticket')->where('id',$id)->first();
        $piao = Redis::hgetall($id);
        
        //电影院信息
        $cinema = DB::table('cinema')->where('id',$piao['cid'])->first();

        //影厅信息
        $room = DB::table('roominfo')->where('id',$piao['rid'])->first();

        //电影信息
        $film = DB::table('film')->where('id',$piao['fid'])->first();

        //放映信息
        $show = DB::table('showfilm')->where('id',$piao['showid'])->first();

        //用户信息
        $uid = $piao['uid'];
        $yonghu = DB::table('user')->where('id',$uid)->first();

        //座位信息
        $seat = $piao['seat'];
        $aaa = explode('_',$seat);

        //加载订单信息的页面
        return view('/homes/piao',['piao'=>$piao, 'seat'=>$aaa, 'user'=>$yonghu, 'show'=>$show, 'cinema'=>$cinema, 'room'=>$room, 'film'=>$film, 'uid'=>$uid]);
    }

    

    //11.订单完成后钱包和售票数的添加
    public function money(Request $request)
    {
        //获取值
        $num = 'seat_'.$request->only('id')['id'];

        //获取订单信息
        $data = Redis::hgetall($num);

        //判断座位是否售出
        $showid = $data['showid'];
        $seat = $data['seat'];

        $aaa = DB::table('ticket')->where('showid',$showid)->where('seat',$seat)->get();

        if ($aaa) {

            echo 0;die;
        }

        //获取电影/钱包信息
        $res1 = film::where('id',$data['fid'])->first();
        $money = money::where('cid',$data['cid'])->first();
        
        //重定义钱
        $newshownum =  $res1->shownum + 1;
        $newmoney = $money->money + $data['price'];


        //个人钱包
        $muser = DB::table('userDetail')->where('uid',session('uid'))->first()->umoney;
        //重定义
        $newumoney = $muser - $data['price'];

        //开启事务
        DB::beginTransaction();
        //修改电影票房
        $nums = film::where('id',$data['fid'])->update(['shownum'=>$newshownum]);
        //修改电影院钱包
        $mon = money::where('cid',$data['cid'])->update(['money'=>$newmoney]);
        //修改个人钱包
        $users = DB::table('userDetail')->where('uid',session('uid'))->update(['umoney'=>$newumoney]);
        
        //存储订单
        $id = DB::table('ticket')->insertGetId($data);

        if($id && $nums && $mon && $users){

            DB::commit();
            $data = Redis::del($num);
            echo 1;

        } else {

            DB::rollback();
            echo 0;
        }    
    }




}
