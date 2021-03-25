<?php

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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('/app')->group(function () {
    Route::resource('/post', 'PostController');
    Route::get('/dashboard', 'DashboardController@index');
});
Route::get('/logoutuser', 'UserController@logout');
Route::get('/post/{post:slug}', 'WelcomeController@singlePost')->name('post.show');
Route::post('/like/store', 'LikeController@store')->name('like.add');
Route::post('/like/delete', 'LikeController@delete')->name('like.delete');
Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');

Route::get('/{any}', function () {
    return view('home');
})->where('any', '.*');
