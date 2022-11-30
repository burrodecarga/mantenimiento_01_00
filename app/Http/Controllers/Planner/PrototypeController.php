<?php

namespace App\Http\Controllers\Planner;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Prototype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PrototypeController extends Controller
{
    public function __construct(){
        $this->middleware('can:prototypes.index')->only('index');
        $this->middleware('can:prototypes.create')->only(['create','store']);
        $this->middleware('can:prototypes.show')->only('show');
        $this->middleware('can:prototypes.edit')->only(['edit','update']);
        $this->middleware('can:prototypes.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prototypes = Prototype::all();
        return view('planner.prototypes.index',compact('prototypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prototype = new Prototype();
        $title="add prototype";
        $btn="create";
        return view('planner.prototypes.create', compact('prototype','title','btn'));
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
            'url'=>'image|mimes:jpg,jpeg,png,bmp,tiff |max:4096'
           ]);

             $prototype = Prototype::create([
                'name'=>mb_strtolower($request->input('name')),
                'cha_1'=>mb_strtolower($request->input('cha_1')),
                'cha_2'=>mb_strtolower($request->input('cha_2')),
                'cha_3'=>mb_strtolower($request->input('cha_3')),
                'cha_4'=>mb_strtolower($request->input('cha_4')),
                'description'=>mb_strtolower($request->input('description')),
            ]);

            if($request->file('url')){

             $file = $request->file('url')->store('public/prototypes');
             $url = Storage::url($file);
             $prototype->images()->create([
                'url'=>$url,
                'description'=>mb_strtolower($request->input('description'))
             ]);
            }

            return redirect()->route('prototypes.index')->with('success','Prototipo creado correctamente');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prototype  $prototype
     * @return \Illuminate\Http\Response
     */
    public function show(Prototype $prototype)
    {
        return view('planner.prototypes.show', compact('prototype'));
        //return view('planner.prototypes.test', compact('prototype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prototype  $prototype
     * @return \Illuminate\Http\Response
     */
    public function edit(Prototype $prototype)
    {
        $title="edit prototype";
        $btn="create";
        return view('planner.prototypes.edit', compact('prototype','title','btn'));
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

        $request->validate([
            'name'=>'required',
            'url'=>'image|mimes:jpg,jpeg,png,bmp,tiff |max:4096'
           ]);


                $prototype->name = mb_strtolower($request->input('name'));
                $prototype->cha_1 = mb_strtolower($request->input('cha_1'));
                $prototype->cha_2 = mb_strtolower($request->input('cha_2'));
                $prototype->cha_3 = mb_strtolower($request->input('cha_3'));
                $prototype->cha_4 = mb_strtolower($request->input('cha_4'));
                $prototype->description = mb_strtolower($request->input('description'));
                $prototype->save();

            if($request->file('url')){
             $file = $request->file('url')->store('public/prototypes');
             $url = Storage::url($file);
             $prototype->images()->create([
                'url'=>$url,
                'description'=>mb_strtolower($request->input('description'))
             ]);
            }

            return redirect()->route('prototypes.index')->with('success','Prototipo actualizado correctamente');


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prototype  $prototype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prototype $prototype)
    {
        $message ="Error al intentar borrar archivos o archivos inexistentes";
        if($prototype->images()->count()>0){

            $files = $prototype->images()->pluck('url')->toArray();
            foreach($files as $file){
                $url = str_replace('storage','public',$file);
                Storage::delete($url);
            }
            $message ="archivos eliminados correctamente";
        }
        $prototype->images()->delete();
        return redirect()->route('prototypes.index')->with('success', $message);
    }

    public function image(Prototype $prototype){
        return view('planner.prototypes.images.image',compact('prototype'));
    }

    public function image_destroy(Request $request, Image $image){
        $file = $image->url;
        $url = str_replace('storage','public',$file);
        Storage::delete($url);
        $image->delete();
        return redirect()->route('prototypes.show', $request->input('prototype_id'))->with('success','Imagen Eliminada correctamente');
    }









}
