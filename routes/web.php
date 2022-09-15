<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/login', 'UserController@create')->name('admin.login');
Route::any('/register', 'UserController@register')->name('admin.register');
Route::any('/logout', 'UserController@logout')->name('admin.logout');
Route::any('/store', 'UserController@store')->name('admin.user.store');
Route::any('/postlogin', 'UserController@postLogin')->name('admin.user.postlogin');

Route::group(['middleware'=>'auth'],function()
{
	Route::any('/dashboard', 'UserController@index')->name('admin.user.index');
	Route::any('/update', 'UserController@store')->name('admin.user.update');
	Route::any('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
	Route::any('/destroy/{id}', 'UserController@destroy')->name('admin.user.destroy');
});
