<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

// nuovo gruppo di rotte e middleware
Route::middleware(['auth', 'verified'])
    // influisce sul nome delle rotte
    ->name('admin.')
    // influisce sull'url delle rote (se uso il prefix nella route sottostante dovrò cancellare "admin" dopo lo / altrimenti darà errore)
    ->prefix('admin')
    ->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // creo altre rotte - crud

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
