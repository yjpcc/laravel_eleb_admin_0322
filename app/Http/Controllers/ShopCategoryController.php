<?php

namespace App\Http\Controllers;

use App\Model\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $shopcategorys=ShopCategory::paginate(10);
        return view('shopcategory/index', compact('shopcategorys'));
    }

    public function show(ShopCategory $shopcategory)
    {
        return view('shopcategory/show', compact('shopcategory'));
    }

    public function create()
    {
        $rows=ShopCategory::all();
        return view('shopcategory/create',compact('rows'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
//            'captcha' => 'required|captcha',
        ], [
            'name.required' => '名字不能为空',
//            'captcha.required' => '验证码不能为空',
//            'captcha.captcha' => '验证码错误',
        ]);
        $data = $request->all();
        if(!$request->status){
            $data['status']=0;
        }
        ShopCategory::create($data);
        session()->flash("success", "添加成功");
        return redirect()->route('shopcategorys.index');
    }

    public function edit(ShopCategory $shopcategory)
    {
        //$this->authorize('update',$shopcategory);
        return view('shopcategory.edit', compact('shopcategory'));
    }

    public function update(Request $request, ShopCategory $shopcategory)
    {

        //$this->authorize('update',$shopcategory);
        $this->validate($request, [
            'name' => 'required|max:10',
//            'captcha' => 'required|captcha',
        ], [
            'name.required' => '名字不能为空',
            'name.max' => '名字不能大于10个字',
//            'captcha.required' => '验证码不能为空',
//            'captcha.captcha' => '验证码错误',
        ]);

        $data = $request->all();

        $shopcategory->update($data);
        session()->flash("success", "修改成功");
        return redirect()->route('shopcategorys.index');
    }

    public function destroy(ShopCategory $shopcategory)
    {
        //$this->authorize('update',$shopcategory);
        $shopcategory->delete();
        session()->flash("success", "删除成功");
        return redirect()->route('shopcategorys.index');
    }
}
