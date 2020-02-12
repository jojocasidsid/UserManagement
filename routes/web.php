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
// */

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::post('/verify/user/{token}', 'Auth\RegisterController@verifyingUser');




Route::get('/users/edit/{key}', 'UserController@edit');
Route::post('/users/update/{key}', 'UserController@update');
Route::get('/users/add/', 'UserController@add');
Route::post('/users/store/', 'UserController@store');
Route::post('/users/delete', 'UserController@destroy');



Route::post('/editProfile', 'HomeController@editProfile');
Route::get('/Settings', 'HomeController@settingsAPI')->name('settings');
Route::post('/Settings/Update', 'HomeController@updatePassSettings');
Route::post('/Settings/Email', 'HomeController@updateEmail');
Route::get('/users/view/{key}', 'HomeController@view');



Route::get('/MustChangePass', 'HomeController@changepass')->name('mustchangePass');
Route::post('/MustChangePass/change', 'HomeController@updatePass')->name('mustchangePass');



Route::get('/2fa','PasswordSecurityController@show2faForm');
Route::post('/generate2faSecret','PasswordSecurityController@generate2faSecret')->name('generate2faSecret');
Route::post('/2fa','PasswordSecurityController@enable2fa')->name('enable2fa');
Route::post('/disable2fa','PasswordSecurityController@disable2fa')->name('disable2fa');


Route::post('/2faVerify', function () {
    return redirect('/home');
})->name('2faVerify')->middleware('2fa');



Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

// // Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');



// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');




Auth::routes();