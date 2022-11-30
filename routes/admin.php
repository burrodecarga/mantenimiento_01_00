<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::resource('/roles',RoleController::class)->names('roles');
Route::resource('/permissions',PermissionController::class)->names('permissions');
Route::resource('/users',UserController::class)->names('users');


