<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info',function(){
    phpinfo();
});
Route::get("/hello","TestController@hello")->middleware('count');
Route::get("/wx/token","TestController@wxgettoke    n");
Route::get("/wx/token2","TestController@wxgettoken2");
Route::get("/wx/token3","TestController@wxgettoken3");
Route::get("/api/token","TestController@getaccesstoken");

Route::get("user/info","TestController@userinfo");
Route::get("test2","TestController@test2");

//注册
Route::post("user/reg","User\IndexController@reg");
Route::post("user/regadd","User\IndexController@regadd");

//登录
Route::post("user/login","User\IndexController@login");
Route::any("user/loginadd","User\IndexController@loginadd");

// 用户个人信息
Route::get("user/center","User\IndexController@center")->middleware('accesstoken','all','user');


//联系hash
Route::get("test/hash1","TestController@hash1");
Route::get("test/hash2","TestController@hash2");

Route::get("test/goodsstore","TestController@goodsstore");
Route::get("test/goodsadd","TestController@goodsadd");


Route::get("/goods/info","User\GoodsController@goods")->middleware('cishu');


//加密
Route::get("/test/enc1","TestController@enc1");
Route::get("/test/enc2","TestController@enc2");
//验签
Route::get("test/sign","TestController@sign");
Route::get("test/sign2","TestController@sign2");

