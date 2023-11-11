<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Biker\AuthController as BikerAuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\SensitiveAppController;
use App\Http\Controllers\SensitiveBookController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware(['secure'])->group(function () {
    Route::get('app_data', [AppController::class, 'getAppData']);
    Route::get('book/{id}', [BooksController::class, 'getBookDetail']);

    Route::get('books', [BooksController::class, 'getBooks']);
    Route::get('recommend', [BooksController::class, 'getRecommend']);
    Route::get('search', [BooksController::class, 'searchBook']);
    Route::get('sliders', [AppController::class, 'getSliders']);

    Route::group(['prefix' => 'sensitive'], function () {
        Route::get('books', [SensitiveBookController::class, 'getBooks']);
        Route::get('recommend', [SensitiveBookController::class, 'getRecommend']);
        Route::get('search', [SensitiveBookController::class, 'searchBook']);
        Route::get('sliders', [SensitiveAppController::class, 'getSliders']);
    });
});
