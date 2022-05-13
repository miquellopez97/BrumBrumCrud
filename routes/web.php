<?php

use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

Route::resource('user', ViewsController::class)->middleware('isLogged');

Route::get('login',[UserAuthController::class, 'login'])->middleware('AlreadyLoggedIn');
Route::post('check',[UserAuthController::class, 'check'])->name('auth.check');
Route::get('profile',[UserAuthController::class, 'profile'])->middleware('isLogged');
Route::get('logout',[UserAuthController::class, 'logout']);
