<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserPermissionsController extends Controller
{
      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);
        return back()->with('flash','Los permisos han sido actualizados') ;
    }
}
