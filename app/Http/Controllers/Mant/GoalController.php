<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\Team;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function replacements(Goal $goal)
    {

        return view('mant.goals.replacements', compact('goal'));
    }

    public function positions(Goal $goal)
    {

        $goals = Goal::where('equipment_id', $goal->equipment_id)->get();
        $goal = Goal::where('equipment_id', $goal->equipment_id)->first();
        $plan_id = $goal->plan_id;
        return view('mant.goals.positions', compact('goals','plan_id'));
    }

    public function edit(Goal $goal)
    {

        $protocols = Goal::where('equipment_id', $goal->equipment_id)->get();
        return view('mant.goals.edit', compact('goal', 'protocols'));
    }

    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'position' => 'required|numeric',
            'priority' => 'required|numeric',
        ]);

        $goal->position = $request->input('position');
        $goal->priority = $request->input('priority');
        $goal->restriction = $request->input('restriction');
        $goal->save();
        return redirect()->route('goals.positions', $goal->id)->with('success', 'Protocolo actualizado correctamente.');

    }

    public function teams($planId, $equipmentId)
    {
        $plan = Plan::find($planId);
        $equipment = Equipment::find($equipmentId);
        $specialties = $plan->goals->where('equipment_id', $equipmentId)->unique('specialty_id')->pluck('specialty_id');
        $teams = Team::whereIn('specialty_id',$specialties)->get();
        return view('mant.goals.teams', compact('teams', 'equipment', 'plan'));

    }

    public function assign(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required',
            'plan_id' => 'required',
            'teams' => 'required',
        ]);

        $teams = Team::find($request->input('teams'));
        $teamIds = $teams->pluck('id')->toArray();
        $teamIds = implode(',', $teamIds);
        $salary = 0;
        foreach ($teams as $t) {
            $workers = $t->users;
            foreach ($workers as $w) {
                $salary = $salary + $w->profile->salary;
            }
        }

        $goal = Goal::where('plan_id', $request->input('plan_id'))
            ->where('equipment_id', $request->input('equipment_id'))->first();
        $goal->total_workers = $salary;
        $goal->workers_id = $teamIds;
        $goal->save();

        $goal->teams()->sync($teams);

        return redirect()->route('plans.teams', $request->input('plan_id'))->with('success', 'Equipo asignado correctamente correctamente.');

    }

}
