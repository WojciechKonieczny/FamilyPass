<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
}) ->middleware('guest');

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('2fa');

Route::name('2fa.')->prefix('2fa')->middleware('auth')->group( function() {
    Route::get('/', [App\Http\Controllers\UserCodeController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\UserCodeController::class, 'store'])->name('post');
    Route::get('/reset', [App\Http\Controllers\UserCodeController::class, 'resend'])->name('resend');
});
