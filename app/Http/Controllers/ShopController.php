<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\ShopCategory;
use App\Model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $shops=Shop::paginate(5);
        return view('shop/index', compact('shops'));
    }

    public function show(Shop $shop)
    {
        return view('shop/show', compact('shop'));
    }

    public function create()
    {
        $categorys=ShopCategory::all();
        return view('shop/create',compact('categorys'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:shop_users',
            'email' => 'required|email|unique:shop_users',
            'password'=>'required|confirmed',
            'shop_name'=>'required',
            'shop_category_id'=>'required',
            'shop_img'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => '名字不能为空',
            'name.unique' => '名字已存在',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式错误',
            'email.unique' => '邮箱不能重复',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次输入的密码不一致',
            'shop_name.required' => '店铺名称不能为空',
            'shop_category_id.required' => '店铺分类不能为空',
            'shop_img.required' => '店铺图片不能为空',
            'start_send.required' => '起送金额不能为空',
            'send_cost.required' => '配送费不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);

        $data = $request->all();
        $data['status']=1;
        $data['password']=bcrypt($request->password);
        if(!$request->shop_rating){
            $data['shop_rating']=0;
        }
        if(!$request->notice){
            $data['notice']='';
        }

        if(!$request->discount){
            $data['discount']='';
        }

        DB::beginTransaction();
            try{
                Shop::create($data);
                $data['shop_id']=DB::getPdo()->lastInsertId();
                ShopUser::create($data);
                DB::commit();
                session()->flash("success", "添加成功");
                return redirect()->route('shops.index');
            }catch (\Exception $e){
                DB::rollBack();
                session()->flash("success", "添加失败");
                return back()->withInput();
            }
    }

    public function edit(Shop $shop)
    {
        //$this->authorize('update',$shop);
        $categorys=ShopCategory::all();
        return view('shop.edit', compact('shop','categorys'));
    }

    public function update(Request $request, Shop $shop)
    {

        //$this->authorize('update',$shop);
        $this->validate($request, [
            'shop_name'=>'required',
            'shop_category_id'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
//            'captcha' => 'required|captcha',
        ], [
            'shop_name.required' => '店铺名称不能为空',
            'shop_category_id.required' => '店铺分类不能为空',
            'start_send.required' => '起送金额不能为空',
            'send_cost.required' => '配送费不能为空',
//            'captcha.required' => '验证码不能为空',
//            'captcha.captcha' => '验证码错误',
        ]);

        $data=[
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
        ];

        $request->brand?$data['brand']=1:$data['brand']=0;

        $request->on_time?$data['on_time']=1:$data['on_time']=0;

        $request->fengniao?$data['fengniao']=1:$data['fengniao']=0;

        $request->bao?$data['bao']=1:$data['bao']=0;

        $request->piao?$data['piao']=1:$data['piao']=0;

        $request->zhun?$data['zhun']=1:$data['zhun']=0;

        if($request->notice){
            $data['notice']=$request->notice;
        }

        if($request->discount){
            $data['discount']=$request->discount;
        }

        if($request->shop_rating){
            $data['shop_rating']=$request->shop_rating;
        }
            $shop->update($data);

            return redirect()->route('shops.index')->with("success", "修改成功");
    }

    public function destroy(Shop $shop)
    {
        //$this->authorize('update',$shop);
        $shop->update(['status'=>-1]);
        $shop->shop_user->update(['status'=>0]);
        return redirect()->route('shops.index')->with("success", "删除成功");
    }

    public function check(Request $request,Shop $shop){

        DB::beginTransaction();
        try{
            if($request->check==1){
                $shop->update(['status'=>!$shop->status]);
                $shop->shop_user->update(['status'=>1]);
            }elseif ($request->check==-1){
                $shop->update(['status'=>-1]);
                $shop->shop_user->update(['status'=>0]);
            }elseif($request->check==2){
                $shop->update(['status'=>1]);
                $shop->shop_user->update(['status'=>1]);
            }else{
                $shop->update(['status'=>-1]);
                $shop->shop_user->update(['status'=>0]);
            }
            DB::commit();
            return redirect()->route('shops.index')->with("success", "商家 ".$shop->shop_name." 审核成功");
        }catch (\Exception $e){
            DB::rollBack();
            return back()->withInput()->with("success", "审核失败");
        }

    }
}
