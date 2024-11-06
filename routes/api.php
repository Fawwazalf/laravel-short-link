<?php

use App\Http\Controllers\Api\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

Route::get('/links', [LinkController::class, 'index']);

Route::get('/links/{id}', [LinkController::class, 'show']);

Route::post('/links', [LinkController::class, 'store']);

Route::put('/links/{id}', [LinkController::class, 'update']);

Route::delete('/links/{id}', [LinkController::class, 'destroy']);
