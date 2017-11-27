<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;
use Flc\Alidayu\Requests\SendSms;

use App\Http\Model\user;
use App\Http\Model\userDetail;
use Hash;
use session;
use Cookie;
use DB;
class HomesRegisterController extends Controller
{
    //
     public function index()
    {
    	return view('homes/register');
    }


    public function doAction(Request $request)
    {
    	$phone = $request->input('phone');
        // echo "<pre>";
        // var_dump($phone);
        // var_dump($phone);die;
        $res = DB::table('user')->where('phone',$phone)->first();
    
        if($res)
        {
            return '手机号已注册!!';
        }       


        $config = [
                'app_key'    => '23470922',
                'app_secret' => '665345491559f6f682a65f3bf2e08644',
                // 'sandbox'    => true,  // 是否为沙箱环境，默认false
            ];


            // 使用方法一
            $client = new Client(new App($config));
            $req    = new AlibabaAliqinFcSmsNumSend;
            $code =  rand(100000, 999999);
              
            // session(['code' => $code]);

            $req->setRecNum($phone)
                ->setSmsParam([
                    'number' => $code
                ])
                ->setSmsFreeSignName('兄弟连')
                ->setSmsTemplateCode('SMS_75835101');

            $resp = $client->execute($req);

            if($resp)
            {
                session()->put('code',$code);

                echo 1;

                    // return view('/homes/register');
            }else{

                echo 0;
            }

   		   

    }

             public function store(Request $request)
        {


            // 获取注册信息并放入数组res

            $res = $request->except('_token','code');

            // $aaa['uid']=$res['id'];

            // 使用Hash加密注册密码
            $res['password'] = Hash::make($request->input('password'));
         
            // 获取存入session中的code
            $session_code = session('code');

             //验证码是否一致
             if($session_code == $request->input('code'))
            {
                // 注册信息存入数据库
                user::insert($res);

                // userDetail::insert($aaa);

                echo 1;

                
            }
        }
}
