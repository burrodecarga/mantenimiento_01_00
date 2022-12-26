<?php

use App\Http\Controllers\Ceo\CeoController;

use Illuminate\Support\Facades\Route;

Route::get('/statistics/index', [CeoController::class, 'index'])->name('statistics.index');
Route::get('/statistics/teams', [CeoController::class, 'teams'])->name('statistics.teams');
Route::get('/statistics/salary', [CeoController::class, 'salary'])->name('statistics.salary');
Route::get('/statistics/equipments', [CeoController::class, 'equipments'])->name('statistics.equipments');
Route::get('/statistics/fails', [CeoController::class, 'fails'])->name('statistics.fails');
Route::get('/statistics/types', [CeoController::class, 'types'])->name('statistics.types');
Route::get('/statistics/zones', [CeoController::class, 'zones'])->name('statistics.zones');



