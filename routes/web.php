<?php

use App\Livewire\Incidents\MainIncidents;
use App\Livewire\PeopleForms\EditPeopleForms;
use App\Livewire\PeopleForms\MainPeopleForms;
use App\Livewire\Subordinates\MainSubordinates;
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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ! Hierarchies
    Route::group(['middleware' => ['role:Super Administrator']], function () {
        Route::get('/admin/panel-jerarquias', function () {
            return view('hierarchies.main-hierarchies');
        })->name('panel-jerarquias');

        Route::get('/admin/agregar-jerarquia', function () {
            return view('hierarchies.add-hierarchy');
        })->name('agregar-jerarquia');
    });
    // ! Forms
    Route::get('/formularios/panel/{id}', MainPeopleForms::class)
        ->name('panel-formularios');

    Route::get('/formularios/agregar-formulario', function () {
        return view('people-forms.add-people-forms');
    })->name('agregar-formulario');

    Route::get('/formularios/formulario/{id}', EditPeopleForms::class)
        ->name('editar-formulario');

    // ! Incidents
    Route::group(['middleware' => ['role:Super Administrator|Administrator|Supervisor|Capture Analyst']], function () {
        Route::get('/incidentes/panel/{id}', MainIncidents::class)
            ->name('panel-incidentes');
    });
    // ! Subordinates
    Route::group(['middleware' => ['role:Super Administrator|Administrator|Supervisor|Capture Analyst']], function () {
        Route::get('/subordinados/panel/{id}', MainSubordinates::class)
            ->name('panel-subordinados');
    });
});
