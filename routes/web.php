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
Route::get('add','AddController@add');
Route::get('jm','testcontroller@jm');
Route::post('pass','testcontroller@pass');
Route::get('open','testcontroller@open');
Route::get('testapp','AddController@testapp');
Route::post('admin','testcontroller@admin');
Route::get('qian','testcontroller@qian');
Route::get('/reg','Test\TestController@reg');//注册
Route::post('/add','Test\TestController@add');//提交注册信息
Route::get('/loginadd','Test\TestController@loginadd');//登录
Route::post('/login','Test\TestController@login');//提交登录信息
Route::get('/conter','Test\TestController@conter')->middleware('conter');