<?php

namespace App\Http\Controllers\Film;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\film;
use App\Http\Model\cinema;
use App\Http\Model\roominfo;
use App\Http\Model\showfilm;
use DB;

class FilmShowController extends Controller
{
     //放映信息
    public function index()
    {

      //多表查询

         $roo = DB::table('showfilm')
                        ->join('roominfo','showfilm.rid','=','roominfo.id')
                        ->join('film','showfilm.fid','=','film.id')
                        ->select('showfilm.id','showfilm.time','showfilm.status','film.filmname','roominfo.roomname','showfilm.price','showfilm.timeout')
                        ->where('showfilm.timeout','>',time())
                        ->where('showfilm.cid',session('cid'))
                        ->orderBy('showfilm.time', 'desc')
                        ->paginate(10);

        $arr = array(0=>'即将放映',1=>'正在放映',2=>'放映结束');

        // var_dump($roo);die;



      return view('FilmAdmins.FilmShow.FilmShowList',['roo'=>$roo,'arr'=>$arr]);
    }


    //放映添加
    public function add()
    {


          //电影院影厅 更具影厅状态 商户id

          $roominfo = DB::table('roominfo')->where('status',1)->where('cid',session('cid'))->get();

       
          // 根据商户id 电影状态
          $film = DB::table('film')->where('status',1)->where('showtime','<',time())->where('cid',session('cid'))->get();
          


        return view('FilmAdmins.FilmShow.FilmShowAdd',['film'=>$film,'room'=>$roominfo]);

    }

    //处理添加放映
    public function  doadd(Request $request)
    {
        // echo "<pre>";
        $info = $request->except('_token','ktime');

        //放映时间
        $info['time'] = strtotime($info['time']); 

        $this->validate($request, [
        'time' => 'required',
        'price' => 'required',
        
        ],[
            'time.required'=>'时间不能为空',
            'price.required'=>'价格不能为空',
            ]
        );
        
        
        //影院id
        $info['cid'] = session('cid');

        //电影id
        $fid = $info['fid'];
        $film = DB::table('film')->where('id',$fid)->where('status',1)->first();
        //获取电影时长
        $ftime = $film->filmtime;

        //结束id   放映结束时间戳
        $info['timeout'] = $info['time'] + $ftime*60;

     
        
        $res = showfilm::insert($info);

         if($res)
         {
            return redirect('/FilmAdmins/filmShow')->with('msg','添加成功');

         }else{
             return back()->withInput($request->except('_token'));

         }
     

    }




    //引入编辑页面
    
    public  function edit(Request $request)
    {

      //获取放映的id

      $id = $request->only('id');
  

       $res = showfilm::join('film','showfilm.fid','=','film.id')
                        ->join('roominfo','showfilm.rid','=','roominfo.id')
                        ->join('cinema','showfilm.cid','=','cinema.id')
                        ->select('showfilm.price','film.filmname','showfilm.id','roominfo.roomname','showfilm.time','showfilm.timeout')
                        ->find($request->only('id')['id']);



          //判断影厅是否正有电影放映
          $roominfo = roominfo::where("status",'1')->get();

          //判断是否是该的登录用户的电影

          $film = film::where('cid',session('cid'))->where('status','1')->get();

          $show = showfilm::where('id',$id)->get();






          //b用汉语判断状态
          $arr = array(0=>'即将放映',1=>'正在放映',2=>'放映结束');

      return view("FilmAdmins.FilmShow.FilmShowEdit",['res'=>$res,"room"=>$roominfo,"film"=>$film,'show'=>$show,'arr'=>$arr]);

    }

    //处理更新方法
    public function update(Request $request)
    {



          $info = $request->except('_token','id','time'); 
          $time = $request->only('time');
          
          $info['time'] = strtotime($time['time']);

        
          $res  =showfilm::where('id',$request->only('id')['id'])->update($info);

       

          if($res)
          {
              return redirect('/FilmAdmins/filmShow')->with('msg','修改成功');
          }else{


            return back();
          }

      

    }




    public  function delete(Request $request)
    {
      $id = $request->only('id');
      $res = showfilm::where('id',$id)->delete();
      if($res)
      {
         echo "删除成功!";

      }else{
        return  "删除失败!";
      }
     
    }



    //空闲时间
    public function showtime(Request $request)
    {
        //影厅id
        $id = $request->only('id')['id'];

        //获取该影厅的所有放映
        $data = DB::table('showfilm')->where('rid',$id)->get();
        
        //获取放映的结束时间
        $showtime = array();
        foreach ($data as $key => $value) {

            $showtime[$key] = $value->timeout;

        }

        //判断
        if(empty($showtime)){

          //为空等于当前时间
          $aaa = time();
        } else {

          //不为空取最大时间
          $aaa = max($showtime)+30*60;
        }
        
        //格式化
        $time = date('Y-m-d H:i:s',$aaa);
        //返回时间
        echo  $time;
    }




    //放映记录
    public function  ShowHistory()
    {

       $raa = showfilm::where('showfilm.cid',session('cid'))
                        ->where('showfilm.timeout','<',time())
                        ->join('film','showfilm.fid','=','film.id')
                        ->join('roominfo','showfilm.rid','=','roominfo.id')
                        ->join('cinema','showfilm.cid','=','cinema.id')
                        ->select('showfilm.id','showfilm.time','showfilm.status','film.filmname','roominfo.roomname','showfilm.price','showfilm.timeout')
                        ->orderBy('showfilm.time', 'desc')
                        ->paginate(10);


        $arr = array(0=>'即将放映',1=>'正在放映',2=>'放映结束');


      return view('FilmAdmins.FilmShow.FilmShowHistory',['roo'=>$raa,'arr'=>$arr]);
      
    }

    public function  ShowHisDel(Request $request)
    {


          $id = $request->only('id');
          $res = showfilm::where('id',$id)->delete();
          if($res)
          {
             echo "删除成功!";

          }else{
            return  "删除失败!";
          }

    }









}
