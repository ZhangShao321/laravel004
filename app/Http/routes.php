<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

 


Route::group(['namespace'=>'Homes'], function(){
    Route::get('/', 'HomesController@index');
});




// Route::get('/', function () {
//     return view('welcome');
// });




//=======================后台信息===================================


//后台路由组
//prefix路由群组中的所有路由包含统一前缀
//namepace控制器位于App\Http\Controllers命名空间下
//
//后台登录页面

Route::get('/admin/login','admin\AdminLoginController@index'); 
//执行登录的方法
Route::post('/admin/dologin','admin\AdminLoginController@dologin');
//生成登录验证码 
Route::get('/admin/code','admin\AdminLoginController@code');
//退出登录的方法
Route::get('/admin/outlogin','admin\AdminLoginController@outlogin');
        

//后台路由组 中间件
Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'adminlogin'], function () {

		//进入后台的首页
		Route::get('/index', 'CeshiController@index');

		//后台user用户管理
		Route::resource('/user','UserController');
        Route::post('/user/phone','UserController@phone');
        Route::post('/user/work','UserController@work');
        Route::get('/user/pass/{id}','UserController@pass');
        Route::post('/user/dopass','UserController@dopass');
        Route::get('/user/photo/{id}','UserController@photo');
        Route::post('/user/dophoto','UserController@dophoto');

		//后台管理员管理
		Route::resource('/guanliyuan','GuanliyuanController');
        Route::post('/guanliyuan/phone','GuanliyuanController@phone');
        Route::post('/guanliyuan/work','GuanliyuanController@work');
        //加载修改密码的页面方法
        Route::get('/guanli/pass','GuanliyuanController@pass');
        //执行修改密码
        Route::post('/guanli/dopass','GuanliyuanController@dopass');
        //添加修改头像页面
        Route::get('/guanli/photo','GuanliyuanController@photo');
         //执行修改头像
        Route::post('/guanli/dophoto','GuanliyuanController@dophoto');
        

		//后台商户(电影院)管理
		Route::resource('/cinema','CinemaController');

		//后台申请管理
		Route::resource('/request','RequestController');

		//后台影视分类
		Route::resource('/film','FilmController');
        Route::post('/film/work','FilmController@work');

        //后台轮播图管理
        Route::resource('/lunbo','LunboController');

		//后台板块管理
		Route::resource('/block','BlockController');

		//后台网站配置
        Route::resource('/net','NetController');

        //订单管理
		Route::resource('/ticket','TicketController');

});




//电影院路由组 
//  php artisan make:controller Film/FilmLoginController --plain


//====================电影院信息=================================









//电影院路由组
//访问 prefix -> resources 中view视图中的 文件夹名
// namespace  是控制器文件夹名 
//  php artisan make:controller Film/FilmLoginController --plain


