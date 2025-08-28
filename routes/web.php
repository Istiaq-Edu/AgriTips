<?php

use App\Http\Controllers\AgriTipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('agri-tips', AgriTipController::class);
