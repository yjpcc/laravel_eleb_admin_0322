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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::redirect('/','login');
//商家分类
Route::resource('/shopcategorys','ShopCategoryController');

//商家管理
Route::resource('/shops','ShopController');

//商户账号管理
Route::resource('/shopusers','ShopUserController');

//平台账号管理
Route::resource('/admins','AdminController');
Route::patch('/admins/editInfo/{admin}', 'AdminController@editInfo')->name('editInfo');
Route::patch('/admins/editPwd/{admin}', 'AdminController@editPwd')->name('editPwd');

//商家审核
Route::get('/check/{shop}','ShopController@check')->name('check');
Route::get('/checkuser/{shopuser}','ShopUserController@check')->name('checkuser');

//登录
Route::get('login', 'SessionController@login')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@logout')->name('logout');
