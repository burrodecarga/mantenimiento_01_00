<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\Team;
use App\Models\Timeline;
use App\Models\User;
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
        $tecnicos = User::role('tecnico')->get();
        return view('mant.plans.index', compact('plans', 'tecnicos'));
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

        $start_time = Carbon::createFromTimestamp(strtotime($request->start_time))->hour;
        $rest_time = Carbon::createFromTimestamp(strtotime($request->rest_time))->hour;
        $rest_time_hours = $rest_time - $start_time;
        $work_time = $request->start_time;
        $request->request->add(['work_time' => $work_time]);
        $request->request->add(['rest_time_hours' => $rest_time_hours]);
        $request->request->remove('rest_time');

        $plan = Plan::create($request->all());
        return redirect()->route('plans.show',$plan->id)->with('success', 'Plan de mantenimiento creado correctamente.');

    }


    public function show(Plan $plan)
    {
        $tecnicos = User::role('tecnico')->get();
        return view('mant.plans.show', compact('plan','tecnicos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function equipments(Plan $plan)
    {
        return view('mant.plans.equipments', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $btn = "edit plan";
        $title = "edit plan";
        $plan->work_time = Carbon::parse($plan->start_time)->addHours($plan->rest_time_hours);
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

        $start_time = Carbon::createFromTimestamp(strtotime($request->start_time))->hour;
        $rest_time = Carbon::createFromTimestamp(strtotime($request->rest_time))->hour;
        $rest_time_hours = $rest_time - $start_time;
        $work_time = $request->start_time;
        $request->request->add(['work_time' => $work_time]);
        $request->request->add(['rest_time_hours' => $rest_time_hours]);
        $request->request->remove('rest_time');

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
        Timeline::where('plan_id', $plan->id)->delete();
        $plan->delete();
        return redirect()->route('plans.index')->with('success', 'Plan de mantenimiento Eliminado correctamente.');
    }

    public function protocols(Plan $plan)
    {

        Goal::where('id', '<>', 0)->delete();
        $eqipments = $plan->equipments;
        if($eqipments->count()==0){
            return redirect()->route('plans.show',$plan->id)->with('fail','no hay equipos registrados en el plan, registre equipos primero');
        }
        $this->getProtocols($eqipments, $plan);

        return redirect()->route('plans.show',$plan->id)->with('success', 'Protocols asignados a Plan de mantenimiento.');
    }

    public function getProtocols($eqipments, $plan)
    {

        foreach ($eqipments as $e) {

            $protocols = $e->prototype->protocols;
            foreach ($protocols as $p) {

                $start = Carbon::parse($plan->start);
                $start->hour = Carbon::parse($plan->start_time)->hour;
                $end = Carbon::parse($plan->start);
                $end->hour = Carbon::parse($plan->start_time)->hour;
                $end->addHour($p->duration);

                $goal = Goal::updateOrCreate(
                    ['plan_id' => $plan->id,
                        'protocol_id' => $p->id,
                        'equipment_id' => $e->id],
                    [
                        'specialty_id' => $p->specialty_id,
                        'position' => $p->position,
                        'task' => $e->name . ' - ' . $p->task,
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
                        'start' => $start,
                        'end' => $end,
                        'done' => $end,
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
        if($goals->count()==0){
            return redirect()->route('plans.show',$plan->id)->with('fail','no se ha generado cronograma inicial');
        }

        $this->delete_table($plan->id);

        foreach ($goals as $goal) {
            $timeline = Timeline::create($goal->toArray());
            $timeline->goal_id = $goal->id;
            $timeline->save();
        }

        $timelines = Timeline::where('plan_id',$plan->id)->get();
        if($timelines->count()==0){
            return redirect()->route('plans.show',$plan->id)->with('fail','no se ha generado cronograma inicial');
        }

        $plan_start = $this->plan_init($plan->id);
        $work_start = $plan_start;
        $work_end = $this->plan_end($plan->id);

        $plan_specialties = $plan->goals->unique('specialty_id')->pluck('specialty_id');
        $plan_teams = Team::whereIn('specialty_id', $plan_specialties)->get();

        $rest_start = $this->plan_init($plan->id);
        $rest_start = Carbon::parse($rest_start)->addHour($plan->rest_time_hours);
        $rest_end = Carbon::parse($rest_start)->addHour($plan->rest_hours);
        $duration = 0;
        $week = 0;
        $equipment_id = Timeline::first()->equipment_id;
        $color = randomColor();
        foreach ($timelines as $timeline) {

            if ($timeline->position == 1 && $timeline->sequence == 1) {

                $timeline->start = $this->plan_init($plan->id);
                $plan_start = $this->plan_init($plan->id);
                $timeline->end = $plan_start->addHours($timeline->duration);

            } else {

                $timeline->start = $plan_start;
                $timeline->end = $plan_start->addHours($timeline->duration);

                if ($plan->work_shift != 3) {

                    if ($timeline->start->format('Gis.u') >= $work_end->format('Gis.u')) {
                        $plan_start->addDay();
                        if ($plan_start->dayOfWeek == 0) {$plan_start->next('Monday');}
                        $plan_start->hour = $work_start->hour;
                        $timeline->start = $plan_start;
                        $timeline->end = $plan_start->addHours($timeline->duration);
                    }

                    $duration = $duration + $timeline->duration;
                    $week = $week + $timeline->duration;

                    if ($plan->work_shift != 3) {
                        if ($plan->work_shift == 2 && $duration >= 16 && $duration < 24 && $week <= 44) {
                            $plan_start->addDay();
                            if ($plan_start->dayOfWeek == 0) {$plan_start->next('Monday');}
                            $plan_start->hour = $plan->work_time->hour;
                            $duration = 0;
                        }

                        if ($plan->work_shift == 2 && $duration >= 16 && $duration < 24 && $week > 44) {
                            $plan_start->addDay();
                            if ($plan_start->dayOfWeek == 0) {
                                $plan_start->next('Monday');
                            }
                            $plan_start->hour = $plan->work_time->hour;
                            $duration = 0;
                            $week = 0;
                        }

                        if ($plan->work_shift == 1 && $duration >= 8 && $duration < 24 && $week <= 44) {
                            $plan_start->addDay();
                            if ($plan_start->dayOfWeek == 0) {$plan_start->next('Monday');}
                            $plan_start->hour = $plan->work_time->hour;
                            $duration = 0;
                        }
                        if ($plan->work_shift == 1 && $duration >= 8 && $duration < 24 && $week > 44) {
                            $plan_start->addDay();
                            if ($plan_start->dayOfWeek == 0) {$plan_start->next('Monday');}
                            $plan_start->hour = $plan->work_time->hour;
                            $duration = 0;
                            $week = 0;
                        }

                    }

                    if($timeline->equipment_id<>$equipment_id){
                        $color = randomColor();
                        $equipment_id = $timeline->equipment_id;
                    }
                    $timeline->color=$color;
                    $timeline->activity = __("mantenince").' '.$timeline->equipment();
                    $timeline->save();

                }
            }
        }
        return view('mant.plans.timeline', compact('timelines', 'rest_start', 'rest_end'));
    }

    public function calendar(Plan $plan)
    {

        $timelines = Timeline::where('plan_id', $plan->id)->get();
        $events = [];

        foreach ($timelines as $timeline) {
            $events[] = [
                'id' => $timeline->id,
                'title' => $timeline->task,
                'start' => $timeline->start,
                'end' => $timeline->end,
                'color'=> $timeline->color
            ];
        }

        return view('mant.plans.calendar', ['events' => $events]);
    }

    public function sequence(Plan $plan)
    {
        $timelines = Timeline::where('plan_id', $plan->id)->get()->unique('equipment_id');

        if($timelines->count()==0){
            return redirect()->route('plans.show',$plan->id)->with('fail','no se ha generado cronograma inicial');
        }
        if (!$timelines->first()->sequence) {
            $timelines->first()->sequence = 1;
            $timelines->first()->save();
        }
        return view('mant.plans.sequence', compact('timelines', 'plan'));

    }

    public function sequence_update(Request $request, Plan $plan)
    {
        $timelines = Timeline::where('plan_id', $plan->id)->get()->unique('equipment_id');
        $id = $timelines->first()->equipment_id;
        $ids = $request->input('ids');
        if (!in_array($id, $ids)) {
            array_push($ids, $id);
        }
        Timeline::where('plan_id', $plan->id)->update(array('sequence' => 0));

        Timeline::where('plan_id', $plan->id)->where('position', '1')->whereIn('equipment_id', $ids)->update(array('sequence' => 1));

        Goal::where('plan_id', $plan->id)->update(array('sequence' => 0));

        Goal::where('plan_id', $plan->id)->where('position', '1')->whereIn('equipment_id', $ids)->update(array('sequence' => 1));

        $timelines = Timeline::where('plan_id', $plan->id)->get()->unique('equipment_id');

        return view('mant.plans.sequence', compact('timelines', 'plan'));

    }

    private function delete_table($plan)
    {
        DB::statement("SET foreign_key_checks=0");
        Timeline::where('plan_id', $plan)->delete();
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

    private function plan_end($id)
    {
        $plan = Plan::find($id);
        $plan_start = $plan->start->toDateString() . ' ' . $plan->work_time->toTimeString();
        $plan_start = Carbon::parse($plan_start);

        $plan_start->addHours($plan->daily_shift * $plan->work_shift);
        return $plan_start;
    }

}
