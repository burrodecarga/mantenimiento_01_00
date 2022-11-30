<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplyController extends Controller
{

    public function __construct(){
        $this->middleware('can:supplies.index')->only('index');
        $this->middleware('can:supplies.create')->only(['create','store']);
        $this->middleware('can:supplies.show')->only('show');
        $this->middleware('can:supplies.edit')->only(['edit','update']);
        $this->middleware('can:supplies.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplies = Supply::all();
        return view('storer.supplies.index',compact('supplies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supply = new Supply();
        $title="add supply";
        $btn="create";
        return view('storer.supplies.create', compact('supply','title','btn'));

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
            'unit'=>'required',
            'supply'=>'required',
            'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'stock'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'brand'=>'required',
           ]);
             $supply = Supply::create([
                'name'=>mb_strtolower($request->input('name')),
                'slug' =>Str::slug($request->input('name')),
                'brand'=>mb_strtolower($request->input('brand')),
                'unit'=>mb_strtolower($request->input('unit')),
                'supply'=>mb_strtolower($request->input('supply')),
                'price'=>$request->input('price'),
                'stock'=>$request->input('stock'),
                'description'=>mb_strtolower($request->input('description')),
            ]);

            return redirect()->route('supplies.index')->with('success','Repuesto creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function show(Supply $supply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function edit(Supply $supply)
    {
        $title="add supply";
        $btn="create";
        return view('storer.supplies.edit', compact('supply','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supply $supply)
    {
        $request->validate([
            'name'=>'required',
            'unit'=>'required',
            'supply'=>'required',
            'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'stock'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'brand'=>'required',
           ]);

                $supply->name = mb_strtolower($request->input('name'));
                $supply->slug = Str::slug($request->input('name'));
                $supply->brand = mb_strtolower($request->input('brand'));
                $supply->supply = mb_strtolower($request->input('supply'));
                $supply->unit = mb_strtolower($request->input('unit'));
                $supply->price = $request->input('price');
                $supply->stock = $request->input('stock');
                $supply->description = mb_strtolower($request->input('description'));
                 $supply->save();
            return redirect()->route('supplies.index')->with('success','insumo actualizado correctamente');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supply $supply)
    {
         $supply->delete();
         return redirect()->route('supplies.index')->with('success','Insumo eliminado correctamente');

    }
}
