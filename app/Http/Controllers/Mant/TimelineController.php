<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Timeline;
use App\Models\User;
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
                return redirect()->route('dashboard')->with('timeline', 'Usuario no está asignado a ningún equipo de tareas');
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
        $user = auth()->user();
        $team = $user->teams()->first();
        return view('mant.timelines.work', compact('timeline', 'team'));

    }

    public function despeje(Request $request, Timeline $timeline){
        $workers = $request->validate([
            'users'=>'required',
           ]);
        $timeline->status =1;
        $timeline->done= now();
        $this->resume($timeline,$workers);
        $timeline->save();
return redirect()->route('timelines.assigned')->with('success', 'Tarea Realizada.');


    }

    public function resume(Timeline $timeline, $workers){

        $timelinereplacementstotal=0;

        foreach($timeline->replacements as $r){
            $timelinereplacementstotal =$timelinereplacementstotal+$r->pivot->total;
        }


        $timelinesupliestotal=0;
        foreach($timeline->supplies as $r){
            $timelinesupliestotal =$timelinesupliestotal+$r->pivot->total;
        }

        $timelineservicestotal=0;
        foreach($timeline->services as $r){
            $timelineservicestotal =$timelineservicestotal+$r->pivot->total;
        }

        $totalworkers=0;
        $str='';

        foreach($workers as $key=>$w){
          $str = implode(',',$w);
           $users = User::find($w);
           foreach($users as $u){
               $totalworkers= $totalworkers+$u->profile->salary;
           }

        }

       $time = $timeline->start->diffInHours($timeline->done);
       $days = $timeline->start->diffInDays($timeline->done);



        $timeline->update([
        'total_replacement' =>$timelinereplacementstotal,
        'total_supply' =>$timelinesupliestotal,
        'total_service' =>$timelineservicestotal,
        'total_workers' =>$totalworkers,
        'workers_id' => $str,
        'total'=>($timelinereplacementstotal+$timelinesupliestotal+$timelineservicestotal+$totalworkers),
        'time'=>$time,
        'days'=>$days

     ]);
    }



}
