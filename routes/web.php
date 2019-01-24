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
Route::get('/category/{slug}','PageController@getCategory')
    ->name('category.single')
    ->where('slug','[\w\d\_\-]+');
Route::redirect('/home','/');

// Routes to the admin panels
// use middleware auth to prevern unauthorized access

Route::group(['middleware' => 'auth'], function() {
  Route::resource('/posts','PostController');
  Route::resource('/categories','CategoryController');
  Route::resource('/tags','TagController');
});

Auth::routes();
