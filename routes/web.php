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


Route::get('admin/dashboard','AdminDashboardController@index')->name('admin.dashboard');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');

//reset password
Route::post('/password/email', 'Auth\RegisterController@passwordEmail')->name('password.email');
Route::get('/reset/password/{token}', 'Auth\RegisterController@resetPassword')->name('resetpassword');
Route::post('/reset_password', 'Auth\RegisterController@resetPasswordChange')->name('resetpassword.change');
//change password
Route::post('/user/{id}/password', 'Auth\RegisterController@changePassword')->name('change.password');
