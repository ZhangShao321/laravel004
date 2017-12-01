<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\userDetail;
use App\Http\Model\user;
use App\Http\Model\film;
use DB;

use zgldh\QiniuStorage\QiniuStorage;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;


class HomesDetailController extends Controller
{
    //
    public function index()
    {
        // echo 11111111;die;
    	return view('homes/detail');
    }

     
    public function update(Request $request,$id)
    {
        $result1 = $request->except('_token','_method');
         //userDetail表数据
        $bbb['nickName'] = $result1['nickName'];
        $bbb['email'] = $result1['email'];
        $bbb['qq'] = $result1['qq'];
        $bbb['sex'] = $result1['sex'];

       
        $ress = DB::table('userDetail')->where('id',$id)->update($bbb);

            if($ress){
                return redirect('homes/details')->with('msg','修改成功!!');
            }else{
                return redirect('homes/details')->with('msg','修改失败,请重新操作!!');
            }
           
    }

   


    public function edit()
    {
        return view('/homes/xiugai');
    }

    //修改头像
    public function doedit(Request $request,$id)
    {
        $result1 = $request->except('_token','_method');

         if($request -> hasFile('photo')){
        

            $clic = DB::table('userDetail')->where('id',$id)->first();

                //删除原先的图片
                $accessKey = '6KNr_k8cHOhY8vRfsoVVQDOsepKnzYgh7gxMqg0w';
                $secretKey = 'USietl53216m7raLRSEVuXwYEwxwEs3ZR1hQ5hKZ';

                //初始化Auth状态：
                $auth = new Auth($accessKey, $secretKey);

                //初始化BucketManager
                $bucketMgr = new BucketManager($auth);

                //你要测试的空间， 并且这个key在你空间中存在
                $bucket = 'laravel-upload';
                $key = 'Uplodes/'.$clic->photo;

                //删除$bucket 中的文件 $key
                $err = $bucketMgr->delete($bucket, $key);
            

                 //获取文件
                $file=$request->file('photo');
                //初始化七牛
                $disk=QiniuStorage::disk('qiniu');

                 //重命名文件名
                $name=md5(rand(1111,9999).time()).'.'.$file->getClientOriginalExtension();

                 //上传到文件到七牛
                $bool=$disk->put('Uplodes/image_'.$name,file_get_contents($file->getRealPath()));

                $photo = 'image_'.$name;
                // echo 111111;die;
                // $res = DB::table('userDetail')->where('uid',session('uid'))->update(['photo'=>$photo]);
            }else{
                return redirect('/homes/edit')->with('msg','没有添加头像，请重新操作!!!');
            } 

            $aaa['photo'] = $photo;

            $pres = DB::table('userDetail')->where('id',$id)->update($aaa);

            if($pres){
                return redirect('/homes/details')->with('msg','头像修改成功!!!');
            }else{
                return redirect('/homes/edit')->with('msg','头像修改失败!!!');
            }



    }
 
}
