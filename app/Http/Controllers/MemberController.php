<?php

namespace App\Http\Controllers;

use App\Model\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $members=Member::paginate(5);
        return view('member/index',compact('members'));
    }

    public function show(Member $member){
        return view('member/show',compact('member'));
    }

    public function create()
    {
        return view('member/create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'username' =>'required|unique:members',
            'tel' => 'required|unique:members|regex:/^1\d{10}$/',
            'password'=>'required|confirmed',
            'captcha' => 'required|captcha',
        ], [
            'username.required' => '用户名不能为空',
            'username.unique' => '用户名已存在',
            'tel.required' => '电话不能为空',
            'tel.unique' => '该号码已被注册',
            'tel.regex' => '请输入正确的号码',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次输入的密码不一致',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);

        $data = $request->all();
        $data['password']=bcrypt($request->password);

        $data = $request->all();
        if ($request->members_img) {
            $result=$request->members_img->store('public/members_img');
            if ($result) {
                $data['members_img'] = url(Storage::url($result));
            }
        }

        Member::create($data);

        return redirect()->route('members.index')->with("success", "添加成功");
    }

    public function edit(Member $member)
    {
        // $this->authorize('update',$member);
        return view('member.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {

        // $this->authorize('update',$member);
        $this->validate($request, [
            'username' =>['required',Rule::unique('members')->ignore($member->id)],
            'tel' =>['required',Rule::unique('members')->ignore($member->id),'regex:/^1\d{10}$/'],
//            'captcha' => 'required|captcha',
        ], [
            'name.required' => '用户名不能为空',
            'name.unique' => '用户名已存在',
            'tel.required' => '电话不能为空',
            'tel.unique' => '该号码已存在',
            'tel.regex' => '请输入正确的号码',
//            'captcha.required' => '验证码不能为空',
//            'captcha.captcha' => '验证码错误',
        ]);


        $data = $request->all();
        if ($request->members_img) {
            $result=$request->members_img->store('public/members_img');
            if ($result) {
                $data['members_img'] = url(Storage::url($result));
            }
        }
        $member->update($data);

        return redirect()->route('members.index')->with("success", "修改成功");
    }

    public function destroy(Member $member)
    {
        //$this->authorize('update',$member);
        $member->delete();
        return redirect()->route('members.index')->with("success", "删除成功");
    }
}
