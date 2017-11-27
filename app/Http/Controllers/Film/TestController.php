<?php

namespace App\Http\Controllers\Film;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;


use Redis;
use DB;


// use  DB;

use App\Http\Model\user;
use App\Http\Model\film;

class TestController extends Controller
{
     //

    public function index()
    {
        return view("FilmAdmins.FilmUser.test");
    }


    public function doAction(Request $request)
    {
   //   $phone = $request->input('phone');
   //   // $code = $request->input('code');
    
   //       // 配置信息
            // $config = [
            //     'app_key'    => '23470922',
            //     'app_secret' => '665345491559f6f682a65f3bf2e08644',
            //     // 'sandbox'    => true,  // 是否为沙箱环境，默认false
            // ];


            // // 使用方法一
            // $client = new Client(new App($config));
            // $req    = new AlibabaAliqinFcSmsNumSend;
            // $code =  rand(100000, 999999);
            // session(['code' => $code]);
            // $req->setRecNum($phone)
            //     ->setSmsParam([
            //         'number' => $code
            //     ])
            //     ->setSmsFreeSignName('兄弟连')
            //     ->setSmsTemplateCode('SMS_75835101');

            // $resp = $client->execute($req);

            // // dd($resp);
            // // echo $phone;
            
            // if($resp->result->model)
            // {
            //  return "发送成功";
            //  //print_r($resp);
                

            // }else{
            //  return "发送失败!";
            // }

    }




    public function login(Request $request)
    {

            $scode = $request -> session() -> get('code');
            $code = $request -> input('code');

            if($scode == $code )
            {
                return "登录成功!";
            }else{
                return "登录失败!";
            }

    }



    //测试是数据库

    public function  test()
    {
        //注意别忘了  use App\Http\Model\user;
         
        // $res = user::where('id','1')->first();
        // echo "<pre>";
        // var_dump($res->phone);


      //   $info = user::findOrFail(1);
      //   $info -> phone="1234567890";
      //   if($info -> save())
      //   {
      //       echo "修改成功";

      //   }else{
      //       echo "修改失败";
      //   }
       
      // echo "<pre>";
        // var_dump($info);

    }


    public  function redisDemo()
    {

         $redis = new Redis();
        $redis -> connect('127.0.0.1',6379);
        $redis->select(2);

         $res = DB::table('film')->get();
       
         $key = '';
         //hash存储
         foreach ($res as $k => $value) {
             $key = 'film'.$value->id;
            // $redis->hset('film',$k,$value->id);
            // $redis->hset($key,'id',$value->id);
            // $redis->hset($key,'filmname',$value->filmname);
            // $redis->hset($key,'filmtime',$value->filmtime);
            // $redis->hset($key,'keywords',$value->keywords);
            // $redis->hset($key,'summary',$value->summary);
            // var_dump($key);
             
             }

                $tt =$redis->hgetall('film');
                var_dump($tt);















            die;

        //选择相对于的数据库
        $redis->select(1);


        // $user = film::find(4);
        $res = DB::table('film')->get();
       // $test = $res->toArray();
      // var_dump($res);
      // die;
        $key = '';

        // $res = $user->toArray();
        // var_dump($res);
        // // die;
        //   var_dump(count($res));
         
            for($i=0;$i<count($res);$i++){
            // $key = "user:name:".$res[$i]->id;
            // $redis->lpush('film',$key);
        //     var_dump($redis->lpush($key,$res[$i]->cid));
        //     var_dump($redis->lpush($key,$res[$i]->tid));
        //     var_dump($redis->lpush($key,$res[$i]->filmname));
        //     var_dump($redis->lpush($key,$res[$i]->filmtime));
        //     var_dump($redis->lpush($key,$res[$i]->keywords));
        //     var_dump($redis->lpush($key,$res[$i]->summary));
        //     // var_dump($redis->lpush($res[$i]->id,$res->[$i]->cid));
        //     // var_dump($redis->lpush($res[$i]->id,$res->[$i]->cid));
        //     // var_dump($redis->lpush($res[$i]->id,$res->[$i]->cid));
        //     // var_dump($redis->lpush($res[$i]->id,$res->[$i]->cid));
        //     // var_dump($redis->lpush($res[$i]->id,$res->[$i]->cid));
        //     // var_dump($redis->lpush($res[$i]->id,$res->[$i]->cid));
        //     // var_dump($redis->lpush($res[$i]->id,$res->[$i]->cid));









        //     // var_dump($redis->lpush($key,$user['tid']));
        //     // var_dump($redis->lpush($key,$user['filmname']));
        //     // var_dump($redis->lpush($key,$user['filmtime']));
        //     // var_dump($redis->lpush($key,$user['keywords']));
        //     // var_dump($redis->lpush($key,$user['director']));
        //     // var_dump($redis->lpush($key,$user['protagonist']));
        //     // var_dump($redis->lpush($key,$user['summary']));
        //     // var_dump($redis->lpush($key,$user['showtime']));
        //     // var_dump($redis->lpush($key,$user['filepic']));
        //     // var_dump($redis->lpush($key,$user['price']));
        //     // var_dump($redis->lpush($key,$user['shownum']));
        //     // var_dump($redis->lpush($key,$user['status']));

        }
        // var_dump($key);
        // die;
         
     

           // var_dump($key);


      // var_dump($redis->lrange($key,0,-1));
            //将用户名存储到Redis中
      $tt =$redis->lrange("film",0,-1);
      

     // dd(count($tt));
     for($i=0 ; $i<count($tt);$i++){ 
             // var_dump($tt[$i]);
              $test =$redis->lrange($tt[$i],0,-1);
              var_dump($test);
    
     }

         

        //判断指定键是否存在
        // if($redis->exists($key)){
        //     //根据键名获取键值
        //     dd($redis->get($key));
        // }
       

      
        var_dump($res);
        // $redis -> set('name','124');
      
         echo $redis->get('name');

        var_dump($redis);
                

            echo "这是redis测试";


    }
}
