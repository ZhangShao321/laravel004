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
                        ->select('showfilm.id','showfilm.time','showfilm.status','film.filmname','roominfo.roomname','showfilm.price','showfilm.timeout')
                        ->paginate(10);

        $arr = array(0=>'即将放映',1=>'正在放映');


      return view('FilmAdmins.FilmShow.FilmShowList',['roo'=>$roo,'arr'=>$arr]);
    }


    //放映添加
    public function add()
    {
          
          $cinema = cinema::get();
          $roominfo = roominfo::where("status",1)->get();
          $film = film::where('status','1')->get();

        return view('FilmAdmins.FilmShow.FilmShowAdd',['film'=>$film,'cinema'=>$cinema,'room'=>$roominfo]);

    }

    //处理添加放映
    public function  doadd(Request $request)
    {
        // echo "<pre>";
        $info = $request->except('_token');
        $info['time'] = strtotime($info['time']); 

        $this->validate($request, [
        'time' => 'required',
        'price' => 'required',
        
        ],[
            'time.required'=>'时间不能为空',
            'price.required'=>'价格不能为空',
            ]
        );
        
        
        $info['cid'] = session('cid');
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

     
     $res = showfilm::join('film','showfilm.fid','=','film.id')
                        ->join('roominfo','showfilm.rid','=','roominfo.id')
                        ->join('cinema','showfilm.cid','=','cinema.id')
                        ->select('showfilm.price','film.filmname','roominfo.roomname','showfilm.time','showfilm.timeout','showfilm.id')
                        ->find($request->only('id')['id']);

          //判断影厅是否正有电影放映
          $roominfo = roominfo::where("status",'1')->get();

          //判断是否是该的登录用户的电影
          $film = film::where('cid',session('cid'))->where('status','1')->get();
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
          var_dump($request->only('id')['id']);
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













}
