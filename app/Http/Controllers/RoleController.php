<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
Use App\Models\User;

class RoleController extends Controller
{
    function role(){
        $permission = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('backend.role.role',[
            'permission'=>$permission,
            'roles'=>$roles,
            'users'=>$users,
        ]);
    }
    function create_permission(Request $request){
         Permission::create(['name' => $request->permission]);
         return back();
    }
    function add_role(Request $request){
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);
        return back();
    }
    function assign_role(Request $request){
    $user = User::find($request->user);
    $user -> assignRole($request->role);
    return back();
    }
}
