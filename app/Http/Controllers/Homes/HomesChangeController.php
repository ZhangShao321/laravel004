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

use Cookie;

class HomesChangeController extends Controller
{
    //
    public function index()
    {
    	return view('/homes/change');
    }

    public function doAction(Request $request)
    {
        // dd($request);
    	$phone = $request->input('phone');
        // dd($phone);

    	$res = user::where('phone',$phone)->first();
    	if(!$res){

    		return "你还没注册,赶快去注册吧!";
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
    	// 使用Hash加密新密码
    	$password= Hash::make($request->input('password'));
    	 
      	// // 获取存入session中的code
      	$session_code = session('code');

      	//验证码是否一致
       if($request->input('code') == $session_code)
       {
       		// 将修改的密码存入数据库
 			user::where('phone',$request->input('phone'))->update(['password'=>$password]);

       		echo "1";
       	}

    }
}
