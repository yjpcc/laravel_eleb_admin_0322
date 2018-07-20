<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admins=Admin::paginate(5);
        return view('admin/index',compact('admins'));
    }

    public function show(Admin $admin){
        return view('admin/show',compact('admin'));
    }

    public function create()
    {
        return view('admin/create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' =>'required|unique:admins',
            'email' => 'required|email|unique:admins',
            'password'=>'required|confirmed',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '用户名不能为空',
            'name.unique' => '用户名已存在',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式错误',
            'email.unique' => '邮箱不能重复',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次输入的密码不一致',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);

        $data = $request->all();
        $data['password']=bcrypt($request->password);

        if ($request->icon) {
            $result=$request->icon->store('public/icon');
            if ($result) {
                $data['icon'] = url(Storage::url($result));
            }
        }

        Admin::create($data);

        return redirect()->route('admins.index')->with("success", "添加成功");
    }

    public function edit(Admin $admin)
    {
       // $this->authorize('update',$admin);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {

       // $this->authorize('update',$admin);
        $this->validate($request, [
            'name' =>['required',Rule::unique('admins')->ignore($admin->id)],
            'email' =>['required',Rule::unique('admins')->ignore($admin->id)],
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '用户名不能为空',
            'name.unique' => '用户名已存在',
            'email.required' => '邮箱不能为空',
            'email.unique' => '邮箱不能重复',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);


        $data = $request->all();
        if ($request->icon) {
            $result=$request->icon->store('public/icon');
            if ($result) {
                $data['icon'] = url(Storage::url($result));
            }
        }
        $admin->update($data);

        return redirect()->route('admins.index')->with("success", "修改成功");
    }

    public function destroy(Admin $admin)
    {
        //$this->authorize('update',$admin);
        $admin->delete();
        return redirect()->route('admins.index')->with("success", "删除成功");
    }

    public function editInfo(Request $request,admin $admin){
        $this->authorize('update',$admin);
        $this->validate($request, [
            'name' =>['required',Rule::unique('admins')->ignore($admin->id)],
        ], [
            'name.required' => '用户名不能为空',
            'name.unique' => '用户名已存在',
        ]);

        $data = [
            'name'=>$request->name,
        ];
        if ($request->icon) {
            $result=$request->icon->store('public/icon');
            if ($result) {
                $data['icon'] = url(Storage::url($result));
            }
        }
        $admin->update($data);
        return redirect()->route('admins.show',[$admin])->with("success", "修改成功");
    }

    public function editPwd(Request $request,Admin $admin)
    {
        $this->authorize('update',$admin);
        $this->validate($request, [
            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ], [
            'password.required'=>'新密码不能为空',
            'password.confirmed'=>'两次输入的密码不一致',
        ]);

        if (Hash::check($request->oldpassword, $admin->password)) {
            $admin->update(['password'=>bcrypt($request->password)]);
            return redirect()->route('admins.show',[$admin])->with('success','修改成功');
        }else{
            return redirect()->route('admins.show',[$admin])->with('danger','密码错误')->withInput();
        }
    }
}