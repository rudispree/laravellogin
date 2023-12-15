<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ForgetController;




// Login Route
// Route::post('/login',[AuthController::class, 'Login']);



Route::post('/register', [AuthController::class, 'Register']);
Route::post('/forgetpassword', [ForgetController::class, 'ForgetPassword']);
Route::post('/resetpassword', [ResetController::class, 'ResetPassword']);
// Route::get('/user', [UserController::class, 'User'])->middleware('auth:api')->name('user.get');


Route::post('/login', [AuthController::class, 'Login'])->name('login');
Route::get('/user', [UserController::class, 'User'])->middleware('auth:api');
