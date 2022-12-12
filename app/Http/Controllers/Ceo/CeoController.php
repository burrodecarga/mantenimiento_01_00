<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Interfaces\DatosServiceInterface;

class CeoController extends Controller
{
    public function index(DatosServiceInterface $datosServiceInterface)
    {
        $resp = $datosServiceInterface->gastosDeMantenimiento();
        foreach ($resp as $r) {
            $repuestos_mant[] = ['name' => 'repuestos mantenimiento', 'y' => $r->repuestos_mant];
            $insumos_mant[] = ['name' => 'insumos mantenimiento', 'y' => $r->insumos_mant];
            $servicios_mant[] = ['name' => 'servicios mantenimiento', 'y' => $r->servicios_mant];
            $personal_mant[] = ['name' => 'personal mantenimiento', 'y' => $r->personal_mant];
            $total_mant[] = ['name' => 'gasto mantenimiento', 'y' => $r->costos_mant];
        }

        $fallas = $datosServiceInterface->gastosDeFallas();

        foreach ($fallas as $r) {
            $repuestos_falla[] = ['name' => 'repuestos de fallas', 'y' => $r->repuestos_falla];
            $insumos_falla[] = ['name' => 'insumos de fallas', 'y' => $r->insumos_falla];
            $servicios_falla[] = ['name' => 'servicios de fallas', 'y' => $r->servicios_falla];
            $personal_falla[] = ['name' => 'personal de fallas', 'y' => $r->personal_falla];
            $total_falla[] = ['name' => 'gasto de fallas', 'y' => $r->costos_falla];
        }

        return view('Ceo.index', compact('repuestos_mant', 'insumos_mant', 'servicios_mant', 'personal_mant', 'total_mant',
            'repuestos_falla', 'insumos_falla', 'servicios_falla', 'personal_falla', 'total_falla'
        ));

    }

    public function teams(DatosServiceInterface $datosServiceInterface)
    {
        $users = $datosServiceInterface->personalPorFalla();

        return view('ceo.teams', compact('users'));
    }
}
