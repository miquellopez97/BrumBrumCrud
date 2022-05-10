<?php

use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Route;

Route::resource('user', ViewsController::class);

Route::post('/login', [ViewsController::class, 'login']);
Route::post('/', [ViewsController::class, 'login']);
