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

Route::get('/','DiscussionsController@index');

Route::get('/401',function (){
    abort('401');
});
Route::get('/402',function (){
    abort('402');
});
Route::get('/403',function (){
    abort('403');
});
Route::get('/404',function (){
   abort('404');
});

Auth::routes();
Route::get('/user/changepassword','UserController@changepassword')->name('user.changepassword');
Route::post('/user/password','UserController@changed')->name('user.password');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/verify/{confirm_code}','UserController@confirmEmail');
Route::resource('discussions','DiscussionsController');
Route::post('/comments','CommentsController@store')->name('user.comment');
Route::get('/user/avatar','UserController@avatar')->name('user.avatar');
Route::post('/avatar','UserController@changeAvatar')->name('change.avatar');
Route::post('/crop/api','UserController@cropavatar');