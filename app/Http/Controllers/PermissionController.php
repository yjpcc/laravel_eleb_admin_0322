<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions=Permission::paginate(8);
        return view('permission/index',compact('permissions'));
    }

    public function create()
    {
        return view('permission/create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' =>'required|unique:permissions',
        ], [
            'name.required' => '权限名不能为空',
            'name.unique' => '权限名已存在',
        ]);

        Permission::create(['name'=>$request->name]);

        return redirect()->route('permissions.index')->with("success", "添加成功");
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' =>['required',Rule::unique('permissions')->ignore($permission->id)],
        ], [
            'name.required' => '权限名不能为空',
            'name.unique' => '权限名已存在',
        ]);

        $permission->update(['name'=>$request->name]);

        return redirect()->route('permissions.index')->with("success", "修改成功");
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with("success", "删除成功");
    }
}
