<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Interfaces\DatosServiceInterface;
use App\Models\Equipment;
use App\Models\Fail;
use App\Models\Resume;
use App\Models\Team;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class FailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fails = Fail::all();
        return view('mant.fails.index', compact('fails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fail = new Fail();
        $zones = Zone::orderBy('name', 'asc')->get();
        $title = "new failure";
        if (old('zone_id')) {
            $equipments = Equipment::where('location', old('zone_id'))->get();
        } else {
            $equipments = collect();
        }
        return view('mant.fails.create', compact('fail', 'zones', 'title', 'equipments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
            'type' => 'required',
        ]);
        $fail = Fail::create([
            'equipment_id' => $request->input('equipment_id'),
            'zone_id' => $request->input('zone_id'),
            'type' => $request->input('type'),
            'status' => 0,
            'user_id' => auth()->user()->id,
            'reported_at' => now(),
            'assigned_at' => now(),
            'repareid_at' => now(),
        ]);

        return redirect()->route('fails.index')->with('success', 'Falla reportada correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function show(Fail $fail)
    {
        if ($fail->status != 1) {
            return redirect()->route('fails.repareid')->with('success', 'Falla No reparada.');
        }

        $resume = Resume::where('fail', $fail->id)->first();
        if ($resume == null) {return redirect()->route('fails.repareid')->with('success', 'Falla reparada sin resumen.');}
        $w = str_split($resume->workers);
        $users = User::find($w);
        return view('mant.fails.show', compact('resume', 'fail', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function edit(Fail $fail)
    {
        $zones = Zone::orderBy('name', 'asc')->get();
        $title = "new failure";
        $equipment = $fail->equipment_id;
        $equipments = Equipment::where('location', $fail->zone_id)->get();
        return view('mant.fails.edit', compact('fail', 'zones', 'title', 'equipments', 'equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fail $fail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fail $fail)
    {
        //
    }

    public function add($id)
    {
        $fail = Fail::find($id);
        if ($fail->status == 1) {
            return redirect()->route('fails.index')->with('success', 'Falla reparada, no se le puede asignar grupo de tarea');
        }
        return view('mant.fails.add', compact('fail'));
    }

    public function tasks()
    {
        $team = auth()->user()->teams()->first();

        if (!$team) {
            $team = auth()->user()->team;
            if (!$team) {
                return redirect()->route('dashboard')->with('fail', 'Usuario no está asignado a ningún equipo de tareas');
            }
        }

        $fails = $team->fails()->where('status', 0)->get();
        return view('mant.fails.tasks', compact('fails'));
    }

    public function repareid()
    {

        $team = auth()->user()->teams()->first();

        if (!$team) {
            $team = auth()->user()->team;
            if (!$team) {
                return redirect()->route('dashboard')->with('fail', 'Usuario no está asignado a ningún equipo de tareas');
            }
        }

        $fails = $team->fails()->where('status', 1)->get();
        return view('mant.fails.repareid', compact('fails'));
    }

    public function repair(Fail $fail)
    {
        $user = auth()->user();
        $team = $user->teams()->first();
        return view('mant.fails.repair', compact('fail', 'team'));

    }

    public function despeje(Request $request, Fail $fail, DatosServiceInterface $datosServiceInterface)
    {
        $workers = $request->validate([
            'users' => 'required',
        ]);
        $fail->status = 1;
        $fail->repareid_at = now();
        $this->resume($fail, $workers, $datosServiceInterface);
        $fail->save();
        return redirect()->route('fails.tasks')->with('success', 'Falla reparada.');

    }

    public function resume(Fail $fail, $workers, $datosServiceInterface)
    {

        $failreplacementstotal = 0;

        foreach ($fail->replacements as $r) {
            $failreplacementstotal = $failreplacementstotal + $r->pivot->total;
        }

        $failsupliestotal = 0;
        foreach ($fail->supplies as $r) {
            $failsupliestotal = $failsupliestotal + $r->pivot->total;
        }

        $failservicestotal = 0;
        foreach ($fail->services as $r) {
            $failservicestotal = $failservicestotal + $r->pivot->total;
        }

        $totalworkers = 0;
        $str = '';

        foreach ($workers as $key => $w) {
            $str = implode(',', $w);
            $users = User::find($w);
            foreach ($users as $u) {
                $totalworkers = $totalworkers + $u->profile->salary;
                $datosServiceInterface->assignWork($u->id, $fail->id);
            }

        }

        $time = $fail->reported_at->diffInHours($fail->repareid_ad);
        $days = $fail->reported_at->diffInDays($fail->repareid_ad);

        Resume::create([
            'fail' => $fail->id,
            'equipment' => $fail->equipment_id,
            'type' => $fail->type,
            'total_replacement' => $failreplacementstotal,
            'total_supply' => $failsupliestotal,
            'total_service' => $failservicestotal,
            'total_workers' => $totalworkers,
            'workers' => $str,
            'total' => ($failreplacementstotal + $failsupliestotal + $failservicestotal + $totalworkers),
            'reported_at' => $fail->reported_at,
            'repareid_at' => $fail->repareid_at,
            'assigned_at' => $fail->assigned_at,
            'time' => $time,
            'days' => $days,

        ]);
    }

    public function zone_equipments($id)
    {
        return Equipment::where('location', $id)->get();

    }

}
