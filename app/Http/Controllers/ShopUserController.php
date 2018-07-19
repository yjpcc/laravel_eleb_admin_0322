<?php

namespace App\Http\Controllers;

use App\Model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ShopUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $shopusers=ShopUser::paginate(5);
        return view('shopuser/index', compact('shopusers'));
    }

    public function show(ShopUser $shopuser)
    {
        return view('shopuser/show', compact('shopuser'));
    }

//    public function create()
//    {
//        $rows=ShopUser::all();
//        return view('shopuser/create',compact('rows'));
//    }
//
//    public function store(Request $request)
//    {
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:shop_users',
//            'password'=>'required|confirmed',
//            'captcha' => 'required|captcha',
//        ], [
//            'name.required' => '名字不能为空',
//            'email.required' => '邮箱不能为空',
//            'email.email' => '邮箱格式错误',
//            'email.unique' => '邮箱不能重复',
//            'password.required'=>'密码不能为空',
//            'password.confirmed'=>'两次输入的密码不一致',
//            'captcha.required' => '验证码不能为空',
//            'captcha.captcha' => '验证码错误',
//        ]);
//        $data = $request->all();
//        if(!$request->status){
//            $data['status']=0;
//        }
//        ShopUser::create($data);
//        return redirect()->route('shopusers.index')->with("success", "添加成功");
//    }

    public function edit(ShopUser $shopuser)
    {
        //$this->authorize('update',$shopuser);
        return view('shopuser.edit', compact('shopuser'));
    }

    public function update(Request $request, ShopUser $shopuser)
    {
        //$this->authorize('update',$shopuser);
        $this->validate($request, [
            'name' =>['required',Rule::unique('shop_users')->ignore($shopuser->id)],
            'email' =>['required',Rule::unique('shop_users')->ignore($shopuser->id)],
            'password'=>'confirmed',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '名字不能为空',
            'name.unique' => '名字已存在',
            'email.required' => '邮箱不能为空',
            'email.unique' => '邮箱不能重复',
            'password.confirmed'=>'两次输入的密码不一致',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);

        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
        ];
        if($request->password){
            $data['password']=bcrypt($request->password);
        }
        if(!$request->status){
            $data['status']=0;
        }

        $shopuser->update($data);
        return redirect()->route('shopusers.index')->with("success", "修改成功");
    }

    public function destroy(ShopUser $shopuser)
    {
        //$this->authorize('update',$shopuser);
        $shopuser->delete();
        return redirect()->route('shopusers.index')->with("success", "删除成功");
    }

    public function check(ShopUser $shopuser){
            $shopuser->update(['status'=>!$shopuser->status]);
            return redirect()->route('shopusers.index')->with("success", "账号 ".$shopuser->name." 审核成功");


    }
}
