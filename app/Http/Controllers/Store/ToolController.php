<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ToolController extends Controller
{

    public function __construct(){
        $this->middleware('can:tools.index')->only('index');
        $this->middleware('can:tools.create')->only(['create','store']);
        $this->middleware('can:tools.show')->only('show');
        $this->middleware('can:tools.edit')->only(['edit','update']);
        $this->middleware('can:tools.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = Tool::all();
        return view('storer.tools.index',compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tool = new Tool();
        $title="add tool";
        $btn="create";
        return view('storer.tools.create', compact('tool','title','btn'));

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

             $tool = Tool::create([
                'name'=>mb_strtolower($request->input('name')),
                'slug' =>Str::slug($request->input('name')),
                'brand'=>mb_strtolower($request->input('brand')),
                'supply'=>mb_strtolower($request->input('supply')),
                'price'=>$request->input('price'),
                'stock'=>$request->input('stock'),
                'description'=>mb_strtolower($request->input('description')),
            ]);

            return redirect()->route('tools.index')->with('success','Repuesto creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function edit(Tool $tool)
    {
        $title="add tool";
        $btn="create";
        return view('storer.tools.edit', compact('tool','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'stock'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'brand'=>'required',
           ]);
                $tool->name = mb_strtolower($request->input('name'));
                $tool->slug = Str::slug($request->input('name'));
                $tool->brand = mb_strtolower($request->input('brand'));
                $tool->supply = mb_strtolower($request->input('supply'));
                $tool->price = $request->input('price');
                $tool->stock = $request->input('stock');
                $tool->description = mb_strtolower($request->input('description'));
                $tool->save();

            return redirect()->route('tools.index')->with('success','Repuesto actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
         $tool->delete();
         return redirect()->route('tools.index')->with('success','Herramienta eliminada correctamente');

    }
}
