<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\Team;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(){
        $this->middleware('can:teams.index')->only('index');
        $this->middleware('can:teams.create')->only(['create','store']);
        $this->middleware('can:teams.show')->only('show');
        $this->middleware('can:teams.edit')->only(['edit','update']);
        $this->middleware('can:teams.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $teams = Team::all();
      return view('mant.teams.index',compact('teams'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team = new Team();
        $specialties = Specialty::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        $zones = Zone::orderBy('name', 'asc')->get();
        $title="add team";
        $btn="create";
        return view('mant.teams.create',compact('team','specialties', 'zones','users','title','btn'));
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
            'name'=>'required',
            'specialty_id'=>'required',
            'user_id'=>'required|unique:teams,user_id'
           ]);
             $team = Team::create([
                'name'=>mb_strtolower($request->input('name')),
                'specialty_id'=>$request->input('specialty_id'),
                'user_id'=>$request->input('user_id'),
                'personal_team'=>true
            ]);
            $team->zones()->sync($request->input('zone_id'));
            return redirect()->route('teams.index')->with('success','Equipo creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $specialties = Specialty::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        $zones = Zone::orderBy('name', 'asc')->get();
        $title="edit team";
        $btn="update";
        return view('mant.teams.edit',compact('team','specialties','zones', 'users','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name'=>'required',
            'specialty_id'=>'required',
            'user_id'=>'required|unique:teams,user_id,'.$team->id,
           ]);

                $team->name = mb_strtolower($request->input('name'));
                $team->specialty_id = $request->input('specialty_id');
                $team->user_id = $request->input('user_id');
                $team->personal_team = true;
                $team->save();
                $team->zones()->sync($request->input('zone_id'));
            return redirect()->route('teams.index')->with('success','Equipo actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success','Equipo eliminado correctamente');
    }

    public function add($id)
    {
        $team = Team::find($id);
        $users = User::orderBy('name', 'asc')->get();
        $title="add team";
        $btn="create";
        return view('mant.teams.add',compact('team', 'users','title','btn'));
    }



}
