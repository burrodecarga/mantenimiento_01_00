<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Interfaces\DatosServiceInterface;

class CeoController extends Controller
{
    public function index(DatosServiceInterface $datosServiceInterface)
    {
$resp = $datosServiceInterface->gastosDeFallas();

foreach ($resp as $r){
   $repuestos[]=['name'=>'repuestos','y'=>floatval($r->repuestos)];
   $insumos[]=['name'=>'insumos','y'=>floatval($r->insumos)];
   $servicios[]=['name'=>'servicios','y'=>floatval($r->servicios)];
}
return view('ceo.index',compact('repuestos','insumos','servicios'));

    }
}
