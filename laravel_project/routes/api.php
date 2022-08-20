<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'dbtransaction'], function () {
    Route::post('/signup', 'AuthController@register')->name('auth.register');
    Route::post('/login', 'AuthController@login')->name('auth.login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => 'dbtransaction'], function () {
        Route::apiResource("/post", "PostController")->only([
            'store', 'show', 'update', 'destory'
        ]);
        Route::apiResource('/comment', 'CommentController')->only([
            'store', 'update', 'destory'
        ]);
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/home/search', 'HomeController@search')->name("home.search");
        Route::get("/mypost", 'HomeController@mypost')->name("home.mypost");
        Route::get("/mycomment", 'HomeController@mycomment')->name("home.mycomment");

        Route::prefix("profile")->group(function () {
            Route::get("{user}/edit", "ProfileController@edit")->name("profile.edit");
            Route::put("{user}", "ProfileController@update")->name("profile.update");
        });
        Route::post('/logout', 'AuthController@logout')->name('api.logout');
    });
});
