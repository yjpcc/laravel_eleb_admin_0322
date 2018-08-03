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

Route::get('/home', function () {
    return view('home');
})->name('home');


//商家分类
Route::resource('/shopcategorys','ShopCategoryController')->middleware(['role:shop-admin']);

//商家管理
Route::resource('/shops','ShopController')->middleware(['role:shop-admin']);

//商户账号管理
Route::resource('/shopusers','ShopUserController')->middleware(['role:shop-admin']);

//平台账号管理
Route::resource('/admins','AdminController')->middleware(['role:admin-admin']);
Route::patch('/admins/editInfo/{admin}', 'AdminController@editInfo')->name('editInfo');
Route::patch('/admins/editPwd/{admin}', 'AdminController@editPwd')->name('editPwd');

//商家审核
Route::get('/check/{shop}','ShopController@check')->name('check')->middleware(['role:shop-admin']);
Route::get('/checkuser/{shopuser}','ShopUserController@check')->name('checkuser')->middleware(['role:shop-admin']);

//登录
Route::get('login', 'SessionController@login')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@logout')->name('logout');

//活动管理
Route::resource('/activitys','ActivityController')->middleware(['role:activity-admin']);

//会员管理
Route::resource('/members','MemberController')->middleware(['role:member-admin']);
Route::get('/checkMember/{member}','MemberController@check')->name('checkMember');

//抽奖活动管理
Route::resource('/events','EventController')->middleware(['role:event-admin']);

//抽奖活动奖品管理
Route::resource('/eventprizes','EventPrizeController')->middleware(['role:event-admin']);
//开奖
Route::get('/open','EventPrizeController@open')->name('open');

Route::get('/open','EventPrizeController@open')->name('open');

//活动报名管理
Route::get('/eventmembers','EventMemberController@index')->name('eventmembers.index')->middleware(['role:event-admin']);
Route::get('/eventmembers/signup','EventMemberController@signup')->name('eventmembers.signup');
//图片上传
Route::post('upload',function (){
    $storage=\Illuminate\Support\Facades\Storage::disk('oss');
    $fileName=$storage->putFile('upload',request()->file('file'));
    return ['fileName'=>$storage->url($fileName)];
})->name('upload');

//统计
Route::get('/orders/count','OrderController@count')->name('orders.count');
//按天统计
Route::get('/orders/day','OrderController@day')->name('orders.day');
//按月统计
Route::get('/orders/month','OrderController@month')->name('orders.month');
//商家菜品销量统计
Route::get('/orders/orderMenu','OrderController@orderMenu')->name('orders.orderMenu');
Route::get('/orders/dayMenu','OrderController@dayMenu')->name('orders.dayMenu');
Route::get('/orders/monthMenu','OrderController@monthMenu')->name('orders.monthMenu');

//权限管理
Route::resource('/permissions','PermissionController')->middleware(['role:RBAC-admin']);
//角色管理
Route::resource('/roles','RoleController')->middleware(['role:RBAC-admin']);

//菜单管理
Route::resource('/navs','NavController')->middleware(['role:nav-admin']);


