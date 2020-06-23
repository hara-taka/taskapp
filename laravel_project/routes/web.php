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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/guest', 'GuestLoginController@login')->name('guest.login');

Route::get('/tasks/{user_id}/{date?}','TasksController@index')->name('tasks.index');

Route::post('/tasks/{user_id}/{date}/store','TasksController@store')->name('tasks.store');

Route::get('/tasks/{user_id}/{task_id}/{date}/edit','TasksController@edit')->name('tasks.edit');

Route::post('/tasks/{user_id}/{task_id}/{date}/update','TasksController@update')->name('tasks.update');

Route::delete('/tasks/{user_id}/{task_id}/{date}/destroy','TasksController@destroy')->name('tasks.destroy');

Route::get('/groups','GroupsController@index')->name('groups.index');

Route::get('/groups/search','GroupsController@search')->name('groups.search');

Route::get('/groups/create','GroupsController@create')->name('groups.create');

Route::post('/groups/store','GroupsController@store')->name('groups.store');

Route::get('/groups/{group_id}','GroupsController@details')->name('groups.details');

Route::post('/groups/{group_id}','GroupsController@participate')->name('groups.participate');

Route::get('/profile/{user_id}/edit','ProfileController@edit')->name('profile.edit');

Route::post('/profile/{user_id}/update','ProfileController@update')->name('profile.update');

Route::get('/profile/{user_id}/editPassword','ProfileController@editPassword')->name('profile.editPassword');

Route::post('/profile/{user_id}/updatePassword','ProfileController@updatePassword')->name('profile.updatePassword');

Route::get('/profile/{user_id}/{dt?}/{change_month?}','ProfileController@show')->name('profile.show');

Route::get('/ranking','TasksController@showRanking')->name('ranking.show');

Route::get('/home', 'HomeController@index')->name('home');
