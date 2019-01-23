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
Route::get('/post/{slug}','PageController@getPost')
  ->name('post.single')
  ->where('slug','[\w\d\_\-]+');
Route::redirect('/home','/');

// Post routes to the resource controller
// use middleware auth to prevern unauthorized access
Route::resource('/posts','PostController')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
