<?php

use App\Livewire\Users\EditUsers;
use Illuminate\Support\Facades\Route;
use App\Livewire\Reports\ChartPerHour;
use App\Livewire\Reports\ChartPerVotes;
use App\Livewire\Incidents\MainIncidents;
use App\Livewire\Reports\ChartPerSection;
use App\Livewire\PeopleForms\EditPeopleForms;
use App\Livewire\PeopleForms\MainPeopleForms;
use App\Livewire\Subordinates\MainSubordinates;

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

    // ! Super Administrator
    Route::group(['middleware' => ['role:Super Administrator']], function () {
        // ? Hierarchies
        Route::get('/admin/panel-jerarquias', function () {
            return view('hierarchies.main-hierarchies');
        })->name('panel-jerarquias');

        Route::get('/admin/agregar-jerarquia', function () {
            return view('hierarchies.add-hierarchy');
        })->name('agregar-jerarquia');

        // ? Users
        Route::get('/admin/panel-usuarios', function () {
            return view('users.main-users');
        })->name('panel-usuarios');

        Route::get('admin/usuarios/agregar-usuario', function () {
            return view('users.add-users');
        })->name('agregar-usuario');
    });
    // ! Forms
    Route::get('/registros/panel/{id}', MainPeopleForms::class)
        ->name('panel-registros');

    Route::get('/registros/agregar-registro', function () {
        return view('people-forms.add-people-forms');
    })->name('agregar-registro');

    Route::get('/registros/registro/{id}', EditPeopleForms::class)
        ->name('editar-registro');

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

    // ! Reports
    Route::group(['middleware' => ['role:Super Administrator|Administrator|Supervisor']], function () {
        Route::get('/reportes/reporte-por-hora', ChartPerHour::class)
            ->name('reporte-por-hora');

        Route::get('/reportes/reporte-por-votos', ChartPerVotes::class)
            ->name('reporte-por-votos');

        Route::get('/reportes/reporte-por-seccion', ChartPerSection::class)
            ->name('reporte-por-seccion');
    });
});
