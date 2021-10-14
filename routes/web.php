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

Route::get('/', 'App\Http\Controllers\BaseController@index')->name('homepage');
Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user.index');
Route::get('/user/list', 'App\Http\Controllers\UserController@getList')->name('user.list');
Route::get('/user/create', 'App\Http\Controllers\UserController@create')->name('user.create');
Route::post('/user/create', 'App\Http\Controllers\UserController@store')->name('user.store');
Route::get('/user/{id}/edit', 'App\Http\Controllers\UserController@edit')->name('user.edit');
Route::post('/user/{id}/edit', 'App\Http\Controllers\UserController@update')->name('user.update');
Route::delete('/user/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');


Route::get('/company', 'App\Http\Controllers\CompanyController@index')->name('company.index');
Route::get('/company/list', 'App\Http\Controllers\CompanyController@getList')->name('company.list');
Route::get('/company/create', 'App\Http\Controllers\CompanyController@create')->name('company.create');
Route::post('/company/create', 'App\Http\Controllers\CompanyController@store')->name('company.store');
Route::get('/company/{id}/edit', 'App\Http\Controllers\CompanyController@edit')->name('company.edit');
Route::post('/company/{id}/edit', 'App\Http\Controllers\CompanyController@update')->name('company.update');
Route::delete('/company/{id}', 'App\Http\Controllers\CompanyController@destroy')->name('company.destroy');
