<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class RoleController extends Controller
{
    public function assignRole(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        if ($request['role_manager']) {
            $user->roles()->attach(Role::where('name', 'Manager')->first());
        }
        if ($request['role_dealer']) {
            $user->roles()->attach(Role::where('name', 'Dealer')->first());
        }
        if ($request['role_viewer']) {
            $user->roles()->attach(Role::where('name', 'Viewer')->first());
        }
        if ($request['role_customer']) {
            $user->roles()->attach(Role::where('name', 'Customer')->first());
        }

        return redirect()->back();
    }

}