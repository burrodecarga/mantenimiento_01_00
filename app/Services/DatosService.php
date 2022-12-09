<?php namespace App\Services;

use App\Interfaces\DatosServiceInterface;
use App\Models\Fail;
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
}
