<?php

use App\Http\Controllers\Ceo\CeoController;

use Illuminate\Support\Facades\Route;

Route::get('/statistics/index', [CeoController::class, 'index'])->name('statistics.index');

