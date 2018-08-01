<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        return view('role/index',compact('roles'));
    }

    public function create()
    {
        $permissions=Permission::all();
        return view('role/create',compact('permissions'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' =>'required|unique:roles',
        ], [
            'name.required' => '角色名不能为空',
            'name.unique' => '角色名已存在',
        ]);

        $role=Role::create(['name'=>$request->name]);
        if($request->permission){
            $role->givePermissionTo($request->permission);
        }
        return redirect()->route('roles.index')->with("success", "添加成功");
    }

    public function edit(Role $role)
    {
        $permissions=Permission::all();
        $myPermissions=$role->permissions;
        return view('role.edit', compact('role','permissions','myPermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' =>['required',Rule::unique('roles')->ignore($role->id)],
        ], [
            'name.required' => '角色名不能为空',
            'name.unique' => '角色名已存在',
        ]);

        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with("success", "修改成功");
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with("success", "删除成功");
    }
}
