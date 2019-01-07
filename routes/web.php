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

<<<<<<< HEAD
// Route::group();
Route::get('admin/dashboard','AdminDashboardController@index')->name('admin.dashboard');
=======

Route::get('admin/dashboard','AdminDashboardController@index')->name('admin.dashboard');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
>>>>>>> 804f1c678dd13b948fe1af580b77749120e8b848
