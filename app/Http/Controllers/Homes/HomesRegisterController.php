<?php

namespace App\Http\Controllers\Homes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;


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
         
         // var_dump($phone);die;

        $res = DB::table('user')->where('phone',$phone)->first();
    
        if($res)
        {
            return '手机号已注册!!';
        }       


            $config = [
                'accessKeyId'    => 'LTAIO72dhdEdsuJK',
                'accessKeySecret' => 'Ify72jjwShgLbKkW8WqXeDC6PwjD5Q',
                ];

            $code = rand(100000,999999);

            $client  = new Client($config);
            $sendSms = new SendSms;     
            $sendSms->setPhoneNumbers($phone);
            $sendSms->setSignName('刘俊520love');
            $sendSms->setTemplateCode('SMS_110835198');
            $sendSms->setTemplateParam(['code' => $code]);
            $sendSms->setOutId('1314520');
            // print_r($client->execute($sendSms));
           $resp = $client->execute($sendSms);
            if($resp->Code=='OK')
            {
                session()->put('code',$code);

                echo 1;

            }else{

                echo 0;
            }

   		   

    }

        public function store(Request $request)
        {
            // 获取注册信息并放入数组res

            $res = $request->except('_token','code');
<<<<<<< HEAD
 
            // 使用Hash加密注册密码
            $res['password'] = Hash::make($res['password']);
           
=======

            // 使用Hash加密注册密码
            $res['password'] = Hash::make($res['password']);
         
>>>>>>> 2f72f0f526cc181109b89a3fd15c536815615219
            // 获取存入session中的code
            $session_code = session('code');

             //验证码是否一致
            if($session_code == $request->input('code'))
            {
                // 注册信息存入数据库
<<<<<<< HEAD
                $uid = DB::table('user')->insertGetId($res);
=======
                
                $uid = DB::table('user')->insertGetId($res); 
>>>>>>> 2f72f0f526cc181109b89a3fd15c536815615219

                if($uid){

                    $bbb = DB::table('userDetail')->insert(['uid'=>$uid]);

                    if($bbb){
<<<<<<< HEAD
                       echo 1; 
                   } else {
                        DB::table('user')->where('id',$uid)->delete();
                        echo 0;
                   }
                }else{

                    
                    echo 0;
                }

                

                
                
=======
                        echo '1';
                    }else{
                        DB::table('user')->where('id',$uid)->delete();
                        echo '0';
                    }
                    
                }else{
                    echo '0';
                }

                       
>>>>>>> 2f72f0f526cc181109b89a3fd15c536815615219
            }

        }
}
