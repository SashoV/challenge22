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



Auth::routes();


Route::get('/', 'ThreadController@index')->name('home');
Route::get('/thread/create', 'ThreadController@create')->name('create')->middleware('checkRole:admin,user');
Route::get('/thread/{id}', 'ThreadController@show')->name('thread');
Route::get('/thread/{id}/edit', 'ThreadController@edit')->name('edit')->middleware('checkRole:admin,user');

Route::post('/', 'ThreadController@store')->name('store')->middleware('checkRole:admin,user');
Route::put('/thread/{id}', 'ThreadController@update')->name('update')->middleware('checkRole:admin,user');
Route::delete('/thread/{id}', 'ThreadController@destroy')->name('destroy')->middleware('checkRole:admin,user');


Route::get('/thread/{id}/comment/{comment_id}/edit', 'CommentsController@edit')->name('editComment')->middleware('checkRole:admin,user');
Route::post('/thread/{id}', 'CommentsController@store')->name('storeComment')->middleware('checkRole:admin,user');
Route::put('/thread/{id}/comment/{comment_id}', 'CommentsController@update')->name('updateComment')->middleware('checkRole:admin,user');
Route::delete('/thread/{id}/comment/{comment_id}', 'CommentsController@destroy')->name('destroyComment')->middleware('checkRole:admin,user');


Route::get('/admin', 'AdminController@index')->name('admin')->middleware('checkRole:admin');
Route::put('/admin/approve/{id}', 'AdminController@update')->name('approve')->middleware('checkRole:admin');
Route::delete('/admin/delete/{id}', 'AdminController@destroy')->name('deleteThread')->middleware('checkRole:admin');
