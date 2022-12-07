<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function pending()
    {
        $timelines = Timeline::where('status', 0)->get();
        return view('mant.timelines.pending', compact('timelines'));
    }

    public function assigned()
    {

        $team = auth()->user()->teams()->first();
        if (!$team) {
            $team = auth()->user()->team;
            if (!$team) {
                return redirect()->route('dashboard')->with('fail', 'Usuario no está asignado a ningún equipo de tareas');
            }
        }

        $timelines = Timeline::where('status', 0)->where('team_id', $team->id)->get();

        return view('mant.timelines.assigned', compact('timelines'));
    }

    public function boss(Timeline $timeline)
    {
        $teams = $timeline->boss();
        return view('mant.timelines.boss', compact('teams', 'timeline'));
    }

    public function worker(Request $request, Timeline $timeline)
    {
        $request->validate([
            'workers_id' => 'required',
        ]);
        $timeline->team_id = $request->input('workers_id');

        $timeline->save();
        return redirect()->route('timelines.pending')->with('success', 'Responsable asignado Correctamente');
    }

    public function work(Timeline $timeline)
    {
        return view('mant.timelines.work', compact('timeline'));
    }

}
