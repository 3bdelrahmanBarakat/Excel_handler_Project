<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return to_route('login');
});

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class,'index'])->name('dashboard');
        Route::post('/import', [AdminController::class, 'import'])->name('import');
        Route::post('/save', [AdminController::class, 'save'])->name('save');
        Route::post('/export', [AdminController::class, 'export'])->name('export');
    });

require __DIR__.'/auth.php';
