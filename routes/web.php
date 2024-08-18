<?php

use App\Http\Controllers\RpbController;
use App\Models\Rpb;
use Illuminate\Support\Facades\Route;

Route::get('/', [RpbController::class, 'index'])->name('rpb.index');
Route::post('/store', [RpbController::class, 'store'])->name('rpb.store');
