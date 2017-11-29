<?php

namespace App\Http\Controllers\Film;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Hash;

use App\Http\Model\cinlogin;

class FilmLoginController extends Controller
{
    //

       //电影院登录页面
    public function index()
    {
        return view('FilmAdmins.FilmUser.filmlogin');
    } 

      //电影院信息填写
    public function code()
    {
        // echo 1111;die;
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 120, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('vcode', $phrase);

        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();

    }



    public function doAction(Request $request)
    {
        // echo "这是处理登录方法";die;

        //获取
        $res = $request->except('_token');
       

        //判断用户是否存在
        $ddd = cinlogin::where('cinema',$res['cinema'])->where('status',2)->first();

        echo "<pre>";

        // var_dump($ccc);
        // var_dump($ddd->password);die;
        

        if(!$ddd)
        {
            return redirect('/FilmAdmins/FilmLogin')->with('msg','您输入的用户名或密码错误');
            
        }

        //验证密码
        if(!Hash::check($res['password'],$ddd->password)){

            return redirect('/FilmAdmins/FilmLogin')->with('msg','用户名或密码不正确');
        }


        //验证验证码
        if(!session('vcode') == $res['code'])
        {
            return redirect('/FilmAdmins/FilmLogin')->with('msg','验证码错误');
        }
    
        session(['cid' => $ddd->cid]);

        // var_dump(session('cid'));die;

        return redirect("/FilmAdmins/index");

    }




    //退出
   public  function outlogin(Request $request)
   {

            //销毁session
            $res = $request->session()->flush();


            if($res)
            {
                return  redirect("/FilmAdmins/FilmLogin");
            }
            else{
                return back();
            }

   }  




}
