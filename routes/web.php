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

Route::get('qr-code','HomeController@qr_code');
Route::get('qr-code-img','HomeController@qr_code_img');
Route::get('show-image/{dir}/{filename}','HomeController@show_image');
Route::get('show-info','HomeController@info');

Route::get('/',function(){
    return redirect('login');
});

Route::group(['middleware'=>'auth'],function(){
    
    Route::get('home','HomeController@index');

    Route::resource('konten','KontenWebController');
});

Auth::routes([
    'register' => false,
    'reset' => false
]);