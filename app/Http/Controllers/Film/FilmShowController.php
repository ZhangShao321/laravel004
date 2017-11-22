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
      // $res = DB::select("select showfilm.id,showfilm.price,showfilm.status,showfilm.time,film.filmname,roominfo.roomname,cinema.cinema from showfilm,film,roominfo,cinema where showfilm.fid=film.id and showfilm.Rid=roominfo.id and showfilm.cid=cinema.id and showfilm.id={$request->id}");
 

       $roo = showfilm::where('showfilm.cid',session('uid'))
                        ->join('film','showfilm.fid','=','film.id')
                        ->join('roominfo','showfilm.rid','=','roominfo.id')
                        ->join('cinema','showfilm.cid','=','cinema.id')
                        ->select('showfilm.id','showfilm.time','showfilm.status','film.filmname','roominfo.roomname','showfilm.price')
                        ->paginate(2);

        $arr = array(0=>'即将放映',1=>'正在放映',2=>'放映结束');

      return view('FilmAdmins.FilmShow.FilmShowList',['roo'=>$roo,'arr'=>$arr]);
    }


    //放映添加
    public function add()
    {
          
          $cinema = cinema::get();
          $roominfo = roominfo::where("status",1)->get();

          $film = film::get();

        return view('FilmAdmins.FilmShow.FilmShowAdd',['film'=>$film,'cinema'=>$cinema,'room'=>$roominfo]);

    }

    //处理添加放映
    public function  doadd(Request $request)
    {
        // echo "<pre>";
        $info = $request->except('_token');
        $info['time'] = strtotime($info['time']); 
        // var_dump($info);die;
        //'time' => "required|regex:/\d{4}[-\/]\d{2}[-\/]\d{2}\s([0-1][0-9]):([0-5][0-9]):([0-5][0-9])/"
        //'time.regex'=>'时间格式错误',
        $this->validate($request, [
        'time' => 'required',
        'price' => 'required',
        
        ],[
            'time.required'=>'时间不能为空',
            'price.required'=>'价格不能为空',
            ]
        );
        
        //时间格式  ([0-1][0-9]|(2[0-3])):([0-5][0-9]):([0-5][0-9])$#
        
        $info['cid'] = session('cid') ?? 1;
        $res = showfilm::insert($info);

         if($res)
         {
            return redirect('/FilmAdmins/filmShow')->with('msg','添加成功');

         }else{
             return back()->withInput($request->except('_token'));

         }
     

        // echo "这是添加放映";
    }





    
    public  function edit(Request $request)
    {

      // echo "这是编辑页面";
      // echo "<pre>";
       // $res = DB::select("select showfilm.id,showfilm.price,showfilm.status,showfilm.time,film.filmname,roominfo.roomname,cinema.cinema from showfilm,film,roominfo,cinema where showfilm.fid=film.id and showfilm.Rid=roominfo.id and showfilm.cid=cinema.id and showfilm.id={$request->id}");
    
      // $res = showfilm::find($request->only('id'));
     $res = showfilm::join('film','showfilm.fid','=','film.id')
                        ->join('roominfo','showfilm.rid','=','roominfo.id')
                        ->join('cinema','showfilm.cid','=','cinema.id')
                        ->find($request->only('id'));

          //判断影厅是否正有电影放映
          $roominfo = roominfo::where("status",'0')->get();

          //判断是否是该的登录用户的电影
          $film = film::where('cid',session('uid'))->get();
          $show = showfilm::get();

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













}
