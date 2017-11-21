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


    

    //电影院登录
	Route::get('login','HomesLoginController@index');

    Route::post('dologin','HomesLoginController@dologin');
	//电影院注册
	Route::get('register','HomesRegisterController@index');

	 //短信验证
	Route::get('test','HomesRegisterController@doAction');
	 //判断
	Route::post('doregister','HomesRegisterController@store');
	//修改密码
    Route::get('change','HomesChangeController@index');
    Route::get('pass','HomesChangeController@doAction');
    Route::post('dopass','HomesChangeController@store');
    //个人订单
    Route::get('center','HomesCenterController@index');
    Route::get('insert','HomesCenterController@insert');
 

});