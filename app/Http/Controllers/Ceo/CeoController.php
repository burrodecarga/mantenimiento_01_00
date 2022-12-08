<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Interfaces\DatosServiceInterface;

class CeoController extends Controller
{
    public function index(DatosServiceInterface $datosServiceInterface)
    {
      $datosServiceInterface->prueba();
    }
}
