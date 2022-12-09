<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Interfaces\DatosServiceInterface;

class CeoController extends Controller
{
    public function index(DatosServiceInterface $datosServiceInterface)
    {
$timelines = $datosServiceInterface->timelineCostByTask();
dd(json_decode($timelines));
return view('ceo.index');

    }
}
