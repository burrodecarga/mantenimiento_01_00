<?php

use App\Http\Controllers\Mant\FailController;
use App\Http\Controllers\Mant\GoalController;
use App\Http\Controllers\Mant\PlanController;
use App\Http\Controllers\Mant\TeamController;
use Illuminate\Support\Facades\Route;


Route::resource('/teams',TeamController::class)->names('teams');
Route::get('/teams/add/{id}',[TeamController::class,'add'])->name('teams.members-add');
Route::resource('/fails',FailController::class)->names('fails');
Route::get('/fails/add/{id}',[FailController::class,'add'])->name('fails.teams-add');
Route::get('/fail/tasks',[FailController::class,'tasks'])->name('fails.tasks');
Route::get('/fail/repair/{fail}',[FailController::class,'repair'])->name('fails.repair');
Route::post('/fail/despeje/{fail}',[FailController::class,'despeje'])->name('fails.despeje');
Route::get('/fail/repareid',[FailController::class,'repareid'])->name('fails.repareid');
Route::resource('/plans',PlanController::class)->names('plans');
Route::get('/plans/calendar/{plan}',[PlanController::class,'calendar'])->name('plans.calendar');
Route::get('/plans/sequence/{plan}', [PlanController::class, 'sequence'])->name('plans.sequence');

Route::get('/plans/timeline/{plan}',[PlanController::class,'timeline'])->name('plans.timeline');

Route::get('/plans/protocols/{plan}',[PlanController::class,'protocols'])->name('plans.protocols');
Route::get('/plans/resources/{plan}',[PlanController::class,'resources'])->name('plans.resources');
Route::get('/goals/replacements/{goal}',[GoalController::class,'replacements'])->name('goals.replacements');
Route::get('/goals/positions/{goal}',[GoalController::class,'positions'])->name('goals.positions');
Route::get('/goals/edit/{goal}',[GoalController::class,'edit'])->name('goals.edit');
Route::put('/goals/update/{goal}',[GoalController::class,'update'])->name('goals.update');
Route::get('/plans/teams/{plan}',[PlanController::class,'teams'])->name('plans.teams');
Route::get('/goals/teams/{goal}/{equipment}',[GoalController::class,'teams'])->name('goals.teams');
Route::get('/goals/assign',[GoalController::class,'assign'])->name('goals.assign');


