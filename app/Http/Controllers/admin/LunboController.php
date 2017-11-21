<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\lunbo;
class LunboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $res=lunbo::all();
        // dd($res);
        return view('admin.lunbo.index',compact('res'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         return view('admin.lunbo.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //判断是否有文件上传
       if($request->hasFile('picname')){
           
            //获取文件名
            $name=rand(1111,9999).time();

            //获取文件名后缀
            $hz=$request->file('picname')->getClientOriginalExtension();

            //移动文件
            $request->file('picname')->move('./Uplodes/',$name.'.'.$hz);
        }else{
              
            //如果没有文件上传  判断是否输入了电影名称  
            if($request->only('fname')){

                return back()->with('lbt','请上传轮播图或电影名称!');
                die;
            }
            
        }

        //如果有文件上传了  检测是否存在电影名称的值
       if($request->has('fname')){
            $res = $request->except('_token');

            //修改上传轮播图的名字
            $res['picname'] = './Uplodes/'.$name.'.'.$hz;

            //获取上传时间
            $res['time']=time();

            //插入到数据库
            $sql=lunbo::insert($res);

            if($sql){

                return redirect('/admin/lunbo')->with('msg','添加成功');
            }else{

                return back()->withInput();
            }
          
        }else{

             return back()->with('lbt','请输入电影名称!');
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

        $sql=lunbo::find($id);
        // dd($res);
        return view('admin.lunbo.edit',compact('sql'));
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
        


         //判断是否有文件上传
        
        if($request->hasFile('picname')){
            
            //先查询
            $s=lunbo::find($id);

            //判断图片是否存在  存在就删除  
            if(file_exists($s->picname)){

                //图片要绝对路径
                unlink($s->picname);

            }
            //获取文件名
            $name=rand(1111,9999).time();

            //获取文件名后缀
            $hz=$request->file('picname')->getClientOriginalExtension();

            //移动文件
            $request->file('picname')->move('./Uplodes/',$name.'.'.$hz);
        }else{

             return back()->with('msg','请上传轮播图!');
             die;
        }


        $res = $request->except('_token','_method');

       //修改上传logo的名字
        $res['picname'] = './Uplodes/'.$name.'.'.$hz;


        //执行修改
        $sql=lunbo::where('id',$id)->update($res);

        if($sql){

            return redirect('/admin/lunbo')->with('msg','修改成功');
        
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

            //先查询
            $s=lunbo::find($id);

            //判断图片是否存在  存在就删除  
            if(file_exists($s->picname)){

                //图片要绝对路径
                unlink($s->picname);

            }

            //执行删除
            $sql=lunbo::where('id',$id)->delete();

            if($sql){

                return redirect('/admin/lunbo')->with('msg','删除成功');    
            }else{
                
                return back();
            }
    }
}
