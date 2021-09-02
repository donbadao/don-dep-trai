<?php

use App\Http\Middleware\checkLogin;
use App\Http\Middleware\Filter;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => [checkLogin::class]], function () {

    Route::get('/admin/', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/admin/post/', [App\Http\Controllers\Admin\PostController::class, 'index']);
    Route::get('/admin/post/create', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('/admin/post/create', [App\Http\Controllers\Admin\PostController::class, 'save']);
    Route::get('/admin/post/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::post('/admin/post/delete/', [App\Http\Controllers\Admin\PostController::class, 'delete']);
    Route::post('/admin/post/updatestatus/', [App\Http\Controllers\Admin\PostController::class, 'updateStatus']);
    
    Route::get('/admin/media', [App\Http\Controllers\Admin\MediaController::class, 'index']);
    Route::post('/admin/media/uploads', [App\Http\Controllers\Admin\MediaController::class, 'uploads']);
});


Route::get('/admin/login/', [App\Http\Controllers\Admin\LoginController::class, 'index']);
Route::post('/admin/login/', [App\Http\Controllers\Admin\LoginController::class, 'checkLogin']);
Route::post('/admin/logout/', [App\Http\Controllers\Admin\LoginController::class, 'logOut']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => [Filter::class]], function() {
    Route::get('/post/{url}', [App\Http\Controllers\PostController::class, 'detail'])->name('home_post');
});
