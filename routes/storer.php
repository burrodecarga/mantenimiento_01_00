<?php

use App\Http\Controllers\Store\ReplacementController;
use App\Http\Controllers\Store\ServiceController;
use App\Http\Controllers\Store\SupplyController;
use App\Http\Controllers\Store\ToolController;
use Illuminate\Support\Facades\Route;


Route::resource('/services',ServiceController::class)->names('services');
Route::resource('/supplies',SupplyController::class)->names('supplies');
Route::resource('/tools',ToolController::class)->names('tools');
Route::resource('/replacements',ReplacementController::class)->names('replacements');







