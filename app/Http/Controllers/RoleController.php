<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::all();
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();
      //  return ($request->permissions);
        $permission_set = explode(',',$request->permissions);
       // return($permission_set);
        foreach($permission_set as $permission){
            $permissions = new Permission();
            $permissions->name = $permission;
            $permissions->slug = strtolower(str_replace(" ","-",$permission));
            $permissions->save();
            $role->permissions()->attach($permissions->id);
            $role->save();
        }
        return redirect()->route('roles.index');
        //Here you can pass a msg to view if you want. 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
       // return($request);
       
        $role->name = $request->name;
        $role->slug = $request->slug;
     
        $role->save();
        $role->permissions()->delete();
        $role->permissions()->detach();
        

        $permission_set = explode(',',$request->permissions);
        foreach($permission_set as $permission){
            $permissions = new Permission();
            $permissions->name = $permission;
            $permissions->slug = strtolower(str_replace(" ","-",$permission));
            $permissions->save();
            $role->permissions()->attach($permissions->id);
            $role->save();

        }


        return redirect()->route('roles.index');
        //Here you can pass a msg to view if you want. 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->delete();
        $role->delete();
        $role->permissions()->detach();
        return redirect()->route('roles.index');

    }
}
