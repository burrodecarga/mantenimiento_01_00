<?php

namespace App\Http\Controllers\Planner;

use App\Http\Controllers\Controller;
use App\Models\Protocol;
use App\Models\Prototype;
use App\Models\Specialty;
use App\Models\Task;
use Illuminate\Http\Request;

class ProtocolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $protocols = Protocol::all();
     return view('planner.protocols.index',compact('protocols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $prototypes = Prototype::orderBy('name')->get();
       $specialties = Specialty::orderBy('name')->get();
       $tasks = Task::orderBy('name')->get();
       $protocol = new Protocol();
       $title ="add protocol";
       $btn="create";
       return view('planner.protocols.create', compact('protocol', 'specialties', 'tasks','prototypes','specialties','tasks','title','btn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'task'=>'required',
            'detail'=>'required',
            'permissions'=>'required',
            'security'=>'required',
            'conditions'=>'required',
            'prototype_id'=>'integer|required',
            'specialty_id'=>'integer|required',
            'position'=>'integer|required',
            'task_id'=>'integer|required',
            'frecuency'=>'integer|required',
            'duration'=>'integer|required',
            'workers'=>'integer|required',
           ]);

           Protocol::create($data);
           return redirect()->route('protocols.index')->with('success','Protocolo creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Protocol  $protocol
     * @return \Illuminate\Http\Response
     */
    public function show(Protocol $protocol)
    {
        $data = $request->validate([
            'task'=>'required',
            'detail'=>'required',
            'permissions'=>'required',
            'security'=>'required',
            'conditions'=>'required',
            'prototype_id'=>'integer|required',
            'specialty_id'=>'integer|required',
            'position'=>'integer|required',
            'task_id'=>'integer|required',
            'frecuency'=>'integer|required',
            'duration'=>'integer|required',
            'workers'=>'integer|required',
           ]);

           $protocol->update($data);
           $protocol->save();
           return redirect()->route('protocols.index')->with('success','Protocolo actualizado correctamente');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Protocol  $protocol
     * @return \Illuminate\Http\Response
     */
    public function edit(Protocol $protocol)
    {
        $prototypes = Prototype::orderBy('name')->get();
        $specialties = Specialty::orderBy('name')->get();
        $tasks = Task::orderBy('name')->get();
        $title ="edit protocol";
        $btn="update";
        return view('planner.protocols.edit', compact('protocol', 'specialties', 'tasks','prototypes','specialties','tasks','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Protocol  $protocol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Protocol $protocol)
    {
        $data = $request->validate([
            'task'=>'required',
            'detail'=>'required',
            'permissions'=>'required',
            'security'=>'required',
            'conditions'=>'required',
            'prototype_id'=>'integer|required',
            'specialty_id'=>'integer|required',
            'position'=>'integer|required',
            'task_id'=>'integer|required',
            'frecuency'=>'integer|required',
            'duration'=>'integer|required',
            'workers'=>'integer|required',
           ]);

           $protocol->update($data);
           $protocol->save();
           return redirect()->route('protocols.index')->with('success','Protocolo actualizado correctamente');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Protocol  $protocol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Protocol $protocol)
    {
       $protocol->delete();
       return redirect()->route('protocols.index')->with('fail','Protocolo eliminado correctamente');
    }

    public function prototype(Prototype $prototype){
        return view('planner.protocols.prototypes.prototype',compact('prototype'));
    }




}
