<?php

namespace App\Http\Controllers;

use App\Models\Protocol;
use App\Models\Prototype;
use App\Models\Specialty;
use App\Models\Task;
use Illuminate\Http\Request;

class PrototypeProtocolController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prototype $prototype)
    {
       $specialties = Specialty::orderBy('name')->get();
       $tasks = Task::orderBy('name')->get();
       $protocol = new Protocol();
       $title =__("add protocol to").": ".$prototype->name;
       $btn="create";
        return view('planner.prototypes.protocols.create',compact('prototype','protocol','specialties','tasks','title','btn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Prototype $prototype)
    {
        $data = $request->validate([
            'task'=>'required',
            'detail'=>'required',
            'permissions'=>'required',
            'security'=>'required',
            'conditions'=>'required',
            'specialty_id'=>'integer|required',
            'position'=>'integer|required',
            'task_id'=>'integer|required',
            'frecuency'=>'integer|required',
            'duration'=>'integer|required',
            'workers'=>'integer|required',
           ]);

           $prototype->protocols()->create($data);
           return redirect()->route('prototypes.index')->with('success','Protocolo creado correctamente');





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prototype  $prototype
     * @return \Illuminate\Http\Response
     */
    public function show(Prototype $prototype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prototype  $prototype
     * @return \Illuminate\Http\Response
     */
    public function edit(Prototype $prototype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prototype  $prototype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prototype $prototype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prototype  $prototype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prototype $prototype)
    {
        //
    }
}
