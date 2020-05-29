<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// 第二天练习
// Route::prefix('studen')->group(function(){
//     Route::get('/','StudenController@list');
//     Route::get('create','StudenController@create');
//     Route::post('store','StudenController@store');
// });



// Route::get('/',function(){
//     dd('欢迎来到德莱联盟,王牌飞行员申请出战');
// });
// Route::view('111','index');
// Route::get('123',function(){
//     return view('index');
// });
//     Route::post('addDo','TestController@addDo');
//     Route::get('index','TestController@index');
// 后台
Route::domain('admin.lavel.com')->group(function () {
    Route::get('/','Admin\ShopController@index')->middleware('login');//展示
    // 商品品牌
    Route::prefix('brand')->middleware('login')->group(function(){
        Route::get('/','Admin\BrandController@index');//展示
        Route::get('create','Admin\BrandController@create');//添加
        Route::post('store','Admin\BrandController@store');//执行添加
        Route::get('destroy/{id}','Admin\BrandController@destroy');//删除
        Route::get('edit/{id}','Admin\BrandController@edit');//修改
        Route::post('update/{id}','Admin\BrandController@update');//执行修改

    });
    // 商品分类
    Route::prefix('cate')->middleware('login')->group(function(){
        Route::get('create','Admin\CateController@create');
        Route::post('store','Admin\CateController@store');
        Route::get('/','Admin\CateController@index');
        Route::get('edit/{id}','Admin\CateController@edit');
        Route::post('update/{id}','Admin\CateController@update');
        Route::get('destroy/{id}','Admin\CateController@destroy');
    });
    // 商品
    Route::prefix('shop')->middleware('login')->group(function(){
        Route::get('create','Admin\ShopController@create');
        Route::post('store','Admin\ShopController@store');
        Route::get('/','Admin\ShopController@index');
        Route::get('edit/{id}','Admin\ShopController@edit');
        Route::post('update/{id}','Admin\ShopController@update');
        Route::post('destroy/{id}','Admin\ShopController@destroy');
        Route::post('checkName','Admin\ShopController@checkName');
    });
    // 管理员
    Route::prefix('admin')->middleware('login')->group(function(){
        Route::get('create','Admin\AdminController@create');
        Route::post('store','Admin\AdminController@store');
        Route::get('/','Admin\AdminController@index');
        Route::get('edit/{id}','Admin\AdminController@edit');
        Route::post('update/{id}','Admin\AdminController@update');
        Route::get('destroy/{id}','Admin\AdminController@destroy');
    });
    // 文章
    Route::prefix('essay')->middleware('login')->group(function(){
        Route::get('create','Admin\EssayController@create');
        Route::post('store','Admin\EssayController@store');
        Route::get('/','Admin\EssayController@index');
        Route::get('edit/{id}','Admin\EssayController@edit');
        Route::post('update/{id}','Admin\EssayController@update');
        Route::get('destroy/{id}','Admin\EssayController@destroy');
        Route::get('destroys/{id}','Admin\EssayController@destroys');
    });
    Route::get('/login','Admin\LoginController@login');
    Route::post('/login/loginDo','Admin\LoginController@loginDo');
    // cookie练习
    Route::get('setcookie','Admin\LoginController@setcookie');
    Route::get('getcookie','Admin\LoginController@getcookie');
});
/**
 * 前台
 */
Route::domain('www.lavel.com')->group(function () {
    Route::get('/','Index\IndexController@index')->name('shop.index');
    Route::get('login','Index\LoginController@login');
    Route::post('loginDo','Index\LoginController@loginDO');
    Route::get('reg','Index\LoginController@reg');
    Route::post('regDo','Index\LoginController@regDo');
    Route::get('telSms','Index\LoginController@telSms');
    Route::get('emailSms','Index\LoginController@emailSms');
    Route::get('proinfo/{id}','Index\ProinfoController@proinfo')->name('shop.proinfo');
    Route::get('car','Index\CarController@car')->name('shop.car')->middleware('user');//购物车展示
    Route::post('carDo','Index\CarController@carDo');//添加购物车
    Route::get('account/{id}','Index\PayController@account')->name('shop.pay')->middleware('user');//添加购物车
    Route::get('addressAdd','Index\AddressController@addressAdd')->name('shop.addressAdd')->middleware('user');//添加地址
    Route::post('addressCity','Index\AddressController@addressCity')->name('shop.addressCity')->middleware('user');//获取区县级信息
    Route::post('addressArea','Index\AddressController@addressArea')->name('shop.addressArea')->middleware('user');//获取下拉详细信息
    Route::post('addressAddDo','Index\AddressController@addressAddDo')->name('shop.addressAddDo')->middleware('user');//地址信息添加入库
});