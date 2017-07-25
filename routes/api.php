<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1/webapp', 'middleware' => ['api']], function () {
    Route::resource('posts', 'WebApp\PostController',['only' => ['index']]);
});

Route::group(['prefix' => 'v1/auth', 'middleware' => ['api']], function () {
    Route::resource('register', 'Auth\RegisterController',['only' => ['store']]);
    Route::resource('login', 'Auth\LoginController',['only' => ['index']]);
});

Route::group(['prefix' => 'v1/webapp/auth', 'middleware' => ['api', 'jwt']], function () {
    Route::resource('guestbook', 'WebApp\GuestbookController',['only' => ['index']]);
});
