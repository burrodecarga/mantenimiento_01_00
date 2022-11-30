<?php

use App\Http\Controllers\Rrhh\EmployeController;
use Illuminate\Support\Facades\Route;


Route::resource('/employes',EmployeController::class)->names('employes');
