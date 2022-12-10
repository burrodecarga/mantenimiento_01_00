<?php namespace App\Services;

use App\Interfaces\DatosServiceInterface;
use App\Models\Fail;
use App\Models\Resume;
use App\Models\Timeline;
use Illuminate\Support\Facades\DB;

class DatosService implements DatosServiceInterface
{
    public function prueba()
    {
        echo "Funciona correctamente";
    }

    public function timelinesCostByTask(){

    $timelines = Timeline::withSum('replacements','replacement_timeline.total')
                         ->withSum('supplies','supply_timeline.total')
                         ->withSum('services','service_timeline.total')->get();

        return $timelines;
    }


    public function gastosDeMantenimiento(){

        $gm=Timeline::select(DB::raw('WEEK(start) as mes'),DB::raw('SUM(total_replacement) as repuestos_mant'), DB::raw('SUM(total_supply) as insumos_mant'),DB::raw('SUM(total_service) as servicios_mant'),DB::raw('SUM(total_workers) as personal_mant'),DB::raw('SUM(total) as costos_mant'))
        ->groupBy('mes')->get();
        return $gm;
    }

    public function gastosDeFallas(){

        $gm=Resume::select(DB::raw('WEEK(reported_at) as mes'),DB::raw('SUM(total_replacement) as repuestos_mant'), DB::raw('SUM(total_supply) as insumos_mant'),DB::raw('SUM(total_service) as servicios_mant'),DB::raw('SUM(total_workers) as personal_mant'),DB::raw('SUM(total) as costos_mant'))
        ->groupBy('mes')->get();
        return $gm;
    }



}
