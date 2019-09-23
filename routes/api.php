<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/posts', 'PostController@index');
Route::get('/posts/{post}', 'PostController@show');

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('posts', 'PostController', ['only' => ['store', 'update', 'destroy']]);

    Route::get('/me', 'ApiController@me');
    Route::get('/admin', 'ApiController@admin')->middleware('can:admin');
    Route::get('/manager', 'ApiController@manager')->middleware('can:manager');;
});
