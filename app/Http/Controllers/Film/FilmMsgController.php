<?php

namespace App\Http\Controllers\Film;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\film;
use Hash;
use DB;

use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use zgldh\QiniuStorage\QiniuStorage;

class FilmMsgController extends Controller
{
      //影片管理
    public  function index(Request $request)
    {
        

        $film = film::where('filmname','like','%'.$request->input('seach').'%')->where('cid',session('cid'))->paginate($request->input('num',10));


        $sta = array(0=>'下架',1=>'上映',2=>'即将上映');

        
        return view('FilmAdmins.FilmMag.FilmMsgList',['film'=> $film,'request'=>$request,'sta'=>$sta]);
        
    }

    //加载添加页面
    public function add()
    {

        $data = DB::table('filmtype')->where('status',1)->get();

        return view('FilmAdmins.FilmMag.FilmMsgAdd',['data'=>$data]);

    }

    //处理添加
    public  function doAdd(Request $request)
    {
        
        // 时间支持格式"2017-08-08","2017/08/08",
                
        $this->validate($request, [
        'filmname' => 'required', 
        'keywords' => 'required',
        'director' => 'required',
        'protagonist' => 'required',
        'filmtime' => 'required',
        'price' => 'required',
        'filepic' => 'required',
        'summary' => 'required',
        
        
        ],[
            'filmname.required'=>'影片名称不能为空',
            'keywords.required'=>'关键字不能为空',
            'director.required'=>'导演不能为空',
            'protagonist.required'=>'主演不能为空',
            'filmtime.required'=>'时长不能为空',
            'price.required'=>'价格不能为空',
            'filepic.required'=>'图片不能为空',
            'summary.required'=>'简介不能为空',
            ]
        );
     
   
        $info = $request->except(['_token','filepic','showtime']);
      
        $res = $request->only(['filepic']);

        $showtime = $request->only('showtime');

        $info['showtime'] = strtotime($showtime['showtime']);

        //修改电影类型
        $tid = $request->only('tid')['tid'];

        $type = DB::table('filmtype')->where('id',$tid)->first();

        $type->num = $type->num + 1;

        $sss = DB::table('filmtype')->where('id',$tid)->update(['num'=>$type->num]);

        


                // //判断文件是否上传
                if($request -> hasFile('filepic'))
                {

                     //获取文件
                    $file=$request->file('filepic');
                   //初始化七牛
                   $disk=QiniuStorage::disk('qiniu');

                  //重命名文件名
                  $name=md5(rand(1111,9999).time()).'.'.$file->getClientOriginalExtension();

                  //上传到文件到七牛
                 $bool=$disk->put('Uplodes/image_'.$name,file_get_contents($file->getRealPath()));

                  $filepic = 'image_'.$name;

                  $info['filepic'] = $filepic;
                

                }

                  $info['cid'] = session('cid');
                  //链接数据库
                  $db = film::insert($info);


                  if($db)
                  {
                    return redirect('/FilmAdmins/filmMsg')->with('msg','添加成功');

                  }else{

                        //添加失败的话,把上传的图图片
                     if(file_exists($filepic))
                         {
                            unlink($find->clogo);
                         }
                     return back()->withInput($request->except('_token','filepic'));
                    // return back();
                  }
    }

    //修改页面

    public function edit(Request $request)
    {
      // return "这是修改页面";
      
      $id = $request->only('id');
      $res = film::find($id)[0];

   

      return  view('FilmAdmins.FilmMag.FilmMsgEdit',['res'=>$res]);
    }




//修改信息

    public function update(Request $request)
    {
        $this->validate($request, [
        'filmname' => 'required', 
        'keywords' => 'required',
        'director' => 'required',
        'protagonist' => 'required',
        'filmtime' => 'required',
        'price' => 'required',
        'summary' => 'required',
        
        
        ],[
            'filmname.required'=>'影片名称不能为空',
            'keywords.required'=>'关键字不能为空',
            'director.required'=>'导员不能为空',
            'protagonist.required'=>'主演不能为空',
            'filmtime.required'=>'时长不能为空',
            'price.required'=>'价格不能为空',
            'summary.required'=>'简介不能为空',
            ]
        );



      $id = $request->only('id');
      $showtime = $request->only('showtime');
      $res =  $request->except('id','_token','id','filepic','showtime');
      $res['showtime'] = strtotime($showtime['showtime']);
             // //判断文件是否上传
              if($request -> hasFile('filepic'))
              {

                  $find = film::find($id);

                   //删除原先的图片
                  $accessKey = '6KNr_k8cHOhY8vRfsoVVQDOsepKnzYgh7gxMqg0w';
                  $secretKey = 'USietl53216m7raLRSEVuXwYEwxwEs3ZR1hQ5hKZ';

                  //初始化Auth状态：
                  $auth = new Auth($accessKey, $secretKey);

                  //初始化BucketManager
                  $bucketMgr = new BucketManager($auth);

                  //你要测试的空间， 并且这个key在你空间中存在
                  $bucket = 'laravel-upload';
                  $key = 'Uplodes/'.$find[0]->filepic;

                  //删除$bucket 中的文件 $key
                  $err = $bucketMgr->delete($bucket, $key);



                   $file=$request->file('filepic');
                   //初始化七牛
                   $disk=QiniuStorage::disk('qiniu');

                  //重命名文件名
                  $name=md5(rand(1111,9999).time()).'.'.$file->getClientOriginalExtension();

                  //上传到文件到七牛
                 $bool=$disk->put('Uplodes/image_'.$name,file_get_contents($file->getRealPath()));

                   $filepic = 'image_'.$name;
                   $res['filepic'] =$filepic;
                          
                        

              }

             $dd =film::where('id',$request->only('id'))->update($res);
            

              if($dd)
               {
                   return redirect('/FilmAdmins/filmMsg')->with('msg','修改成功');
               }else{

                    return back();
               }
     }



    //信息删除
     public function delete(Request $request)
     {
        // echo "这是删除";
         $id = $request->only('id');
         $del = film::find($id);
         // echo $id;


          //删除原先的图片
          $accessKey = '6KNr_k8cHOhY8vRfsoVVQDOsepKnzYgh7gxMqg0w';
          $secretKey = 'USietl53216m7raLRSEVuXwYEwxwEs3ZR1hQ5hKZ';

          //初始化Auth状态：
          $auth = new Auth($accessKey, $secretKey);

          //初始化BucketManager
          $bucketMgr = new BucketManager($auth);

          //你要测试的空间， 并且这个key在你空间中存在
          $bucket = 'laravel-upload';
          $key = 'Uplodes/'.$del[0]->filepic;

          //删除$bucket 中的文件 $key
          $err = $bucketMgr->delete($bucket, $key);



            // $res = $del->delete();
           if(film::where('id',$id)->delete())
           {
            echo "删除成功!";
           }else{
            echo "删除失败!";
           }


           

     }

               



               






}
