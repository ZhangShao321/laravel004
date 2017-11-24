<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\model\user;
use App\Http\model\userDetail;

use DB;
use Hash;
class UserController extends Controller
{

    public function index(Request $request)
    {
        
        $res = DB::table('user')->join('userDetail','userDetail.uid','=','user.id')->
            select('user.id','user.phone','userDetail.nickName','user.auth','user.status','user.lastlogin','userDetail.uid','userDetail.email','userDetail.qq','userDetail.sex')->
            where('phone','like','%'.$request->input('search').'%')->
            orderBy('id','asc')->
            paginate($request->input('num',10));

        return view('admin.user.index',['res'=>$res,'request'=>$request]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //显示添加用户表单


       return view('admin.user.add');
       


       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input1 = $request->only('phone','password','lastlogin');


        //哈希加密
        $input1['password'] = Hash::make($input1['password']);

        // $time = time();
      
        $input1['lastlogin'] = time();
        echo "<pre>";
        // var_dump($input1);die;
        
        //定义一个变量$cinema存查询cinema表的id
        $uid = DB::table('user')->insertGetId($input1);


        //判断$cinema为ture或false
        //为ture时证明id传过来了
        //false就没有值传递过来
        if($uid){ 

            //头像上传
            if($request -> hasFile('photo')){
        

            $clic = DB::table('userDetail')->where('uid',$uid)->first();

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
                $res = DB::table('userDetail')->where('uid',$uid)->update(['photo'=>$photo]);

                //获取其他数据
                $input2 = $request->only('nickName','email','qq','sex');
            
                //把传递过来的id赋值给$input2['cid']
                $input2['uid'] = $uid;


                $userDetail = DB::table('userDetail')->insert($input2);

                if($user && $userDetail)
                {   
                    return redirect('/admin/user'); 

                }else{
                    return back();
                }

            } else {


                $input2 = $request->only('nickName','email','qq','sex');
            
                //把传递过来的id赋值给$input2['cid']
                $input2['uid'] = $uid;


                $userDetail = DB::table('userDetail')->insert($input2);

                if($user && $userDetail)
                {   
                    return redirect('/admin/user'); 

                }else{
                    return back();
                }
            }

            
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

        // var_dump($id);
        $res1 = user::find($id);
        $res2 = userDetail::where('uid',$id)->first();
        // echo "<pre>";
        // var_dump($res);
        return view('admin.user.edit',['res1'=>$res1,'res2'=>$res2]);

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

        $input2 = $request->only('nickName','email','qq','sex');
        
        $res1 = DB::table('user')->where('id',$id)->update($input1);
        $res2 = DB::table('userDetail')->where('uid',$id)->update($input2);

        if($res1 && $res2){
            return redirect('/admin/user')->with('修改成功');  
        }else{
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
    
        DB::beginTransaction();

        $res1 = DB::table('user')->where('id',$id)->delete();
        $res2 = DB::table('userDetail')->where('uid',$id)->delete();

        // var_dump($res1);die;
        if($res1 || $res2){
            DB::commit();
            return redirect('/admin/user')->with('删除成功');
        }else{
            return back();
        }

       
    }


    //添加用户验证
    public function phone(Request $request)
    {
        $phone = $request->except('_token')['phone'];

        $data = DB::table('user')->where('phone',$phone)->first();

        if ($data) {

            echo "用户已存在";
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

        if($data['status'] == '1'){

            $res1 = DB::table('user')->where('id',$data['id'])->update(['status'=>0]);
            if($res1){
                echo '1';
            }else{
                echo '0';
            }
        }else if($data['status'] == '0'){
            $res2 = DB::table('user')->where('id',$data['id'])->update(['status'=>1]);
            if($res2){
                echo '2';
            }else{
                echo '0';
            }
        }
    }


}
