<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $status=$request->status;
        if($status==1){
            $activitys=Activity::where('start_time','>',date('Y-m-d H:i:s'))
                ->paginate(10);
        }elseif ($status==2){
            $activitys=Activity::where('start_time','<=',date('Y-m-d H:i:s'))
                ->where('end_time','>=',date('Y-m-d H:i:s'))
                ->paginate(10);
        }elseif($status==3){
            $activitys=Activity::where('end_time','<',date('Y-m-d H:i:s'))
                ->paginate(10);
        }else{
        $activitys=Activity::paginate(10);
    }
        return view('activity/index', compact('activitys','status'));
    }

    public function show(Activity $activity)
    {
        dd($activity);
        return view('activity/show', compact('activity'));
    }

    public function create()
    {
        return view('activity/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content'=>'required',
            'start_time'=>'required|after:now',
            'end_time'=>'required|after:start_time',
            'captcha' => 'required|captcha',
        ], [
            'title.required' => '名字不能为空',
            'content.required' => '描述不能为空',
            'start_time.required' => '开始时间不能为空',
            'start_time.after' => '开始时间不能小于当前时间',
            'end_time.required' => '结束时间不能为空',
            'end_time.after' => '结束时间不能小于开始时间',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);

        $data = $request->all();
        Activity::create($data);
        return redirect()->route('activitys.index')->with("success", "添加成功");
    }

    public function edit(Activity $activity)
    {
        //$this->authorize('update',$activity);
        return view('activity.edit', compact('activity'));
    }

    public function update(Request $request,Activity $activity)
    {

        //  $this->authorize('update',$activity);
        $this->validate($request, [
            'title' => 'required',
            'content'=>'required',
            'start_time'=>'required|after:now',
            'end_time'=>'required|after:start_time',
        ], [
            'title.required' => '名字不能为空',
            'content.required' => '描述不能为空',
            'start_time.required' => '开始时间不能为空',
            'start_time.after' => '开始时间不能小于当前时间',
            'end_time.required' => '结束时间不能为空',
            'end_time.after' => '结束时间不能小于开始时间',
        ]);
        $data=$request->all();
        $activity->update($data);
        return redirect()->route('activitys.index')->with("success", "修改成功");
    }

    public function destroy(Activity $activity)
    {
        //$this->authorize('update',$activity);
        $activity->delete();
        return redirect()->route('activitys.index')->with("success", "删除成功");
    }
}
