<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function role(){
        $permission = Permission::all();
        $roles = Role::all();
        return view('backend.role.role',[
            'permission'=>$permission,
            'roles'=>$roles,
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
}
