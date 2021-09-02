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

Route::get('/post/fetch',[App\Http\Controllers\Api\PostController::class,'fetch']);
Route::get('/post/fetchall',[App\Http\Controllers\Api\PostController::class,'fetchAll']);

Route::get('/media/fetch',[App\Http\Controllers\Api\MediaController::class,'fetch']);