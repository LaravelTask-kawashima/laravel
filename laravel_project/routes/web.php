<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Auth;
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

// Auth::routes(['verify' => true]);
// // Route::get("/signup", "SignupController@index");
// // Route::post("/signup", "SignupController@store");
// Route::get("/pre_register", "RegisterController@index")->name("pre_register");
// Route::post("/send_register", "RegisterController@register")->name("send_mail");

// Route::middleware(['verified'])->group(function () {
//     Route::get('/', "HomeController@index")->name('home');
//     Route::get('/home/search', 'HomeController@search')->name("home.search");
//     Route::get('/home', 'HomeController@index')->name('home');
//     Route::get("/mypost", 'HomeController@mypost')->name("home.mypost");
//     Route::get("/mycomment", 'HomeController@mycomment')->name("home.mycomment");
    
//     Route::group(['middleware'=> 'dbtransaction'],function(){
//         Route::resource('/post', 'PostController');
//         Route::post("/post/comment/store", "CommentController@store")->name("comment.store");
//     });

//     Route::prefix("comment")->group(function () {
//         Route::get("{comment}/edit", "CommentController@edit")->name("comment.edit");
//         Route::group(['middleware'=>'dbtransaction'],function(){
//             Route::patch("{comment}", "CommentController@update")->name("comment.update");
//             Route::delete("{comment}", "CommentController@destroy")->name("comment.destroy");
//         });
//     });
    
//     Route::prefix("profile")->group(function () {
//         Route::group(['middleware' => 'dbtransaction'], function(){
//             Route::get("{user}/edit", "ProfileController@edit")->name("profile.edit");
//             Route::put("{user}", "ProfileController@update")->name("profile.update");
//         });
//         Route::middleware(["can:admin"])->group(function () {
//             Route::get("index", "ProfileController@index")->name("profile.index");
//         });
//     });
// });
