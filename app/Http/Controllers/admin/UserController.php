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
        $user = DB::table('user')->insertGetId($input1);


        //判断$cinema为ture或false
        //为ture时证明id传过来了
        //false就没有值传递过来
        if($user){ 

            //开启事务
            DB::beginTransaction();

            $input2 = $request->only('nickName','email','qq','sex');
            
            //把传递过来的id赋值给$input2['cid']
            $input2['uid'] = $user;


            $userDetail = DB::table('userDetail')->insert($input2);

            if($user && $userDetail)
            {   
                DB::commit();
                return redirect('/admin/user'); 

            }else{
                //回滚
                DB::rollback();
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

        // echo "<pre>";
        $input1 = $request->only('phone');
        $input2 = $request->only('nickName','email','qq','sex');
        
        $res1 = DB::table('user')->where('id',$id)->update($input1);
        $res2 = DB::table('userDetail')->where('uid',$id)->update($input2);

        if($res1 && $res2){
            return redirect('/admin/user');  
        }else{
            return back();
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
}
