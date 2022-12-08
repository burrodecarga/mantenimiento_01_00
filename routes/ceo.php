<?php

use Illuminate\Support\Facades\Route;

Route::get('/statistics/index', [CepController::class, 'index'])->name('statistics.index');
