<?php

use App\Http\Controllers\PasswordController;
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

Route::get('/home', [App\Http\Controllers\PasswordController::class, 'index'])->name('home')->middleware('2fa');

Route::name('2fa.')->prefix('2fa')->middleware('auth')->group( function() {
    Route::get('/', [App\Http\Controllers\UserCodeController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\UserCodeController::class, 'store'])->name('post');
    Route::get('/reset', [App\Http\Controllers\UserCodeController::class, 'resend'])->name('resend');
});

Route::name('passwords.')->prefix('passwords')->middleware('auth')->group(function() {
    Route::get('', [PasswordController::class, 'index'])->name('index');

    // odpowiedzialny za wyswietlanie formularza dodawania
    Route::get('create', [PasswordController::class, 'create'])->name('create');

    // odpowiedzialny za dodawanie nowych wierszy do bazy
    Route::post('', [PasswordController::class, 'store'])->name('store');

    // odpowiedzialny za wyswietlanie formularza od edycji
    Route::get('{password}/edit', [PasswordController::class, 'edit'])->where('password', '[0-9]+')->name('edit');

    // odpowiedzialny za przesylanie zedytowanego formularza do bazy
    Route::patch('{password}/edit', [PasswordController::class, 'update'])->where('password', '[0-9]+')->name('update');

    //usuwanie
    Route::delete('{password}', [PasswordController::class, 'destroy'])->where('password', '[0-9]+')->name('destroy');

    // przywracanie
    Route::put('{id}/restore', [PasswordController::class, 'restore'])->where('id', '[0-9]+')->name('restore');

});
