<?php

namespace App\Http\Controllers\Homes;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\cinema;
use App\Http\Model\cininfo;
use App\Http\Model\film;
use App\Http\Model\showfilm;
use App\Http\Model\lunbo;
use App\Http\Model\seat;
use Hash;
use DB;

class HomesController extends Controller
{

    //主页
    public function index()
    {   
        //热映电影数据
        $res = film::orderBy('shownum','desc')->limit('3')->get();
        //轮播图数据
        $res1 = lunbo::get();

        //加载首页
        return view('homes/index',['res' => $res,'res1' => $res1]);
    }


    //电影列表
    public function filmlist()
    {

        //电影列表数据
        $res = film::paginate(2);

        //电影类型
        $type = DB::table('filmtype')->where('status',1)->get();

        //电影排行榜数据
        $res1 = film::orderBy('shownum','desc')->limit('3')->get();

       //加载电影列表
        return view('homes/filmlist',['res' => $res,'res1'=>$res1,'type'=>$type]);
    }


    //电影详情页
    public function filmdetail(Request $request)
    {

        
        $aaa = film::find($request->id);
        // echo "<pre>";var_dump($aaa->filmname);die;
        $bbb = film::where('filmname',$aaa->filmname)
                ->join('showfilm','film.id','=','showfilm.fid')
                ->join('cinema','showfilm.cid','=','cinema.id')
                ->join('cininfo','cinema.id','=','cininfo.cid')
                ->select('showfilm.id','showfilm.time','cinema.cinema')
                ->get();
        // echo "<pre>";var_dump($bbb);die;
        //加载电影详情页面
        return view('homes/filmdetail',['aaa' => $aaa,'bbb' => $bbb]);
    }


    //电影院列表
    public function cinemalist()
    {
        //电影院列表数据
        $res = cinema::get();

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

       
        
        $res2 = cinema::where('cinema.id',$request->id)
                ->join('cininfo','cinema.aid','=','cininfo.id')
                ->join('showfilm','cininfo.cid','=','showfilm.cid')
                ->join('film','showfilm.fid','=','film.id')
                ->select('film.filmname','film.filepic','film.price','showfilm.id')
                ->get();
                
        //加载电影院详情页面
        return view('homes/cinemadetail',['res' => $res,'res1' => $res1,'res2' => $res2]);
    }




    //申请商户
    public function add()
    {
        return view('homes/shenqing');
    }

    public function store(Request $request)
    {
        $res = $request->except('_token','city','area','address');
        $res1 = $request->only('city','area','address');

        $res['password'] = Hash::make($res['password']);


        if($request -> hasFile('license'))
        {

           //文件名
            $name = rand(11111,99999).time();

            //获取后缀名
            $jpg = $request -> file('license')->getClientOriginalExtension();
          
            //移动图片
            $request ->file('license') -> move('./public/FilmPublic/Uploads',$name.'.'.$jpg); 
        }  

        $license = './public/FilmPublic/Uploads/'.$name.$name.'.'.$jpg;
        $res['license'] = $license;

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

        $res = film::where('filmname','like','%'.$seach.'%')->get();

        //加载模糊搜索匹配的电影列表
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


        return view('/homes/shopseat', ['data'=>$data,'room'=>$room, 'id'=>$id, 'seat'=>$seats, 'cinema'=>$cinema]); 
    }




}
