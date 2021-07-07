<?php

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

use App\Http\Controllers\EmailController;



Route::post('/', [EmailController::class, 'store']);

Route::get('verify', [EmailController::class, 'show'])->name('verifyEmail');

Route::delete('remove', [EmailController::class, 'destroy'])->name('deleteEmail');
