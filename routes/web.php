<?php

use Illuminate\Foundation\Application;
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

// 게시글 목록
Route::get('/', 'TaskController@list')->name('list');
Route::post('/', 'TaskController@store');

// 게시글 등록
Route::get('/create', 'TaskController@create')->name('create');

// 게시글 보기, 수정, 삭제
Route::get('/show/{board}', 'TaskController@show')->name('show');
Route::PATCH('/show/{board}', 'TaskController@update');
Route::DELETE('/show/{board}', 'TaskController@delete');

// 회원가입
Route::get('/join', 'UserController@join')->name('join');
Route::post('/join', 'UserController@register');

// 로그인
Route::get('/login', 'UserController@loginForm')->name('login');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
