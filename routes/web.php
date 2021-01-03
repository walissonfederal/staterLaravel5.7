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

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'as' => 'admin.'], function (){

/*** formulario de login ***/
Route::get('/', 'AuthController@ShowLoginForm')->name('login');
Route::post('login', 'AuthController@login')->name('login.do');

    /*** rotas protegidas ***/
    Route::group(['middleware'=> ['auth']],function (){
        Route::get('home', 'AuthController@home')->name('home');
        Route::get('users/team', 'UserController@team')->name('users.team');
        Route::resource('users', 'UserController');
    });

    /*** logout ***/
Route::get('logout', 'AuthController@logout')->name('logout');
Route::get('master/teste', 'UserController@teste')->name('master.teste');

});
