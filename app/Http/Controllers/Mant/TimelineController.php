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
        return redirect()->route('fails.tasks')->with('success','Falla reparada.');

    }

    public function resume(Fail $fail, $workers){

        $failreplacementstotal=0;

        foreach($fail->replacements as $r){
            $failreplacementstotal =$failreplacementstotal+$r->pivot->total;
        }


        $failsupliestotal=0;
        foreach($fail->supplies as $r){
            $failsupliestotal =$failsupliestotal+$r->pivot->total;
        }

        $failservicestotal=0;
        foreach($fail->services as $r){
            $failservicestotal =$failservicestotal+$r->pivot->total;
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

       $time = $fail->reported_at->diffInHours($fail->repareid_ad);
       $days = $fail->reported_at->diffInDays($fail->repareid_ad);



        Resume::create([
        'fail'=>$fail->id,
        'equipment'=>$fail->equipment_id,
        'type'=>0,
        'total_replacement' =>$failreplacementstotal,
        'total_supply' =>$failsupliestotal,
        'total_service' =>$failservicestotal,
        'total_workers' =>$totalworkers,
        'workers' => $str,
        'total'=>($failreplacementstotal+$failsupliestotal+$failservicestotal+$totalworkers),
        'reported_at'=>$fail->reported_at,
        'repareid_at'=>$fail->repareid_at,
        'assigned_at'=>$fail->assigned_at,
        'time'=>$time,
        'days'=>$days

     ]);
    }



}
