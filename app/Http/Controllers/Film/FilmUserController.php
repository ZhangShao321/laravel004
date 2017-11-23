<?php

namespace App\Http\Controllers\Film;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\cinema;
use App\Http\Model\cininfo;

use zgldh\QiniuStorage\QiniuStorage;


use DB;
use Hash;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;


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
            $id = session('cid');


           
             $res = cinema::join('cininfo','cininfo.cid','=','cinema.id')
                            ->where('cinema.id',$id)
                            ->get();

               // echo "后台信息";die;
                    
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

            $id = session('cid');

            $license = $request->only('license');
            

              if($request -> hasFile('license'))
              {

                 $clic = cinema::find($id);

                  //删除原先的图片
                  $accessKey = '6KNr_k8cHOhY8vRfsoVVQDOsepKnzYgh7gxMqg0w';
                  $secretKey = 'USietl53216m7raLRSEVuXwYEwxwEs3ZR1hQ5hKZ';

                  //初始化Auth状态：
                  $auth = new Auth($accessKey, $secretKey);

                  //初始化BucketManager
                  $bucketMgr = new BucketManager($auth);

                  //你要测试的空间， 并且这个key在你空间中存在
                  $bucket = 'laravel-upload';
                  $key = 'Uplodes/'.$clic->license;

                  //删除$bucket 中的文件 $key
                  $err = $bucketMgr->delete($bucket, $key);
                

                     //获取文件
                   $file=$request->file('license');
                   //初始化七牛
                   $disk=QiniuStorage::disk('qiniu');

                  //重命名文件名
                  $name=md5(rand(1111,9999).time()).'.'.$file->getClientOriginalExtension();

                  //上传到文件到七牛
                 $bool=$disk->put('Uplodes/image_'.$name,file_get_contents($file->getRealPath()));

                 $license = 'image_'.$name;
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
        $id = session('cid');
    
        $res = cinema::find($id);

        

        return view('FilmAdmins.FilmUser.Profile',['res'=>$res]);
    }


    //执行修改logo
    public function doPro(Request $request)
    {
             //先删除原先的图片

            //1,先查询
            $find = cinema::where('id',session('cid'))->first();
            // //判断文件是否上传
            if($request -> hasFile('clogo'))
            {


               $accessKey = '6KNr_k8cHOhY8vRfsoVVQDOsepKnzYgh7gxMqg0w';
              $secretKey = 'USietl53216m7raLRSEVuXwYEwxwEs3ZR1hQ5hKZ';

              //初始化Auth状态：
              $auth = new Auth($accessKey, $secretKey);

              //初始化BucketManager
              $bucketMgr = new BucketManager($auth);

              //你要测试的空间， 并且这个key在你空间中存在
              $bucket = 'laravel-upload';
              $key = 'Uplodes/'.$find->clogo;

            //删除$bucket 中的文件 $key
              $err = $bucketMgr->delete($bucket, $key);
             $res = $request->only(['clogo']);


               //获取文件
               $file=$request->file('clogo');
               //初始化七牛
               $disk=QiniuStorage::disk('qiniu');

              //重命名文件名
              $name=md5(rand(1111,9999).time()).'.'.$file->getClientOriginalExtension();

              //上传到文件到七牛
             $bool=$disk->put('Uplodes/image_'.$name,file_get_contents($file->getRealPath()));

              //上传
              $clogo = 'image_'.$name;
              $info =cinema::find(1); 
              $info->clogo = "{$clogo}";
              if($info->save())
                {
                    // echo "修改成功";
                    return redirect('/FilmAdmins/Profile')->with('msg','修改成功');


                }else{
                    
                    return back();

                }

            }else{

                 return back()->with('msg','您还未选择图片');


            }
                
               
   
    }




    //修改密码


    public  function PasEdit(Request $request)
    {
            echo "这是修改页面";
            return view('FilmAdmins.FilmUser.FilmPassEdit');
    }


    ///执行修改密码

    public function  PasUpdate(Request $request)
    {

        // var_dump($request->all());
     $oldpassword = $request->only('oldpassword');
     $newpassword = $request->only('newpassword');

      $info =cinema::find(session('cid')); 
      if(!Hash::check($oldpassword['password'],$info->password))
      {

         $new = Hash::make($newpassword['newpassword']);

         $update = cinema::where('id',session('cid'))->update(['password',$new]);

         if($update)
         {
            echo 1;


         }else{
          echo 0;
         }
      }else{

        echo 2;
      }

      
      

    
      
     
     

      

    }





    
}
