<?php

namespace App\Http\Controllers\Planner;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Prototype;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return $ldate = Carbon::now()->format('ydmhmsss');
        $equipments = Equipment::all();
        //return $equipments;
        return view('planner.equipments.index',compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipment = new Equipment();
        $equipment->name ='equipo-'. Carbon::now()->format('ydmhmsss');
        $title="add equipment";
        $btn="create";
        $zones = Zone::orderBy('name')->get();
        $prototypes = Prototype::orderBy('name')->get();
        return view('planner.equipments.create', compact('equipment','title','btn','zones','prototypes'));
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
            'name'=>'required',
            'prototype_id'=>'integer|required',
            'location'=>'required',
            'service'=>'integer|required',
           ]);


           Equipment::create($data+['slug'=>Str::slug($data['name']),'description'=>$request->input('description')]);
           return redirect()->route('equipments.index')->with('success','Equipo creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        $title="edit equipment";
        $btn="update";
        $zones = Zone::orderBy('name')->get();
        $prototypes = Prototype::orderBy('name')->get();
        return view('planner.equipments.edit', compact('equipment','title','btn','zones','prototypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        $data = $request->validate([
            'name'=>'required',
            'prototype_id'=>'integer|required',
            'location'=>'required',
            'service'=>'integer|required',
           ]);


           $equipment->update($data+['slug'=>Str::slug($data['name']),'description'=>$request->input('description')]);
           return redirect()->route('equipments.index')->with('success','Equipo actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipments.index')->with('success','Equipo eliminado correctamente');
    }
    public function addFeatures(Equipment $equipment){
     $prototypeFeatures = $equipment->prototype->features->pluck('id')->toarray();
     $equipmentFeatures = $equipment->features->pluck('id')->toarray();
     $resume = array_filter($prototypeFeatures, function($item) use($equipmentFeatures){
        if(!in_array($item,$equipmentFeatures)){return $item;}
     });
    $equipment->features()->sync($resume);
    return redirect()->route('equipments.index')->with('success','Caracteristicas de Equipo actualizada correctamente');

    }

    public function addValues(Equipment $equipment){
       $values = $equipment->features;
       return view('planner.equipments.features.values',compact('values','equipment'));
    }

    public function storeValues(Request $request,Equipment $equipment){
      $array = $request->all();
      unset($array['_token']);
      unset($array['_method']);
      foreach($array as $key=>$item){
        DB::table('equipment_feature')
        ->where('equipment_id', $equipment->id)
        ->where('feature_id', $key)
        ->update(['value' => $item]);
      }

      return redirect()->route('equipments.index')->with('success','Caracteristicas de Equipo actualizada correctamente');

    }

}

