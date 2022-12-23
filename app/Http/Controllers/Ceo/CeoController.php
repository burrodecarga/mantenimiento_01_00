<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Interfaces\CeoServiceInterface;
use App\Interfaces\DatosServiceInterface;

class CeoController extends Controller
{
    public function index(DatosServiceInterface $datosServiceInterface)
    {
        $resp = $datosServiceInterface->gastosDeMantenimiento();

            $repuestos_mant[] = ['name' => 'repuestos mantenimiento', 'y' => 0];
            $insumos_mant[] = ['name' => 'insumos mantenimiento', 'y' => 0];
            $servicios_mant[] = ['name' => 'servicios mantenimiento', 'y' => 0];
            $personal_mant[] = ['name' => 'personal mantenimiento', 'y' => 0];
            $total_mant[] = ['name' => 'gasto mantenimiento', 'y' => 0];


        foreach ($resp as $r) {
            $repuestos_mant[] = ['name' => 'repuestos mantenimiento', 'y' => $r->repuestos_mant];
            $insumos_mant[] = ['name' => 'insumos mantenimiento', 'y' => $r->insumos_mant];
            $servicios_mant[] = ['name' => 'servicios mantenimiento', 'y' => $r->servicios_mant];
            $personal_mant[] = ['name' => 'personal mantenimiento', 'y' => $r->personal_mant];
            $total_mant[] = ['name' => 'gasto mantenimiento', 'y' => $r->costos_mant];
        }

        $fallas = $datosServiceInterface->gastosDeFallas();

            $repuestos_falla[] = ['name' => 'repuestos de fallas', 'y' => 0];
            $insumos_falla[] = ['name' => 'insumos de fallas', 'y' => 0];
            $servicios_falla[] = ['name' => 'servicios de fallas', 'y' =>0];
            $personal_falla[] = ['name' => 'personal de fallas', 'y' => 0];
            $total_falla[] = ['name' => 'gasto de fallas', 'y' => 0];

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

    public function salary(DatosServiceInterface $datosServiceInterface)
    {
        $fallas = $datosServiceInterface->fallasPorMes();

        $fallas_mes[] = ['name' => 'fallas por mes', 'y' => 0];

        foreach ($fallas as $f) {
            $fallas_mes[] = ['name' => 'fallas por mes', 'y' => $f->fallas];}

        $gastos = $datosServiceInterface->gastosDePersonal();



        $gastos_personal[] = ['name' => 'gastos de personal', 'y' => 0];

        foreach ($gastos as $g) {
            $gastos_personal[] = ['name' => 'gastos de personal', 'y' => $g->salary];}

        return view('ceo.salary', compact('gastos_personal','fallas_mes'));
    }

    public function equipments(CeoServiceInterface $ceoServiceInterface ){
        $d =$ceoServiceInterface->prueba();
    }


}
