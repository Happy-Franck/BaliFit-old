<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('administrateur.permissions.index', [
            'permissions' => $permissions,
        ]);
    }
    public function create(){
    	return view('administrateur.permissions.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Permission::create([
            'name' => $request->name,
        ]);
        return redirect()->route('permissions.index');
    }
    public function edit(Permission $permission){
        $roles = Role::all();
        return view('administrateur.permissions.edit')->with([
        	'permission' => $permission,
        	'roles' => $roles
        ]);
    }
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $permission->name = $request['name'];
        $permission->save();
        return redirect(route('permissions.index'));
    }
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect(route('permissions.index'));
    }
    public function assignRole(Request $request, Permission $permission){
        if($permission->hasRole($request->role)){
            return back();
        }
        $permission->assignRole($request->role);
    	return back();
    }
    public function removeRole(Permission $permission, Role $role){
        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return back();
        }
    	return back();
    }
}
