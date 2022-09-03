<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ReportController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', [GameController::class, 'index'])->middleware(['auth'])->name('home');
Route::get('/mst/game', [GameController::class, 'mstIndex'])->middleware(['auth'])->name('mst/game');
Route::post('/mst/game/save', [GameController::class, 'save'])->middleware(['auth']);
Route::post('/mst/game/delete', [GameController::class, 'delete'])->middleware(['auth']);
Route::get('/account', [ReportController::class, 'index'])->middleware(['auth'])->name('account');
Route::post('/report/save', [ReportController::class, 'save'])->middleware(['auth']);

require __DIR__.'/auth.php';
