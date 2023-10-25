<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('bots')->group(function () {
    Route::post('/{id}',[App\Http\Controllers\Bots\BotsTelegramController::class, 'index']);
});
Route::get('/info/{id}', [App\Http\Controllers\HomeController::class, 'messagefind'])->name('info');
Route::middleware(['auth'])->prefix('profile')->group(function () {
    
    Route::get('/', [App\Http\Controllers\Profile\ProfileController::class, 'index'])->name('profile.index');
});
Route::fallback(function (){
    abort(404);
});