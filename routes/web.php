<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/posts', 'PostsController@index');
Route::get('/posts/{post}', 'PostsController@show');
Route::post('/posts', 'PostsController@store');
Route::get('/personal', 'PostsController@personal');

Route::post('/posts/{post}', 'CommentsController@store');

Route::post('/posts/{post}/like', 'PostLikesController@store');
Route::delete('/posts/{post}/like', 'PostLikesController@destroy');
