<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\CanalController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\JuezController;
use App\Http\Controllers\DirectorioController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\MultaController;
use App\Http\Controllers\MultaReporteController;
use App\Http\Controllers\AporteController;
use App\Http\Controllers\ReporteSocioController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// 🔓 Rutas de reportes de socios - públicas para prueba
Route::prefix('socios/reportes')->name('socios.reportes.')->group(function () {
    Route::get('/', [ReporteSocioController::class, 'index'])->name('index');
    Route::get('/excel', [ReporteSocioController::class, 'exportExcel'])->name('excel');
    Route::get('/pdf', [ReporteSocioController::class, 'exportPDF'])->name('pdf');
});

// 🔐 Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('comunidades', ComunidadController::class)->parameters([
        'comunidades' => 'comunidad',
    ]);

    Route::resource('canales', CanalController::class)->parameters([
        'canales' => 'canal',
    ]);

    Route::resource('socios', SocioController::class)->parameters([
        'socios' => 'socio',
    ]);

    Route::get('socios/{socio}/detalle', [SocioController::class, 'detalle'])->name('socios.detalle');

    Route::resource('jueces', JuezController::class)->parameters([
        'jueces' => 'juez'
    ]);

    Route::resource('directorio', DirectorioController::class)->parameters([
        'directorio' => 'directorio'
    ]);

    Route::resource('reuniones', ReunionController::class)->parameters([
        'reuniones' => 'reunion'
    ]);

    Route::resource('multas', MultaController::class)->only([
        'index',
        'edit',
        'update'
    ]);
    Route::get('multas/{multa}/comprobante', [MultaController::class, 'comprobante'])->name('multas.comprobante');
    Route::get('multas/{multa}/comprobante/pdf', [MultaController::class, 'comprobantePdf'])->name('multas.comprobante.pdf');


    Route::get('multas/reportes', [MultaReporteController::class, 'index'])->name('multas.reportes.index');
    Route::get('multas/reportes/excel', [MultaReporteController::class, 'exportExcel'])->name('multas.reportes.excel');
    Route::get('multas/reportes/pdf', [MultaReporteController::class, 'exportPdf'])->name('multas.reportes.pdf');

    Route::resource('aportes', AporteController::class)->only([
        'index',
        'create',
        'store',
        'edit',
        'update'
    ]);
});
