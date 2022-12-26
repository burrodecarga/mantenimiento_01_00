<?php namespace App\Services;

use App\Interfaces\CeoServiceInterface;
use App\Models\Fail;
use Illuminate\Support\Facades\DB;

class CeoService implements CeoServiceInterface
{
    public function prueba()
    {
        echo "Funciona correctamente";
    }

    public function fails(){
        $fails = DB::table('fails')
        ->select(DB::raw('MONTH(reported_at) as mes, COUNT(*) as fails '))
        ->groupBy('mes')
        ->get();
        return $fails;
    }

    public function actives(){
        $fails = DB::table('fails')
        ->select(DB::raw('MONTH(reported_at) as mes, COUNT(*) as fails '))
        ->groupBy(['mes'])
        ->where('status', 0)
        ->get();
        return $fails;
    }

    public function repareid(){
        $fails = DB::table('fails')
        ->select(DB::raw('MONTH(reported_at) as mes, COUNT(*) as fails '))
        ->groupBy(['mes'])
        ->where('status', 1)
        ->get();
        return $fails;
    }

    public function byZone(){
        $fails = DB::table('fails')
        ->select(DB::raw('MONTH(reported_at) as mes,zone_id, count(zone_id) as quantity'))
        ->groupBy(['mes'])
        ->groupBy(['zone_id'])
        ->having('quantity','>',2)->get();
        return $fails;
    }


    public function byEquipment(){
        $fails = DB::table('fails')
        ->select(DB::raw('MONTH(reported_at) as mes,equipment_id, count(equipment_id) as quantity'))
        ->groupBy('mes','equipment_id')
        ->having('quantity','>',2)
        ->get();
        return $fails;
    }

    public function byType(){
        $fails = DB::table('fails')
        ->select(DB::raw('MONTH(reported_at) as mes,type, count(type) as quantity'))
        ->groupBy('mes','type')
        ->having('quantity','>',2)
        ->get();
        return $fails;
    }




   }
