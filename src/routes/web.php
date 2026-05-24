<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\ThanksController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InputController::class, 'index']);
Route::post('/confirm', [ConfirmController::class, 'index']);
Route::get('/thanks', [ThanksController::class, 'index']);
