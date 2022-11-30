<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Models\Fail;
use App\Models\Replacement;
use App\Models\Resume;
use App\Models\Service;
use App\Models\Supply;
use App\Models\Team;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fails = Fail::orderBy('status','asc')
                       ->get();

        return view('mant.fails.index',compact('fails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function show(Fail $fail)
    {
         if($fail->status <>1){
            return redirect()->route('fails.repareid')->with('success','Falla No reparada.');
         }

         $resume = Resume::where('fail',$fail->id)->first();
         $w=str_split($resume->workers);
         $users = User::find($w);
         return view('mant.fails.show', compact('resume','fail','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function edit(Fail $fail)
    {
        //
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
        if($fail->status==1){
            return redirect()->route('fails.index')->with('success','Falla reparada, no se le puede asignar grupo de tarea');
        }
        return view('mant.fails.add',compact('fail'));
    }

    public function tasks(){

        $team = auth()->user()->team;
        $fails = $team->fails()->where('status',0)->get();
        return view('mant.fails.tasks',compact('fails'));
    }


    public function repareid(){

        $team = auth()->user()->team;
        $fails = $team->fails()->where('status',1)->get();
        return view('mant.fails.repareid',compact('fails'));
    }




    public function repair(Fail $fail){
        return view('mant.fails.repair',compact('fail'));
    }

    public function despeje(Request $request, Fail $fail){
        $workers = $request->validate([
            'users'=>'required',
           ]);
        $fail->status =1;
        $fail->repareid_at= now();
        $this->resume($fail,$workers);
        $fail->save();
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
