<?php

namespace App\Http\Controllers\Planner;

use App\Http\Controllers\Controller;
use App\Models\Subsystem;
use App\Models\System;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubsystemController extends Controller
{

    public function __construct(){
        $this->middleware('can:subsystems.index')->only('index');
        $this->middleware('can:subsystems.create')->only(['create','store']);
        $this->middleware('can:subsystems.show')->only('show');
        $this->middleware('can:subsystems.edit')->only(['edit','update']);
        $this->middleware('can:subsystems.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsystems = Subsystem::all();
        return view('planner.subsystems.index',compact('subsystems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $systems = System::all();
        $subsystem = new Subsystem();
        $title="add subsystem";
        $btn="create";
        return view('planner.subsystems.create', compact('systems','subsystem','title','btn'));

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
            'name'=>'required|unique:systems,name',
            'system_id'=>'required|integer'
           ]);

             $system = Subsystem::create([
                'name'=>mb_strtolower($request->input('name')),
                'slug' =>Str::slug($request->input('name')),
                'system_id' =>$request->input('system_id')

            ]);
            return redirect()->route('subsystems.index')->with('success','Subsistema creado correctamente');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subsystem  $subsystem
     * @return \Illuminate\Http\Response
     */
    public function show(Subsystem $subsystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subsystem  $subsystem
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsystem $subsystem)
    {
        $systems = System::all();
        $title="edit subsystem";
        $btn="update";
        return view('planner.subsystems.edit', compact('systems','subsystem','title','btn'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subsystem  $subsystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsystem $subsystem)
    {
        $request->validate([
            'name'=>'required|unique:systems,name',
            'system_id'=>'required|integer'
           ]);

               $subsystem->name = mb_strtolower($request->input('name'));
               $subsystem->slug = Str::slug($request->input('name'));
               $subsystem->system_id = $request->input('system_id');
               $subsystem->save();

            return redirect()->route('subsystems.index')->with('success','Subsistema actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subsystem  $subsystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsystem $subsystem)
    {
        $subsystem->delete();
        return redirect()->route('subsystems.index')->with('success','Subsistema eliminado correctamente');

    }
}
