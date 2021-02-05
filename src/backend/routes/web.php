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

Route::get('/', 'BlogsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/blogs', 'BlogsController@index')->name('blogs');
Route::get('/blogs/create', 'BlogsController@create')->name('blogs.create');
Route::post('/blogs/store', 'BlogsController@store')->name('blogs.store');
Route::get('/blogs/{id}', 'BlogsController@show')->name('blogs.show');
Route::get('/blogs/{id}/edit', 'BlogsController@edit')->name('blogs.edit');
Route::patch('/blogs/{id}/update', 'BlogsController@update')->name('blogs.update');