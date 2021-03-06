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
Route::redirect('/home','/');

// Contact form routes
Route::get('/contact', 'ContactController@getContact');
Route::post('/contact','ContactController@postContact');

// Blog pages
Route::get('/post/{slug}','BlogController@getPost')
  ->name('post.single')
  ->where('slug','[\w\d\_\-]+');
Route::get('/category/{slug}','BlogController@getCategory')
    ->name('category.single')
    ->where('slug','[\w\d\_\-]+');
Route::get('/tag/{slug}','BlogController@getTag')
    ->name('tag.single')
    ->where('tag','[\w\d\_\-]+');


// Routes to the admin panels
// use middleware auth to prevern unauthorized access

Route::group(['middleware' => 'auth'], function() {
  Route::resource('/posts','PostController')
    ->middleware(['role:Author','post-owner']);

  Route::resource('/categories','CategoryController')->middleware('role:Author');
  Route::resource('/tags','TagController')->middleware('role:Author');
  Route::resource('/messages','MessageController')->middleware('role:Administrator');
  Route::resource('/answers','AnswerController')->middleware('role:Administrator');
  Route::resource('/users','UserController')->middleware('role:Administrator');
  Route::resource('/comments','CommentController');
});

Auth::routes();
