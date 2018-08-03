<?php

namespace App\Http\Controllers;

use App\Model\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $navs=Nav::paginate(10);
        return view('nav/index', compact('navs'));
    }

    public function show(nav $nav)
    {
        return view('nav/show', compact('nav'));
    }

    public function create()
    {
        $navs=Nav::where('pid',0)->get();
        $permissions=Permission::all();
        return view('nav/create',compact('navs','permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'pid' => 'required',
            'url' => 'required',
            'permission_id' => 'required',
        ], [
            'name.required' => '名字不能为空',
            'pid.required' => '上级菜单不能为空',
            'url.required' => '地址不能为空',
            'permission_id.required' => '权限不能为空',
        ]);
        $data = $request->all();
        Nav::create($data);
        return redirect()->route('navs.index')->with("success", "添加成功");
    }

    public function edit(Nav $nav)
    {
        $pids=Nav::where('pid',0)->get();
        $permissions=Permission::all();
        return view('nav.edit', compact('nav','pids','permissions'));
    }

    public function update(Request $request, Nav $nav)
    {

        $this->validate($request, [
            'name' => 'required',
            'pid' => 'required',
            'url' => 'required',
            'permission_id' => 'required',
        ], [
            'name.required' => '名字不能为空',
            'pid.required' => '上级菜单不能为空',
            'url.required' => '地址不能为空',
            'permission_id.required' => '权限不能为空',
        ]);
        if($nav->id==$request->pid){
            return back()->with('danger','父id不能为自己');
        }
        $data = $request->all();
        $nav->update($data);
        return redirect()->route('navs.index')->with("success", "修改成功");
    }

    public function destroy(Nav $nav)
    {
        if(Nav::where(['pid'=>$nav->id])->count()>0){
            session()->flash("success", "该菜单有子菜单不能删除");
        }else{
            $nav->delete();
            session()->flash("success", "删除成功");
        }
        return redirect()->route('navs.index')->with("success", "删除成功");
    }
}
