<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        return back()->with('flash','Los roles han sido actualizados') ;
    }

}
