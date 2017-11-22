<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\config;
use zgldh\QiniuStorage\QiniuStorage;

class NetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        

        $res=config::all();
        // $res=DB::table('config')->get();
        // dd($res);
        return view('admin.net.index',compact('res'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        if($request->hasFile('logo')){
            
           //先查询
            $find = config::where('id',$id)->first();
      
            $n="http://ozss4v1w9.bkt.clouddn.com/Uplodes/".$find->logo;
             echo $n; 

            //判断图片是否存在  存在就删除    
            if(file_exists($n))
             {  
                 echo "存在";die;
              
                 unlink($n);
             } else{
                 echo "不存在";die;

             }          

             //获取文件
             $file=$request->file('logo');
             //初始化七牛
             $disk=QiniuStorage::disk('qiniu');

            //重命名文件名
            $name=md5(rand(1111,9999).time()).'.'.$file->getClientOriginalExtension();

            //上传到文件到七牛
           $bool=$disk->put('Uplodes/image_'.$name,file_get_contents($file->getRealPath()));

        }

        if($bool){
            //http:/Uplodes/image_981e101cc9a0efecb77f7bb3b7129525.jpg
           // $path=$disk->downloadUrl('Uplodes/image_'.$name);
            $res = $request->except('_token','_method');

            //修改上传logo的名字
            $res['logo'] = 'image_'.$name;

            // dd($res);
             $sql=config::where('id',$id)->update($res);

                if($sql){

                    return redirect('/admin/net')->with('msg','修改成功');
                
                }else{

                    return back();
                }

         
        }else{
           return "上传失败";

        }



/*
        $res = $request->except('_token','_method');

       //修改上传logo的名字
        $res['logo'] = './Uplodes/'.$name.'.'.$hz;


        //执行修改
        $sql=config::where('id',$id)->update($res);

        if($sql){

            return redirect('/admin/net')->with('msg','修改成功');
        
        }else{

            return back();
        }
*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
