<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Interfaces\CeoServiceInterface;
use App\Interfaces\DatosServiceInterface;
use App\Models\Equipment;
use App\Models\Zone;

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

    public function fails(CeoServiceInterface $ceoServiceInterface ){
        $fails =$ceoServiceInterface->fails();
        $fallas_mes[] = ['name' => 'fallas por mes', 'y' => 0];
        foreach($fails as $f) {
            $fallas_mes[] = ['name' => 'fallas', 'y' => $f->fails];
        }

        $repareid =$ceoServiceInterface->repareid();
        $fallas_mes_reparadas[] = ['name' => 'fallas reparadas', 'y' => 0];
        foreach($repareid as $f) {
            $fallas_mes_reparadas[] = ['name' => 'fallas', 'y' => $f->fails];
        }

        $actives = $ceoServiceInterface->actives();
        $fallas_mes_activas[] = ['name' => 'fallas activas', 'y' => 0];
        foreach($actives as $f) {
            $fallas_mes_activas[] = ['name' => 'fallas', 'y' => $f->fails];
        }

        return view('ceo.fails', compact('fallas_mes','fallas_mes_reparadas','fallas_mes_activas'));
    }

    public function equipments(CeoServiceInterface $ceoServiceInterface ){

        $byEquipments = $ceoServiceInterface->byEquipment();

        $data [] = [
            'x'=>0,
            'y'=>0,
            'name'=>'fallas por equipo',
        ];
        foreach($byEquipments as $f) {
            $equipment = Equipment::find($f->equipment_id);
            $data[] = [
                'x'=>$f->mes,
                'y'=>$f->quantity,
                'name' =>$equipment->name];
        }

        return view('ceo.equipments', compact('data'));
    }


    public function zones(CeoServiceInterface $ceoServiceInterface){
        $byZones = $ceoServiceInterface->byZone();
        $data [] = [
        'x'=>0,
        'y'=>0,
        'name'=>'fallas por zona',
       ];
        foreach($byZones as $f) {
            $zone = Zone::find($f->zone_id);
            $data[]=[
                'x'=>$f->mes,
                'y'=>$f->quantity,
                'name'=>$zone->name,
                'color'=>randomColor()
            ];

        }

        return view('ceo.zones', compact('data'));
    }


    public function types(CeoServiceInterface $ceoServiceInterface){
        $byTypes = $ceoServiceInterface->byType();
        foreach($byTypes as $f) {
            $data[]=[
                'x'=>$f->mes,
                'y'=>$f->quantity,
                'name'=>$f->type,
                'color'=>randomColor()
            ];
        }

        return view('ceo.types', compact('data'));
    }





}
