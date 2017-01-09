<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::resource('comments','CommentsController');

Route::get('post/{id}/islikedbyme', 'PostController@isLikedByMe');
Route::post('post/like', 'PostController@like');

?>