<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Biker\AuthController as BikerAuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('app_data', [AppController::class, 'getAppData']);
Route::get('books', [BooksController::class, 'getBooks']);
Route::get('search', [BooksController::class, 'searchBook']);

Route::get('book/{id}', [BooksController::class, 'getBookDetail']);
Route::get('sliders', [AppController::class, 'getSliders']);
