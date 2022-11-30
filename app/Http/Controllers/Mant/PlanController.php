<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\Team;
use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::All();
        $equipment = Equipment::find(1);
        return view('mant.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = new Plan();
        $plan->weekly_shift = 44;
        $plan->daily_shift = 8;

        $btn = "crear plan";
        $title = "Crear nuevo plan de mantenimiento";
        return view('mant.plans.create', compact('plan', 'title', 'btn'));
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
            'name' => 'required',
            'start' => 'required',
            'start_time' => 'required',
            'work_shift' => 'required',
            'weekly_shift' => 'required',
            'daily_shift' => 'required',
            'rest_time' => 'required',
            'rest_hours' => 'required',
        ]);

        if ($request->work_holiday == 'on') {
            $request->request->add(['work_holiday' => 1]);
        } else {
            $request->request->add(['work_holiday' => 0]);
        }

        if ($request->work_overtime == 'on') {
            $request->request->add(['work_overtime' => 1]);
        } else {
            $request->request->add(['work_overtime' => 0]);
        }
        Plan::create($request->all());
        return redirect()->route('plans.index')->with('success', 'Plan de mantenimiento creado correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('mant.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $btn = "crear plan";
        $title = "Crear nuevo plan de mantenimiento";
        return view('mant.plans.edit', compact('plan', 'title', 'btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required',
            'start' => 'required',
            'start_time' => 'required',
            'work_shift' => 'required',
            'weekly_shift' => 'required',
            'daily_shift' => 'required',
            'rest_time' => 'required',
            'rest_hours' => 'required',
        ]);

        if ($request->work_holiday == 'on') {
            $request->request->add(['work_holiday' => 1]);
        } else {
            $request->request->add(['work_holiday' => 0]);
        }

        if ($request->work_overtime == 'on') {
            $request->request->add(['work_overtime' => 1]);
        } else {
            $request->request->add(['work_overtime' => 0]);
        }
        $plan->update($request->all());
        return redirect()->route('plans.index')->with('success', 'Plan de mantenimiento actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plan de mantenimiento Eliminado correctamente.');}

    public function protocols(Plan $plan)
    {

        $eqipments = $plan->equipments;
        $this->getProtocols($eqipments, $plan);

        return redirect()->route('plans.index')->with('success', 'Protocols asignados a Plan de mantenimiento.');}

    public function getProtocols($eqipments, $plan)
    {

        foreach ($eqipments as $e) {

            $protocols = $e->prototype->protocols;
            foreach ($protocols as $p) {
                $goal = Goal::updateOrCreate(
                    ['plan_id' => $plan->id,
                        'protocol_id' => $p->id,
                        'equipment_id' => $e->id],
                    [
                        'specialty_id' => $p->specialty_id,
                        'position' => $p->position,
                        'task' => $p->task,
                        'detail' => $p->detail,
                        'frecuency' => $p->frecuency,
                        'duration' => $p->duration,
                        'permissions' => $p->permissions,
                        'security' => $p->security,
                        'workers' => $p->workers,
                        'conditions' => $p->conditions,
                        'total_replacement' => 0,
                        'total_supply' => 0,
                        'total_service' => 0,
                        'total_workers' => 0,
                        'workers_id' => '',
                        'total' => 0,
                        'start' => $plan->start,
                        'end' => now(),
                        'done' => now(),
                        'days' => 0,
                        'time' => 0]
                );
            }
        }
    }

    public function resources(Plan $plan)
    {
        $goals = $plan->goals;
        return view('mant.plans.resources', compact('goals'));
    }

    public function teams(Plan $plan)
    {
        $goals = $plan->goals;
        $equipments = $plan->equipments;
        return view('mant.plans.teams', compact('equipments', 'plan'));
    }

    public function timeline(Plan $plan)
    {
        $goals = $plan->goals()->orderBy('equipment_id')->orderBy('position')->orderBy('specialty_id')->get();

        $this->delete_table($plan->id);

        foreach ($goals as $goal) {
            $timeline = Timeline::create($goal->toArray());
        }

        $timelines = Timeline::all();
        $plan_start = $this->plan_init($plan->id);
        $plan_work = $this->plan_work($plan->id);
        $plan_specialties = $plan->goals->unique('specialty_id')->pluck('specialty_id');
        $plan_teams = Team::whereIn('specialty_id', $plan_specialties)->get();

        $rest_start = $this->plan_init($plan->id);
        $rest_start = Carbon::parse($rest_start)->addHour($plan->rest_time_hours);
        $rest_end = Carbon::parse($rest_start)->addHour($plan->rest_hours);
        $duration = 0;

        foreach ($timelines as $timeline) {
            if ($timeline->position == 1) {
                $timeline->start = $this->plan_init($plan->id);
                $timeline->end = $plan_start->addHours($timeline->duration);
                $duration = 0;
            } else {

                $timeline->start = $plan_start;
                $timeline->end = $plan_start->addHours($timeline->duration);
                 if ($timeline->start->between($rest_start, $rest_end) || $timeline->end->between($rest_start, $rest_end)) {
                     $timeline->end = $timeline->end->addHours($plan->rest_hours);
                 }
            }

            $timeline->save();
             $duration = $duration + $timeline->duration;
              if($plan->work_shift==1 && $duration >=8){
                  $plan_start = $plan_start->addDay();
                  $timeline->start = $timeline->start->addDay();
                   $timeline->start->hour=$plan_work->hour;
                  $this->plan_init($plan->id);
              }

              if($plan->work_shift==2 && $duration >=16){
                  $plan_start = $plan_start->addDay();
                  $this->plan_init($plan->id);
              }



        }

        return view('mant.plans.timeline', compact('timelines', 'rest_start', 'rest_end'));
    }




    private function delete_table($plan)
    {
        DB::statement("SET foreign_key_checks=0");
        Timeline::where('plan_id', $plan)->truncate();
        DB::statement("SET foreign_key_checks=1");
        //Timeline::where('plan_id', $plan->id)->delete();
    }

    private function plan_init($id)
    {
        $plan = Plan::find($id);
        $plan_start = $plan->start->toDateString() . ' ' . $plan->work_time->toTimeString();
        $plan_start = Carbon::parse($plan_start);
        return $plan_start;
    }

    private function plan_work($id)
    {
        $plan = Plan::find($id);
        $plan_work = $plan->start->toDateString() . ' ' . $plan->work_time->toTimeString();
        $plan_work = Carbon::parse($plan_work)->addHours($plan->daily_shift);
        return $plan_work;
    }




}
