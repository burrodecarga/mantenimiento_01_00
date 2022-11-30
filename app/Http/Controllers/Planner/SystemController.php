<?php

namespace App\Http\Controllers\Planner;

use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SystemController extends Controller
{

    public function __construct(){
        $this->middleware('can:systems.index')->only('index');
        $this->middleware('can:systems.create')->only(['create','store']);
        $this->middleware('can:systems.show')->only('show');
        $this->middleware('can:systems.edit')->only(['edit','update']);
        $this->middleware('can:systems.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $systems = System::all();
      return view('planner.systems.index',compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $system = new System();
        $title="add system";
        $btn="create";
        return view('planner.systems.create', compact('system','title','btn'));
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
            'name'=>'required|unique:systems,name'
           ]);
             $system = System::create([
                'name'=>mb_strtolower($request->input('name')),
                'slug' =>Str::slug($request->input('name'))

            ]);
            return redirect()->route('systems.index')->with('success','Sistema creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System  $system
     * @return \Illuminate\Http\Response
     */
    public function show(System $system)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System  $system
     * @return \Illuminate\Http\Response
     */
    public function edit(System $system)
    {
        $title="edit system";
        $btn="update";
        return view('planner.systems.edit', compact('system','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\System  $system
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, System $system)
    {
        $request->validate([
            'name'=>'required|unique:systems,name,'.$system->id
           ]);
             $system->name= mb_strtolower($request->input('name'));
             $system->slug = Str::slug($request->input('name'));
             $system->save();


            return redirect()->route('systems.index')->with('success','Sistema actualizado correctamente');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System  $system
     * @return \Illuminate\Http\Response
     */
    public function destroy(System $system)
    {

        if($system->has('subsystems')->count()){
        return redirect()->route('systems.index')->with('fail','Sistema imposible eliminar, posee subsistemas');}
        $system->delete();
        return redirect()->route('systems.index')->with('success','Sistema eliminado correctamente');
    }
}
