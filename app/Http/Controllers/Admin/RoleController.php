<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('administrateur.roles.index', [
            'roles' => $roles,
        ]);
    }
    public function create(){
        return view('administrateur.roles.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Role::create([
            'name' => $request->name,
        ]);
        return redirect()->route('roles.index');
    }
    public function edit(Role $role){
        $permissions = Permission::all();
        return view('administrateur.roles.edit')->with([
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $role->name = $request['name'];
        $role->save();
        return redirect(route('roles.index'));
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('roles.index'));
    }
    public function givePermission(Request $request, Role $role){
        if($role->hasPermissionTo($request->permission)){
            return back();
        }
        $role->givePermissionTo($request->permission);
        return back();
    }
    public function revokePermission(Role $role, Permission $permission){
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back();
        }
        return back();
    }
}
