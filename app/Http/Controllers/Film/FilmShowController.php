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
      
       $roo = showfilm::where('showfilm.cid',session('cid'))
                        ->join('film','showfilm.fid','=','film.id')
                        ->join('roominfo','showfilm.rid','=','roominfo.id')
                        ->join('cinema','showfilm.cid','=','cinema.id')
                        ->select('showfilm.id','showfilm.time','showfilm.timeout','showfilm.status','film.filmname','roominfo.roomname','showfilm.price')
                        ->paginate(10);

        $arr = array(0=>'即将放映',1=>'正在放映',2=>'放映结束');

      return view('FilmAdmins.FilmShow.FilmShowList',['roo'=>$roo,'arr'=>$arr]);
    }


    //放映添加
    public function add()
    {
          //电影院影厅
          $roominfo = DB::table('roominfo')->where('status',1)->where('cid',session('cid'))->get();

       
          // 电影
          $film = DB::table('film')->where('cid',session('cid'))->get();
          

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
        
        //时间格式  ([0-1][0-9]|(2[0-3])):([0-5][0-9]):([0-5][0-9])$#
        
        //影院id
        $info['cid'] = session('cid');

        //电影id
        $fid = $info['fid'];
        $film = DB::table('film')->where('id',$fid)->where('status',1)->first();
        $ftime = $film->filmtime;

        //结束id
        $info['timeout'] = time()+$ftime*60;

        // var_dump($info);die;
        
        $res = showfilm::insert($info);

         if($res)
         {
            return redirect('/FilmAdmins/filmShow')->with('msg','添加成功');

         }else{
             return back()->withInput($request->except('_token'));

         }
     

    }





    
    public  function edit(Request $request)
    {

      $id = $request->only('id');
     
     // $res = showfilm::join('film','showfilm.fid','=','film.id')
     //                    ->join('roominfo','showfilm.rid','=','roominfo.id')
     //                    ->join('cinema','showfilm.cid','=','cinema.id')
     //                    ->find($request->only('id'));


       $res = showfilm::join('film','showfilm.fid','=','film.id')
                        ->join('roominfo','showfilm.rid','=','roominfo.id')
                        ->join('cinema','showfilm.cid','=','cinema.id')
                        ->select('showfilm.price','film.filmname','showfilm.id','roominfo.roomname','showfilm.time','showfilm.timeout')
                        ->find($request->only('id')['id']);


          //判断影厅是否正有电影放映
          $roominfo = roominfo::where("status",'1')->get();

          //判断是否是该的登录用户的电影
          $film = film::where('cid',session('cid'))->get();
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
      $res  =showfilm::where('id',$request->only('id'))->update($info);

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
      // echo "<pre>";
      // $res = showfilm::find($id);

      $res = showfilm::where('id',$id)->delete();
      if($res)
      {
         echo "删除成功!";

      }else{
        return  "删除失败!";
      }
      // echo "这是删除页面";
    }



    //空闲时间
    public function showtime(Request $request)
    {
        $id = $request->only('id')['id'];

        $data = DB::table('showfilm')->where('rid',$id)->get();

        $showtime = array();

        foreach ($data as $key => $value) {

            $showtime[$key] = $value->timeout;

        }

        //判断
        if(empty($showtime)){
          $aaa = time();
        } else {
          $aaa = max($showtime)+30*60;
        }
        

        $time = date('Y-m-d H:i:s',$aaa);

        echo  $time;
    }









}
