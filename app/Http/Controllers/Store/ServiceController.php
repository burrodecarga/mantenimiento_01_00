<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function __construct(){
        $this->middleware('can:services.index')->only('index');
        $this->middleware('can:services.create')->only(['create','store']);
        $this->middleware('can:services.show')->only('show');
        $this->middleware('can:services.edit')->only(['edit','update']);
        $this->middleware('can:services.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('storer.services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service = new Service();
        $title="add service";
        $btn="create";
        return view('storer.services.create', compact('service','title','btn'));

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
           ]);
             $service = Service::create([
                'name'=>mb_strtolower($request->input('name')),
                'slug' =>Str::slug($request->input('name')),
                'supply'=>mb_strtolower($request->input('supply')),
                'price'=>$request->input('price'),
                'description'=>mb_strtolower($request->input('description')),
            ]);

            return redirect()->route('services.index')->with('success','Repuesto creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $title="add service";
        $btn="create";
        return view('storer.services.edit', compact('service','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
           ]);

                $service->name = mb_strtolower($request->input('name'));
                $service->slug = Str::slug($request->input('name'));
                $service->supply = mb_strtolower($request->input('supply'));
                $service->price = $request->input('price');
                $service->description = mb_strtolower($request->input('description'));
                 $service->save();
            return redirect()->route('services.index')->with('success','Repuesto actualizado correctamente');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
         $service->delete();
         return redirect()->route('services.index')->with('success','Servicio eliminado correctamente');

    }
}
