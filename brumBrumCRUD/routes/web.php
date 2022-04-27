<?php

use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Route;

Route::resource('user', ViewsController::class);

Route::get('/', [ViewsController::class, 'index']);
