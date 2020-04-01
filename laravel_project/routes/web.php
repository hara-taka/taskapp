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

Auth::routes();

Route::get('/tasks/{user_id}','TasksController@index')->name('tasks.index');

Route::post('/tasks/{user_id}/store','TasksController@store')->name('tasks.store');

Route::get('/tasks/{user_id}/{task_id}/edit','TasksController@edit')->name('tasks.edit');

Route::post('/tasks/{user_id}/{task_id}/update','TasksController@update')->name('tasks.update');

Route::delete('/tasks/{user_id}/{task_id}/destroy','TasksController@destroy')->name('tasks.destroy');

Route::get('/groups','GroupsController@index')->name('groups.index');

Route::get('/groups/create','GroupsController@create')->name('groups.create');

Route::post('/groups/store','GroupsController@store')->name('groups.store');

Route::get('/groups/{group_id}','GroupsController@details')->name('groups.details');

Route::post('/groups/{group_id}','GroupsController@participate')->name('groups.participate');

Route::get('/home', 'HomeController@index')->name('home');
