<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Biker\AuthController as BikerAuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\SensitiveAppController;
use App\Http\Controllers\SensitiveBookController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware(['secure'])->group(function () {
    Route::get('app_data', [AppController::class, 'getAppData']);
});

Route::get('songs', [SongController::class, 'getSongs']);
Route::get('artists', [SongController::class, 'getArtists']);