Route::group(['prefix' => 'FilmAdmins', 'namespace' => 'Film'],function(){
         //电影院登录
        Route::get('FilmLogin','FilmLoginController@index');
        //电影院登录验证码
        Route::get('FilmCode','FilmLoginController@code');
        //处理登录
        Route::post('doAction','FilmLoginController@doAction');


        

        //退出登录
        Route::get('outlogin','FilmLoginController@outlogin');
        // 'middleware'=>'filmlogin'
        Route::group(['middleware'=>'filmlogin'],function(){
            
            //电影院首页
            Route::get('index','FilmUserController@index');
            //电影院logo修改
            Route::get('Profile','FilmUserController@Profile');
            //执行图片修改
            Route::post('dopro','FilmUserController@doPro');
            //修改密码
            Route::get('pass','FilmUserController@PasEdit');
            //执行修改密码
            Route::get('updatePass','FilmUserController@PasUpdate');



            //电影院信息
            Route::get('info','FilmUserController@FilmInfo');
            //执行信息修改
            Route::post('filmUp','FilmUserController@filmUpdate');



            //影片管理
            Route::get('filmMsg','FilmMsgController@index');
            Route::get('filmMsgAdd','FilmMsgController@add');
            //处理影片
            Route::post('doAdd','FilmMsgController@doAdd');
            //编辑页面
            Route::get('edit','FilmMsgController@edit');
            //处理更新
            Route::post('update','FilmMsgController@update');
            //删除
            Route::get('delete','FilmMsgController@delete');



            //放映管理
            Route::get('filmShow','FilmShowController@index');
            Route::get('filmShowAdd','FilmShowController@add');
            Route::post('showdoAdd','FilmShowController@doadd');
            //放映编辑
            Route::get('showEdit','FilmShowController@edit');
            Route::post('showUpdate','FilmShowController@update');
            //删除放映
            Route::get('showDelete','FilmShowController@delete');
            //空闲时间
            Route::post('showtime','FilmShowController@showtime');



            //钱包
            Route::get('money','FilmMoneyController@index');

            //影厅
            Route::get('/room/add','FilmRoomController@add');
            /*Route::get('/room/add',function(){
            	echo 1111111111111;
            });*/
            Route::post('/room/insert','FilmRoomController@insert');
            Route::get('/room/list','FilmRoomController@index');
            Route::post('/room/seat','FilmRoomController@seat');
            Route::get('/room/edit/{id}','FilmRoomController@edit');
            Route::post('/room/update/{id}','FilmRoomController@update');
            Route::post('/room/delete/{id}','FilmRoomController@delete');
            Route::post('/room/work','FilmRoomController@work');
            Route::get('/room/seats/{id}','FilmRoomController@seats');
            Route::get('/room/seatedit/{id}','FilmRoomController@seatedit');
            Route::post('/room/seatupdate/{id}','FilmRoomController@seatupdate');


            //电影票
            Route::get('/ticket/list', 'FilmTicketController@index');
            Route::get('/ticket/shop/{id}', 'FilmTicketController@shop');
            Route::post('/ticket/shopseat/{id}', 'FilmTicketController@shopseat');
            Route::post('/ticket/shopseat_into/{id}', 'FilmTicketController@shopseat_into');
    });




});







//===============================前台信息=============================





Route::group(['prefix' => 'homes', 'namespace' => 'Homes'], function(){

	//前台首页
	Route::get('index','HomesController@index');

	//电影列表页
	Route::get('filmlist','HomesController@filmlist');

	//电影详情页
	Route::get('filmdetail','HomesController@filmdetail');

	//电影院列表页
	Route::get('cinemalist','HomesController@cinemalist');

	//电影院详情
    Route::get('cinemadetail','HomesController@cinemadetail');

    //申请商户
	Route::get('add','HomesController@add');
    Route::post('store','HomesController@store');

    //搜索框的页面
    Route::get('search','HomesController@search');

    //查看各类型电影的页面
    Route::get('type','HomesController@type');

    //订座
    Route::get('dingpiao','HomesController@dingpiao');
    Route::post('/shopseat/{id}','HomesController@shopseat');
    Route::post('/shopseat_into/{id}','HomesController@shopseat_into');

    //订单确认页面
    Route::get('/piao','HomesController@piao');
    Route::get('/money','HomesController@money');






    //电影院注册
    Route::get('register','HomesRegisterController@index');

     //短信验证
    Route::get('test','HomesRegisterController@doAction');
     //判断
    Route::post('doregister','HomesRegisterController@store');

    

    //电影院登录
	Route::get('login','HomesLoginController@index');

    Route::post('dologin','HomesLoginController@dologin');
	
    //个人中心
    Route::get('details','HomesDetailController@index');
    
    Route::post('doaction','HomesDetailController@store');

	//修改密码
    Route::get('change','HomesChangeController@index');
    Route::get('pass','HomesChangeController@doAction');
    Route::post('dopass','HomesChangeController@store');
    //个人订单
    Route::get('center','HomesCenterController@index');
    Route::get('insert','HomesCenterController@insert');
 



});

