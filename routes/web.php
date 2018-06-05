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

Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Threads routes
 */
Route::get('threads', 'Threadcontroller@index')->name('threads.index');

route::get('threads/create', 'Threadcontroller@create')->name('threads.create');

route::post('threads', 'Threadcontroller@store')->name('threads.channel.store');

route::get('threads/{channel}', 'ChannelController@index')->name('threads.channel.index');

route::get('threads/{channel}/{thread}', 'threadcontroller@show')->name('threads.channel.show');

route::delete('threads/{channel}/{thread}', 'ThreadController@destroy')->name('threads.channel.destroy');

Route::post('threads/{channel}/{thread}/replies', 'ReplyController@store')->name('threads.channel.reply.store');

Route::resource('replies.favorites', 'FavoriteController');
