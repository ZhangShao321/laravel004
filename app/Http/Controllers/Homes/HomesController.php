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

//七牛
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use zgldh\QiniuStorage\QiniuStorage;

class HomesController extends Controller
{

    //电影院主页
    public function index()
    {   
        //热映电影数据
        $res = film::orderBy('shownum','desc')->limit('3')->get();

        //轮播图数据
        $res1 = lunbo::get();

        //即将上映电影数据
        $res2 = film::where('status','1')->where('showtime','>',time())->limit('4')->get();

        //加载前台首页
        return view('homes/index',['res' => $res,'res1' => $res1,'res2' => $res2]);
    }


    //电影列表
    public function filmlist()
    {

        //电影列表数据
        $res = film::paginate(2);

        //电影类型数据
        $type = DB::table('filmtype')->where('status',1)->get();

        //电影排行榜数据
        $res1 = film::orderBy('shownum','desc')->limit('3')->get();

       //加载电影列表
        return view('homes/filmlist',['res' => $res,'res1'=>$res1,'type'=>$type]);
    }


    //电影详情页
    public function filmdetail(Request $request)
    {

        //电影详情数据
        $aaa = film::find($request->id);
        $bbb = film::where('filmname',$aaa->filmname)
                ->join('showfilm','film.id','=','showfilm.fid')
                ->join('cinema','showfilm.cid','=','cinema.id')
                ->join('cininfo','cinema.id','=','cininfo.cid')
                ->select('showfilm.id','showfilm.time','cinema.cinema')
                ->get();

        //加载电影详情页面
        return view('homes/filmdetail',['aaa' => $aaa,'bbb' => $bbb]);
    }


    //电影院列表
    public function cinemalist()
    {
        //电影院列表数据
        $res = cinema::paginate(2);

        //加载电影院列表页面
        return view('homes/cinemalist',['res' => $res]);
    }


    //电影院详情
    public function cinemadetail(Request $request)
    {
        //电影院详情数据 
        $id = implode($request->only('id'));
        $res = cinema::find($request->only('id'));
        $res1 = cininfo::where('cid',$id)->get();

        //该影院上映的电影数据
        $res2 = showfilm::where('showfilm.cid','=',$request->id)
                        ->join('film','film.id','=','showfilm.fid')
                        ->select('film.filmname','film.filepic','film.price','showfilm.id')
                        ->get();
        
        //加载电影院详情页面
        return view('homes/cinemadetail',['res' => $res,'res1' => $res1,'res2' => $res2]);
    }




    //申请商户
    public function add()
    {
        //加载申请商户的页面
        return view('homes/shenqing');
    }

    public function store(Request $request)
    {
        //获取商户申请的数据
        $res = $request->except('_token','city','area','address');
        $res1 = $request->only('city','area','address');

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

      
        //事务处理
        DB::beginTransaction();

        $cinema = cinema::insert($res);
        $cininfo = cininfo::insert($res1);

        //判断
        if($cinema && $cininfo)
        {   
            DB::commit();
            return redirect('/homes/index'); 

        }else{
            
            DB::rollback();
        }

    }    



    //搜索的页面
    public function search(Request $request)
    {
        //获取要搜索的字段
        $seach = implode($request->all());

        //模糊查询
        $res = film::where('filmname','like','%'.$seach.'%')->get();

        //加载模糊搜索匹配的电影列表
        return view('homes/search',['res' => $res]);

    }


    //查看各种类型电影的页面
    public function type(Request $request)
    {
        //获取该类型的影片数据
        $tid = $request->id;
        $res = film::where('tid',$tid)->get();

        //加载该类型的影片页面
        return view('homes/search',['res' => $res]);
    }
        
    

    //订座的页面
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
        $data['num'] = time().rand(11111111,99999999).$id;


        $aaa = DB::table('ticket')->insertGetId($data);

        if($aaa){

            echo $aaa;
        }else{
            echo '购买失败';
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


    //确认订单信息的页面
    public function piao(Request $request)
    {

        //票id
        $id = $request->id;

        //订单信息
        $piao = DB::table('ticket')->where('id',$id)->first();

        //电影院信息
        $cinema = DB::table('cinema')->where('id',$piao->cid)->first();

        //影厅信息
        $room = DB::table('roominfo')->where('id',$piao->rid)->first();

        //电影信息
        $film = DB::table('film')->where('id',$piao->fid)->first();

        //放映信息
        $show = DB::table('showfilm')->where('id',$piao->showid)->first();

        //用户信息
        $uid = $piao->uid;
        $yonghu = DB::table('user')->where('id',$uid)->first();

        //判断用户是否登陆
        if(!session('uid')){
            return redirect('/homes/login');
        }

        //座位信息
        $seat = $piao->seat;
        $aaa = explode('_',$seat);

        
        //加载订单信息的页面
        return view('/homes/piao',['piao'=>$piao, 'seat'=>$aaa, 'user'=>$yonghu, 'show'=>$show, 'cinema'=>$cinema, 'room'=>$room, 'film'=>$film, 'uid'=>$uid]);
    }
   

    //订单完成后钱包和售票数的添加
    public function money(Request $request)
    {
        $cinema = $request->only('cinema')['cinema'];
        $price = $request->only('price')['price'];
        $name = $request->only('name')['name'];
        
        
        $res = cinema::where('cinema',trim($cinema))->first();
        $res1 = film::where('filmname',$name)->first();
        $money = money::where('cid',$res['id'])->first();
    
        $shownum =  $res1['shownum'] +'1';
        $newmoney = $money['money'] + $price;

        $num = film::where('filmname',$name)->update(['shownum'=>$shownum]);
        $mon = money::where('cid',$res['id'])->update(['money'=>$newmoney]);
     
    }
}
