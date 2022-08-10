<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);
Route::get("/signup", "SignupController@index");
Route::post("/signup", "SignupController@store");
Route::get("/pre_register", "RegisterController@index")->name("pre_register");
Route::post("/send_register", "RegisterController@register")->name("send_mail");

Route::middleware(['verified'])->group(function () {
    Route::get('/', "HomeController@index")->name('home');
    Route::resource('/post', 'PostController');
    Route::get('/home', "HomeController@index")->name('home');
    Route::get("/mypost", "HomeController@mypost")->name("home.mypost");
    Route::get("/mycomment", "HomeController@mycomment")->name("home.mycomment");
    Route::get("/comment/{comment}/edit", "CommentController@edit")->name("comment.edit");
    Route::patch("/comment/{comment}","CommentController@update")->name("comment.update");
    Route::delete("/comment/{comment}","CommentController@destroy")->name("comment.destroy");
    Route::post("/post/comment/store", "CommentController@store")->name("comment.store");
    Route::get("/profile/{user}/edit","ProfileController@edit")->name("profile.edit");
    Route::put("/profile/{user}","ProfileController@update")->name("profile.update");
    Route::middleware(["can:admin"])->group(function () {
        Route::get("/profile/index", "ProfileController@index")->name("profile.index");
    });
});


