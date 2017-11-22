<?php

namespace App\Http\Controllers\Film;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\cinema;
use App\Http\Model\cininfo;


use DB;

class FilmUserController extends Controller
{
    //
    //电影院后台首页
    public function index()
    {
        return view('FilmAdmins.index');
    } 

    //电影院信息
    public function FilmInfo()
    {   
            $id = session('uid');

             // $res = cinema::find($id);
             // echo "<pre>";
             // var_dump($res->cinema);
             // die;
             $res = cinema::join('cininfo','cininfo.cid','=','cinema.id')
                            ->where('cinema.id',$id)
                            ->get();
                    
        return view('FilmAdmins.FilmUser.info',['res'=>$res]);
    }

//电影院信息修改
    public function filmUpdate(Request $request)
    {
        
         
            $cinema =  $request->except('_token','city','area','','address','license');
            $city = $request->only('city');
            $area = $request->only('area');
            $address = $request->only('address');

            //
            $arr = array('city'=>$city['city'],'area'=>$area['area'],'address'=>$address['address']);


            //获取用户id

            $id = session('uid');

            $license = $request->only('license');
            

              if($request -> hasFile('license'))
              {

                 $clic = cinema::find($id);

                  //2,判断图片是否存在
                  //存在就删除
                  if(file_exists($clic->license))
                   {
                      unlink($clic->license);
                   }

                //文件名
                $name = rand(1111,9999).time();
                //获取后缀名
                $jpg = $request -> file('license')->getClientOriginalExtension();
                //移动图片
                 $request ->file('license') -> move('./Uploads',$name.'.'.$jpg);

                 $license = './Uploads/'.$name.'.'.$jpg;
                 $cinema['license'] = $license;
                
              }

                $cin = DB::table('cinema')->where('id',$id)->update($cinema);
                $cinfo = DB::table('cininfo')->where('cid',$id)->update($arr);

                if($cin)
                {
                      return redirect('/FilmAdmins/info')->with('msg','修改成功'); 
                }else if($cinfo)
                {
                     return redirect('/FilmAdmins/info')->with('msg','修改成功'); 
                }else if($cin && cinfo)
                {
                     return redirect('/FilmAdmins/info')->with('msg','修改成功'); 
                }else{
                    return back();

                }
               


    }





















    //商户logo

    public function Profile()
    {

        //获取用户session
        $id = session('uid');
    
        $res = cinema::find($id);
        return view('FilmAdmins.FilmUser.Profile',['res'=>$res]);
    }


    //执行修改
    public function doPro(Request $request)
    {

             //先删除原先的图片

            //1,先查询
            $find = cinema::find(1);
            //2,判断图片是否存在
            //存在就删除
            if(file_exists($find->clogo))
             {
                unlink($find->clogo);
             }
  

                $res = $request->only(['clogo']);

                // //判断文件是否上传
                if($request -> hasFile('clogo'))
                {
                    //文件名
                    $name = rand(1111,9999).time();

                    //获取后缀名
                    $jpg = $request -> file('clogo')->getClientOriginalExtension();
                   var_dump($jpg);

                    //移动图片
                    $request ->file('clogo') -> move('./Uploads',$name.'.'.$jpg);
                }

                $clogo = './Uploads/'.$name.'.'.$jpg;

                $info =cinema::find(1); 
                $info->clogo = "{$clogo}";
                if($info->save())
                {
                    // echo "修改成功";
                    return redirect('/FilmAdmins/Profile')->with('msg','修改成功');


                }else{
                    
                    return back();

                }
   
    }




    //修改密码


    public  function PasEdit(Request $request)
    {
            echo "这是修改页面";
            return view('FilmAdmins.FilmUser.FilmPassEdit');
    }





    
}
