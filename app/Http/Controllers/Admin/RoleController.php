<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct(){
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.create')->only(['create','store']);
        $this->middleware('can:roles.show')->only('show');
        $this->middleware('can:roles.edit')->only(['edit','update']);
        $this->middleware('can:roles.destroy')->only('destroy');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $roles = Role::all();
       return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        $permissions = Permission::all();
        $title="add role";
        $btn="create";
        return view('admin.roles.create', compact('role','permissions','title','btn'));
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
        'name'=>'required|unique:roles,name'
       ]);
        $permissions = $request->permissions;
        $role = Role::create([
            'name'=>$request->input('name')
        ]);
        if($permissions){
            $role->givePermissionTo($permissions);
        }


        return redirect()->route('roles.index')->with('success','Role creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $rolePermissions = $role->getAllPermissions()->pluck('id')->toArray();
        $permissions = Permission::all();
        $title="detail of role";
        $btn="show";
        return view('admin.roles.show',compact('role','rolePermissions','permissions','title','btn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $rolePermissions = $role->getAllPermissions()->pluck('id')->toArray();
        $permissions = Permission::all();
        $title="edit role";
        $btn="update";
        return view('admin.roles.edit',compact('role','rolePermissions','permissions','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>'required|unique:roles,name,'.$role->id
           ]);
            $permissions = $request->permissions;
            $role->save();
            $role->permissions()->sync($permissions);
            return redirect()->route('roles.index')->with('success','Role actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
       $this->authorize('isDeleted',$role);
       $role->delete();
       return redirect()->route('roles.index')->with('success','Role eliminado correctamente');

    }





}
