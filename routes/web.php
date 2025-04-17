<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');

Route::get('/', [LoginController::class, 'home']);
Route::get('/login_admin', [LoginController::class, 'showAdminLogin']);
Route::post('/login_admin', [LoginController::class, 'loginAdmin']);
});
