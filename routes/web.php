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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/logout','Auth\LoginController@Userlogout')->name('user.logout');

Route::get('/', 'AdminController@index')->name('admin.dashboard');

Route::prefix('admin')->group(function() {

 
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
    Route::post('/logout','Auth\AdminLoginController@Adminlogout')->name('admin.logout');

    /****  for password reset  ****/
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
   
    Route::get('/posts/','PostController@index');
    Route::get('/posts/index','PostController@index');
    Route::get('/posts/create','PostController@create'); 

});
Route::middleware('auth')->group(function () {
    Route::get('/posts/','PostController@index');
    Route::get('/posts/index','PostController@index');


});