<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index',[
            'roles'=>Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create',[
            'permissions'=>Permission::pluck('name','id'),
            'role'=> new Role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveRoleRequest $request)
    {
       
        $role = Role::create($request->validated());

        $role->givePermissionTo($request->permissions);

        return redirect()->route('admin.roles.index')->with('flash','El role fue creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        
        return view('admin.roles.edit',[
            'permissions'=>Permission::pluck('name','id'),
            'role'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveRoleRequest $request, Role $role)
    {
   
        $role->update($request->validated());

        $role->givePermissionTo($request->permissions);

        return redirect()->route('admin.roles.edit',$role)->with('flash','El role fue actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Gate::authorize('delete',$role);

        $role->delete();

        return redirect()->route('admin.roles.index')->with('flash','El role fue eliminado');
    }
}
