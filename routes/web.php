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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/panel-jerarquias', function () {
        return view('hierarchies.main-hierarchies');
    })->name('panel-jerarquias');

    Route::get('/admin/agregar-jerarquia', function () {
        return view('hierarchies.add-hierarchy');
    })->name('agregar-jerarquia');
});
