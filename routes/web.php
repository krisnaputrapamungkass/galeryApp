<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda.index');


Route::middleware(['auth'])->group(function () {
    Route::get('users/logout', [UserController::class, 'logout'])->name('users.logout');
   Route::resource('foto', FotoController::class);
   Route::resource('album', AlbumController::class);
   Route::post('like', [FotoController::class, 'like'])->name('like');
   Route::post('unlike', [FotoController::class, 'unlike'])->name('unlike');
});

Route::resource('users', UserController::class);
Route::POST('users/login',[UserController::class,'login'])->name('users.login');
Route::resource('beranda', BerandaController::class);
