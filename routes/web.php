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


// Page routes
Route::get('/', 'PageController@getHome')->name('home');
Route::get('/about', 'PageController@getAbout');
Route::get('/contact', 'PageController@getContact');
Route::get('/post/{id}','PageController@getPost')->name('post.view');
Route::redirect('/home','/');

// Post routes to the resource controller
Route::resource('/posts','PostController');
