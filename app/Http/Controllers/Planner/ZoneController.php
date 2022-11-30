<?php

namespace App\Http\Controllers\Planner;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ZoneController extends Controller
{

    public function __construct(){
        $this->middleware('can:zones.index')->only('index');
        $this->middleware('can:zones.create')->only(['create','store']);
        $this->middleware('can:zones.show')->only('show');
        $this->middleware('can:zones.edit')->only(['edit','update']);
        $this->middleware('can:zones.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::all();
        return view('planner.zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zone = new Zone();
        $title="add zone";
        $btn="create";
        return view('planner.zones.create', compact('zone','title','btn'));
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
            'name'=>'required|unique:zones,name'
           ]);
             $zone = Zone::create([
                'name'=>mb_strtolower($request->input('name')),
                'slug' =>Str::slug($request->input('name'))

            ]);
            return redirect()->route('zones.index')->with('success','Zona creada correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        $title="edit zone";
        $btn="update";
        return view('planner.zones.edit', compact('zone','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        $request->validate([
            'name'=>'required|unique:zones,name,'.$zone->id
           ]);
        $zone->name = mb_strtolower($request->input('name'));
        $zone->slug = Str::slug($request->input('name'));
            $zone->save();
            return redirect()->route('zones.index')->with('success','Zona actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //Relación de uno a muchos que se debe confirmar el zone
        $zone->delete();
            return redirect()->route('zones.index')->with('success','Zona eliminada correctamente');
    }
}
