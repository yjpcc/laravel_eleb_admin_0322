<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth', [
//            'except' => ['logout']
//        ]);
//
//        $this->middleware('guest', [
//            'only' => ['login','store']
//        ]);
//    }

    public function login(){
        if(Auth::user()){
            return view('home');
        }
        return view('session/login');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->remember)){
            return redirect()->route('home')->with('success','登录成功');
        }else{
            return back()->with('danger','用户名或密码错误')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        echo json_encode(['success'=>'success']);
        //return redirect()->route('login')->with('warning','注销成功');
    }
}
