<?php

use App\Livewire\PeopleForms\EditPeopleForms;
use App\Livewire\PeopleForms\MainPeopleForms;
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

    Route::get('/formularios/panel/{id}', MainPeopleForms::class)
        ->name('panel-formularios');

    Route::get('/formularios/agregar-formulario', function () {
        return view('people-forms.add-people-forms');
    })->name('agregar-formulario');

    Route::get('/formularios/formulario/{id}', EditPeopleForms::class)
        ->name('editar-formulario');
});
