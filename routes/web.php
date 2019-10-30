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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','BlogController@index');
Auth::routes();
Route::prefix('admin')->group(function(){
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('create');
Route::post('/create','HomeController@store');
Route::get('/update/{id}','HomeController@edit');
Route::patch('/update/{id}','HomeController@update');
});
////
Route::get('/home/{id?}','BlogController@index');
Route::get('/{slug}','BlogController@show');
//comments
Route::post('/comment/store','CommentController@store')->name('comment.add');
Route::post('/reply/store','CommentController@replyStore')->name('reply.add');

