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
    return redirect('/index');

});

//后台登录路由
Route::resource('/adminlogin','Admin\AdminLoginController');

//后台路由组
Route::group(['middleware'=>'adminlogin'],function(){
	//后台首页路由
	Route::resource('/admin','AdminController');
	//会员模型模块路由
	Route::resource('/adminuser','Admin\UserController');
	Route::get('/userinfo/{id}','Admin\UserController@userinfo');
	Route::get('/useraddress/{id}','Admin\UserController@useraddress');
	//后台无限分类添加
	Route::resource('/admincates','Admin\CateController');
	//后台管理员路由
	Route::resource('/adminusers','Admin\AdminusersController');
	//分配角色
	Route::get('/adminuserrole/{id}','Admin\AdminusersController@adminuserrole');
	//保存角色
	Route::post('/saverole/{id}','Admin\AdminusersController@saverole');
	//角色管理
	Route::resource('/role','Admin\roleController');
	//分配权限
	Route::get('/adminauth/{id}','Admin\roleController@adminauth');
	//保存权限
	Route::post('/saveauth','Admin\roleController@saveauth');
	//权限管理
	Route::resource('/auth','Admin\AuthController');
	//公告模块
	Route::resource('/article','Admin\articleController');
	//ajax删除
	Route::get('/articledel','Admin\articleController@del');
	//商品模块
	Route::resource('/adminshop','Admin\shopController');
	//订单模块
	Route::resource('/adminorder','Admin\dingdanController');
	//轮播图
	Route::resource('/adminlunbo','Admin\lunboController');
	//友情链接
	Route::get('/adminhezuo','Admin\hezuoController@adminhezuo');
	Route::resource('/adminhezuo1','Admin\hezuoController');





});

//demo示例
Route::resource('/demo','Demo\DemoController');
Route::get('/scanLogin/{code}','Demo\DemoController@phoneScanLogin');


Route::resource('/test','Demo\TestController');




























//前台首页路由
Route::resource('/index','HomeController');
//前台公告
Route::get('/gonggao/{id}','HomeController@gonggao');
//前台搜索
Route::get('/ss','HomeController@ss');
//前台友情链接显示
Route::get('/youqing','HomeController@youqing');
//邮箱注册路由
Route::get('/sendmail','Home\RegisterController@sendmail');
//测试邮件 发送试图
Route::get('/sendmail1','Home\RegisterController@sendmail1');
//前台注册
Route::resource('/homeregister','Home\RegisterController');
//测试验证码
Route::get('/code','Home\RegisterController@code');
//激活用户
Route::get('/jihuo','Home\RegisterController@jihuo');
//手机号注册
Route::post('/registerphone','Home\RegisterController@registerphone');
//检测手机号是否唯一
Route::get('/checkphone','Home\RegisterController@checkphone');
//发送短信校验码
Route::get('/registersendphone','Home\RegisterController@registersendphone');
//检测校验码
Route::get('/checkcode','Home\RegisterController@checkcode');
//前台登录路由
Route::resource('/homelogin','Home\HomeLoginController');
//前台退出登录
Route::get('/homeloginout','Home\HomeLoginController@homeloginout');
//忘记密码
Route::get('/forget','Home\HomeLoginController@forget');
Route::post('/doforget','Home\HomeLoginController@doforget');
Route::get('/reset','Home\HomeLoginController@reset');
Route::post('/doreset','Home\HomeLoginController@doreset');
Route::group(['middleware'=>'homelogin'],function(){
	//购物车
	Route::resource('/homecart','Home\CartController');
	//删除
	Route::get('/alldelete','Home\CartController@alldelete');
	//ajax减
	Route::get('/cartupdate','Home\CartController@cartupdate');
	//ajax加
	Route::get('/cartupdate1','Home\CartController@cartupdate1');
	Route::get('/bbb','Home\CartController@bbb');
	//勾选购买商品
	Route::get('/homecarttot','Home\CartController@homecarttot');
	//结算界面
	Route::resource('/homeorder','Home\OrderController');
	//结算
	Route::get('/jiesuan','Home\OrderController@jiesuan');
	Route::get('/insert','Home\OrderController@insert');
	//获取城市级联
	Route::get('/address','Home\addressController@address');
	//收货地址保存路由
	Route::post('/addressinsert','Home\addressController@addressinsert');
	//选择收获地址
	Route::get('/choose','Home\addressController@choose');
	//开始支付
	Route::post('/homeordercreate','Home\OrderController@homeordercreate');
	//支付完毕后跳转
	Route::get('/returnurl','Home\OrderController@returnurl');
	//前台友情链接申请
	Route::get('/hezuo','HomeController@hezuo');
	Route::post('/hezuo1','HomeController@hezuo1');





	//前台个人中心
	Route::resource("/homeperson","Home\PersonController");
	//青苔个人中心的修改保存
	Route::any("/personindexinsert","Home\PersonController@personindexinsert");
	//前台个人中心收货地址
	Route::get("/personaddress","Home\PersonController@personaddress");
	//前台个人中心收货地址保存
	Route::get("/personaddressc","Home\PersonController@personaddressc");
	//前台个人中心订单管理
	Route::get("/personorder","Home\PersonController@personorder");
	//前台个人中心订单删除
	Route::get("/presonorderdel/{id}","Home\PersonController@presonorderdel");
	//前台个人中心确认收货
	Route::get("/presonorderupdate/{id}","Home\PersonController@presonorderupdate");
	//前台个人中心退款售后
	Route::get("/personchange","Home\PersonController@personchange");
	//前台个人中心的评价商品
	Route::get("/personcomment","Home\PersonController@personcomment");
	//前台个人中心的评价保存
	Route::any("/personcommentinsert","Home\PersonController@personcommentinsert");
});
