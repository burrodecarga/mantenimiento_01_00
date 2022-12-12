<?php namespace App\Services;

use App\Interfaces\DatosServiceInterface;
use App\Models\Fail;
use App\Models\Resume;
use App\Models\Timeline;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DatosService implements DatosServiceInterface
{
    public function prueba()
    {
        echo "Funciona correctamente";
    }

    public function timelinesCostByTask()
    {

        $timelines = Timeline::withSum('replacements', 'replacement_timeline.total')
            ->withSum('supplies', 'supply_timeline.total')
            ->withSum('services', 'service_timeline.total')->get();

        return $timelines;
    }

    public function gastosDeMantenimiento()
    {

        $gm = Timeline::select(DB::raw('MONTH(start) as mes'), DB::raw('SUM(total_replacement) as repuestos_mant'), DB::raw('SUM(total_supply) as insumos_mant'), DB::raw('SUM(total_service) as servicios_mant'), DB::raw('SUM(total_workers) as personal_mant'), DB::raw('SUM(total) as costos_mant'))
            ->groupBy('mes')->get();
        return $gm;
    }

    public function gastosDeFallas()
    {

        $gm = Resume::select(DB::raw('MONTH(reported_at) as mes'), DB::raw('SUM(total_replacement) as repuestos_falla'), DB::raw('SUM(total_supply) as insumos_falla'), DB::raw('SUM(total_service) as servicios_falla'), DB::raw('SUM(total_workers) as personal_falla'), DB::raw('SUM(total) as costos_falla'))
            ->groupBy('mes')->get();
        return $gm;
    }

    public function fallasPorMes()
    {
        $gm = Resume::select(DB::raw('MONTH(reported_at) as mes'), DB::raw('COUNT(id) as fallas'))
            ->groupBy('mes')->get();
        return $gm;
    }

    public function personalPorFalla()
    {
        $users = User::role('tecnico')->has('works')->get();
        foreach ($users as $u) {
            for ($mes = 1; $mes <= 12; $mes++) {
                $quantity = $u->works()->whereMonth('reported_at', $mes)->count();
                $salary = $u->works()->whereMonth('reported_at', $mes)->avg('salary');
                $subdata['id'] = $u->id;
                $subdata['name'] = $u->name;
                $subdata['mouth'] = $mes;
                $subdata['salary'] = $salary;
                $subdata['quantity'] = $quantity;
                $prev[] = $subdata;
            }
        }
        $datos= json_decode(json_encode($prev));
        return $datos;
    }

    public function assignWork($userId, $failId)
    {
        $user = User::find($userId);
        $fail = Fail::find($failId);
        Work::create([
            'user_id' => $user->id,
            'fail' => $fail->id,
            'salary' => $user->profile->salary,
            'reported_at' => Carbon::parse($fail->reported_at),
            'repareid_at' => Carbon::parse($fail->repareid_at),
            'assigned_at' => Carbon::parse($fail->assigned_at),
        ]);
    }

    public function gastosDePersonal()
    {}

}
