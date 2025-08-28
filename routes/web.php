<?php

use App\Http\Controllers\AgriTipController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('agri-tips.index');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::resource('agri-tips', AgriTipController::class);
