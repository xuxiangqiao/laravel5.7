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
////    session(['uid'=>88]);
////    return view('welcome',['name'=>'季盛开']);
//    
//});
//Route::view('/','welcome',['name'=>'季盛开']);

//路由闭包请求
//Route::get('/goods', function () {
//    return 'goods !!!';
//});
//路由 url 请求
Route::get('/goods', 'GoodsController@index');

//Route::get('/from', function () {
//    return "<form action='/sendemail' method=post>".csrf_field()."<input type=text name=email ><button>提交</button></form>";
//});
Route::get('/from', function () {
    return "<form action='/send' method=post>".csrf_field()."<input type=text name=mobile ><input type=password name=password ><button>提交</button></form>";
});
//Route::post('/from_do', function () {
//    
//    return request()->name;
//});

Route::post('/logindo', 'BrandController@logindo');

Route::post('/sendemail', 'BrandController@sendemail');
Route::any('/from_do', function () {
    
    return request()->name;
});

//路由传参
Route::get('/goods/{catid}/{id}',function($catid,$id){
    echo $catid.'-'. $id;
});

Route::get('/goods/{id?}', function ($id=0) {
    return redirect('/goods');
})->where('id','\d+');


//商品品牌 curd\

Route::prefix('/brand')->group(function(){
    Route::get('add', 'BrandController@create');
   // Route::post('add_do', 'BrandController@store')->name('doadd');//起别名 跟route一起用
    Route::post('add_do', 'BrandController@store');
    Route::get('list', 'BrandController@index');
    Route::get('show/{id}', 'BrandController@show');
    Route::get('edit/{id}', 'BrandController@edit');
    Route::post('update/{id}', 'BrandController@update');
    Route::post('del/{id}', 'BrandController@destroy');
    Route::post('checkName', 'BrandController@checkName');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Index\IndexController@index');
Route::post('/send', 'Index\IndexController@send');
//pc pay
Route::get('/pcpay', 'Index\IndexController@pcpay');
Route::get('/returnpay', 'Index\IndexController@returnpay');
//mobile pay
Route::get('/mobilepay', 'Index\IndexController@mobilepay');

Route::post('/notifypay', 'Index\IndexController@notifypay');
