<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TongquanController;

Route::get('/', function () {
    return redirect()->route('admin.tongquan');
});

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [TongquanController::class, 'index'])->name('tongquan');
    });
