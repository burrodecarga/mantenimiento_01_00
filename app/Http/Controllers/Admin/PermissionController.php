<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function __construct(){
        $this->middleware('can:permissions.index')->only('index');
        $this->middleware('can:permissions.create')->only(['create','store']);
        $this->middleware('can:permissions.show')->only('show');
        $this->middleware('can:permissions.edit')->only(['edit','update']);
        $this->middleware('can:permissions.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $permissions = Permission::all();
       return view('admin.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permmision  $permmision
     * @return \Illuminate\Http\Response
     */
    public function show(Permmision $permmision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permmision  $permmision
     * @return \Illuminate\Http\Response
     */
    public function edit(Permmision $permmision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permmision  $permmision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permmision $permmision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permmision  $permmision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permmision $permmision)
    {
        //
    }
}
