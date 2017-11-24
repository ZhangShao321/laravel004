<?php

namespace App\Http\Controllers\admin;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\user;

use zgldh\QiniuStorage\QiniuStorage;


use DB;
use Hash;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;


class GuanliyuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $res=user::where('status','>','0')->get();
         
        return view('admin.guanliyuan.index',compact('res'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('admin.guanliyuan.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取信息
        $res=$request->except('_token','repass');

        //判断是否丢包
        if (empty($res)) {

            return back()->withInput('添加失败');
        }
       
        //哈希加密
        $res['password']=Hash::make($res['password']);

        //添加时间
        $res['lastlogin']=time();
       

        // var_dump($res);die;
        //修改
        $id = DB::table('user')->insertGetId($res);  
        
        //判断
        if($id){

            //添加userDetail表
            $data = DB::table('userDetail')->insert(['uid'=>$id]);

            if ($data) {
                return redirect('/admin/guanliyuan')->with('添加成功');
            } else {

                DB::table('user')->where('id',$id)->delete();
                return back()->withInput('添加失败');
            }
            
        }else{
            return back()->withInput('添加失败');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('user')->where('id',$id)->first();

        $res = DB::table('userDetail')->where('uid',$id)->first();

        return view('/admin/guanliyuan/edit', ['data'=>$data, 'res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $res = $request->except('_token','_method');

        if(empty($res)){

            return back()->with('修改失败');
        }
        // var_dump($res);die;

        //user表数据
        $aaa['phone'] = $res['phone'];
        $aaa['auth'] = $res['auth'];
        $aaa['status'] = $res['status'];

        //userDetail表数据
        $bbb['nickName'] = $res['nickName'];
        $bbb['email'] = $res['email'];
        $bbb['qq'] = $res['qq'];

        $data1 = DB::table('user')->where('id',$id)->update($aaa);

        $data2 = DB::table('userDetail')->where('uid',$id)->update($bbb);

        if ($data2) {
            return redirect('/admin/guanliyuan')->with('修改成功');
        } else {
            return back()->with('修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        
       
        $sql = user::where('id',$id)->delete();
        if($sql){

             // return redirect('/admin/guanliyuan')->with('msg','删除成功');
            echo "删除成功!";
            

        }else{
            // return back();
            echo "删除失败!";


        }
    }


    //添加管理员验证
    public function phone(Request $request)
    {
        $phone = $request->except('_token')['phone'];

        $data = DB::table('user')->where('phone',$phone)->first();

        if ($data) {

            echo "管理员已存在";
        } else {
            echo '√';
        }
    }

    //修改状态
    public function work(Request $request)
    {

        // echo '1';die;
        $data = $request->except('_token');

        // var_dump($data);die;

        if($data['auth'] == '1'){

            $res1 = DB::table('user')->where('id',$data['id'])->update(['auth'=>0]);
            if($res1){
                echo '1';
            }else{
                echo '0';
            }
        }else if($data['auth'] == '0'){
            $res2 = DB::table('user')->where('id',$data['id'])->update(['auth'=>1]);
            if($res2){
                echo '2';
            }else{
                echo '0';
            }
        }
    }

    //添加修密码改页面
    public function pass()
    {
        // echo 11111;die;
        $id = session('aid');

        $data = DB::table('user')->where('id',$id)->first();

        return view('admin.guanliyuan.pass',['data'=>$data]);
    }
    //执行密码修改
    public function dopass(Request $request)
    {
        // echo 11111;die;
        $id = session('aid');

        $res = $request->except('_token','repass','phone');

        // var_dump($res);die;

        if (empty($res)) {
            return back()->with('抱歉! 数据丢失!');
        }

        $res['password'] = Hash::make($res['password']);


        $data = DB::table('user')->where('id',$id)->update($res);

        if ($data) {

            // echo 1111111111;die;
            return redirect('/admin/index');
        } else {
            return back()->with('抱歉! 修改失败!');
        }
    }

    //添加修改头像页面
    public function photo()
    {
        // echo 1111111111111;die;
        $uid = session('aid');

        $data = DB::table('userDetail')->where('uid',$uid)->first();

        return view('/admin/guanliyuan/photo',['data'=>$data]);
    }

    //执行修改头像
    public function dophoto(Request $request)
    {

        $id = $request->only('id');

        if($request -> hasFile('photo')){
        

            $clic = DB::table('userDetail')->where('uid',$id)->first();

                //删除原先的图片
                $accessKey = '6KNr_k8cHOhY8vRfsoVVQDOsepKnzYgh7gxMqg0w';
                $secretKey = 'USietl53216m7raLRSEVuXwYEwxwEs3ZR1hQ5hKZ';

                //初始化Auth状态：
                $auth = new Auth($accessKey, $secretKey);

                //初始化BucketManager
                $bucketMgr = new BucketManager($auth);

                //你要测试的空间， 并且这个key在你空间中存在
                $bucket = 'laravel-upload';
                @$key = 'Uplodes/'.$clic->photo;

                //删除$bucket 中的文件 $key
                @$err = $bucketMgr->delete($bucket, $key);
            

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
                $res = DB::table('userDetail')->where('uid',$id)->update(['photo'=>$photo]);

                // var_dump($res);die;

                if ($res) {
                    return redirect('/admin/index');
                } else {
                    return back()->with('抱歉! 修改失败!');
                };
        };

        
    }

}
