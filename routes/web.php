<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\site\LoginController;
use App\Http\Controllers\site\UserPlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('site.pages.home');
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/', 'middleware' => []], function () {
    Route::resource('register', UserPlayerController::class)->except(['index']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resources([
        'users' => UserAdminController::class,
        'roles' => RoleController::class,
    ]);
});
