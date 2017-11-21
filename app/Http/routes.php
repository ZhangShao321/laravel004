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

Route::get('/', function () {
    return view('welcome');
});

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
        

	//后台路由组 中间件
	Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'adminlogin'], function () {

			//进入后台的首页
			Route::get('/index', 'CeshiController@index');

			//后台user用户管理
			Route::resource('/user','UserController');


			//后台管理员管理
			Route::resource('/guanliyuan','GuanliyuanController');

			//后台商户(电影院)管理
			Route::resource('/ciname','CinemaController');

			//后台申请管理
			Route::resource('/request','RequestController');

			//后台影视分类
			Route::resource('/film','FilmController');

			//后台轮播图管理
			Route::resource('/lunbo','LunboController');

			//后台板块管理
			Route::resource('/block','BlockController');

			//后台网站配置
			Route::resource('/net','NetController');

	});



