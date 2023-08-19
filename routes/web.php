<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');

    return "Cache cleared successfully";
});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
