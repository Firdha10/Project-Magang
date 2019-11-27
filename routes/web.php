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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([ 'middleware' => ['auth'] ], function() {
    Route::resource('tema', 'TemaController')->except(['show', 'store', 'update']);
    Route::post('tema/ajax/store', 'TemaController@store')->name('tema.store');
    Route::put('tema/{id}/update', 'TemaController@update')->name('tema.update');
    Route::get('post/index', 'PostController@index')->name('post.index');
    Route::put('post/{id}/update', 'PostController@update')->name('post.update');
    Route::post('post/ajax/store', 'PostController@store')->name('post.store');
    Route::resource('post', 'PostController')->except(['show','store','update']);
    Route::get('post/{id}', 'PostController@getBlogById');
});

