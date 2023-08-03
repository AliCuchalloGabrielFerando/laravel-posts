<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Events\UserCreated;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::allowed()->get();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',new User);
        $user = new User;
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.users.create',compact('user','roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('store',new User);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $data['password'] = Str::random(8);
        $user = User::create($data);

        $user->assignRole($request->roles);

        $user->givePermissionTo($request->permissions);

        UserCreated::dispatch($user,$data['password']);

        return redirect()->route('admin.users.index')->with('flash','El usuario ha sido creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view',$user);
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.users.edit',compact('user','roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( User $user,UpdateUserRequest $request)
    {


        $this->authorize('update',$user);
        //dd($request->validated());
        $user->update($request->validated());

        return redirect()->route('admin.users.edit',$user)->with('flash','Usuario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete',$user);

        $user->delete(); 

        return redirect()->route('admin.users.index')->with('flash','Usuario Eliminado');
    }
}
