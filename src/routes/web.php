<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', [ContactController::class, 'index']);
Route::get('/contacts', [ContactController::class, 'index'])
    ->name('contact.index');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])
    ->name('contact.confirm');
Route::post('/contacts', [ContactController::class, 'store'])
    ->name('contact.store');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])
        ->name('admin.index');
    Route::post('/search', [AdminController::class, 'search'])
        ->name('admin.search');
    Route::delete('/{id}', [AdminController::class, 'destroy'])
        ->name('admin.destroy');
    Route::get('/reset', [AdminController::class, 'reset'])
        ->name('admin.reset');
});
Auth::routes();
