<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Replacement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReplacementController extends Controller
{

    public function __construct(){
        $this->middleware('can:replacements.index')->only('index');
        $this->middleware('can:replacements.create')->only(['create','store']);
        $this->middleware('can:replacements.show')->only('show');
        $this->middleware('can:replacements.edit')->only(['edit','update']);
        $this->middleware('can:replacements.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replacements = Replacement::all();
        return view('storer.replacements.index',compact('replacements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $replacement = new Replacement();
        $title="add replacement";
        $btn="create";
        return view('storer.replacements.create', compact('replacement','title','btn'));

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
            'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'stock'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'brand'=>'required',
           ]);
             $replacement = Replacement::create([
                'name'=>mb_strtolower($request->input('name')),
                'slug' =>Str::slug($request->input('name')),
                'brand'=>mb_strtolower($request->input('brand')),
                'price'=>$request->input('price'),
                'stock'=>$request->input('stock'),
                'description'=>mb_strtolower($request->input('description')),
            ]);

            return redirect()->route('replacements.index')->with('success','Repuesto creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Replacement  $replacement
     * @return \Illuminate\Http\Response
     */
    public function show(Replacement $replacement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Replacement  $replacement
     * @return \Illuminate\Http\Response
     */
    public function edit(Replacement $replacement)
    {
        $title="add replacement";
        $btn="create";
        return view('storer.replacements.edit', compact('replacement','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Replacement  $replacement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Replacement $replacement)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'stock'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'brand'=>'required',
           ]);

                $replacement->name = mb_strtolower($request->input('name'));
                $replacement->slug = Str::slug($request->input('name'));
                $replacement->brand = mb_strtolower($request->input('brand'));
                $replacement->price = $request->input('price');
                $replacement->stock = $request->input('stock');
                $replacement->description = mb_strtolower($request->input('description'));
                 $replacement->save();
            return redirect()->route('replacements.index')->with('success','Repuesto actualizado correctamente');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Replacement  $replacement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Replacement $replacement)
    {
         $replacement->delete();
         return redirect()->route('replacements.index')->with('success','Repuesto eliminado correctamente');

    }
}
