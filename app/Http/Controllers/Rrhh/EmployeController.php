<?php

namespace App\Http\Controllers\Rrhh;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class EmployeController extends Controller
{
    public function __construct(){
        $this->middleware('can:employes.index')->only('index');
        $this->middleware('can:employes.create')->only(['create','store']);
        $this->middleware('can:employes.show')->only('show');
        $this->middleware('can:employes.edit')->only(['edit','update']);
        $this->middleware('can:employes.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $employes = User::all();
      return view('rrhh.employes.index',compact('employes'));
    }

    public function edit($id){
$roles = Role::where('id', '>=', 5)->get();

        $employe = User::find($id);
        $title="Edit Profile";
        $btn = "update";
return view('rrhh.employes.edit', compact('employe', 'title', 'btn', 'roles'));

    }

    public function update(Request $request,$id){
        $request->validate([
            'salary'=>'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'role'=>'required'
           ]);

           $user = User::find($id);
           $user->assignRole($request->input('role'));
           
           $profile = $user->profile;
           $user->save();
           $profile->salary = $request->input('salary');
           $profile->save();
            return redirect()->route('employes.index')->with('success','Salario actualizado correctamente');

    }



}
