<?php

use App\Http\Controllers\Ceo\CeoController;

use Illuminate\Support\Facades\Route;

Route::get('/statistics/index', [CeoController::class, 'index'])->name('statistics.index');
Route::get('/statistics/teams', [CeoController::class, 'teams'])->name('statistics.teams');
Route::get('/statistics/salary', [CeoController::class, 'salary'])->name('statistics.salary');
Route::get('/statistics/equipments', [CeoController::class, 'equipments'])->name('statistics.equipments');


