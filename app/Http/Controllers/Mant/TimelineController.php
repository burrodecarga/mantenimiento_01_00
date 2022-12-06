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

        $teamId = auth()->user()->teams->first()->id;
        $team = Team::find($teamId);
        $timelines = Timeline::where('status', 0)->where('user_id',$team->user_id)->get();
        dd($team->name,$team->id,$timelines,auth()->user()->id);
        return view('mant.timelines.assigned', compact('timelines'));
    }

    public function boss(Timeline $timeline){
        $teams = $timeline->boss();
        return view('mant.timelines.boss',compact('teams','timeline'));
    }

    public function worker(Request $request, Timeline $timeline ){
         $request->validate([
            'workers_id'=>'required',
         ]);
$timeline->user_id = $request->input('workers_id');

         $timeline->save();
         return redirect()->route('timelines.pending')->with('success','Responsable asignado Correctamente');
    }



}
