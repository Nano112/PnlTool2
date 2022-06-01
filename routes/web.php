<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AxesImportController;
use App\Http\Controllers\ReposImportController;

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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return redirect('/repos');
    })->name('home');

    Route::get('/repos', function () {
        return view('repos');
    })->name('repos');

    Route::get('/axes', function () {
        return view('axes');
    })->name('axes');



    Route::post('/repos-import', [ReposImportController::class, 'import'])->name('repos-import');
    Route::post('/axes-import', [AxesImportController::class, 'import'])->name('axes-import');
});
