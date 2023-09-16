<?php

Route::prefix('install')->as('install::')->middleware('web')->group(function () {
    Route::get('/', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'index'])->name('index');
    Route::match(['get', 'post'], '/licence', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'licence'])->name('licence');
    Route::get('/permissions', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'permissions'])->name('permissions');
    Route::get('/requirements', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'requirements'])->name('requirements');
    Route::match(['get', 'post'], '/environment', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'environment'])->name('environment');
    Route::match(['get', 'post'], '/environment', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'environment'])->name('environment');
    Route::get('/database', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'database'])->name('database');
    Route::match(['get', 'post'], '/admin', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'admin'])->name('admin');
    Route::get('/final', [\Ajamaa\LaravelInstaller\Controllers\HomeController::class, 'final'])->name('final');
});
