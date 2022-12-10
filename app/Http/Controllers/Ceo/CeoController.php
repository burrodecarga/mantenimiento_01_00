<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Interfaces\DatosServiceInterface;

class CeoController extends Controller
{
    public function index(DatosServiceInterface $datosServiceInterface)
    {
    $resp = $datosServiceInterface->gastosDeMantenimiento();
    dd($resp);

return view('Ceo.index');

    }
}
