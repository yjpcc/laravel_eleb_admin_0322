<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventMember;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $status=$request->status;
        if($status==1){
            $events=event::where('signup_start','>',date('Y-m-d H:i:s'))
                ->paginate(10);
        }elseif ($status==2){
            $events=event::where('signup_start','<=',date('Y-m-d H:i:s'))
                ->where('signup_end','>=',date('Y-m-d H:i:s'))
                ->paginate(10);
        }elseif($status==3){
            $events=event::where('signup_end','<',date('Y-m-d H:i:s'))
                ->paginate(10);
        }elseif($status==4){
            $events=event::where('is_prize',1)
                ->paginate(10);
        }else{
            $events=event::paginate(10);
        }
        return view('event/index', compact('events','status'));
    }

    public function show(Event $event)
    {
        $signup_sum=EventMember::where('events_id',$event->id)->count();
        return view('event/show', compact('event','signup_sum'));
    }

    public function create()
    {
        return view('event/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'signup_start'=>'required|after:now',
            'signup_end'=>'required|after:signup_start',
            'prize_date'=>'required|after:signup_end',
            'signup_num'=>'required|regex:/^\d/',
            'content'=>'required',
        ], [
            'title.required' => '名字不能为空',
            'signup_start.required' => '开始时间不能为空',
            'signup_start.after' => '开始时间不能小于当前时间',
            'signup_end.required' => '结束时间不能为空',
            'signup_end.after' => '结束时间不能小于开始时间',
            'prize_date.required' => '开奖日期不能为空',
            'prize_date.after' => '开奖日期不能小于结束时间',
            'signup_num.required' => '报名人数限制不能为空',
            'signup_num.regex' => '报名人数不能小于0',
            'content.required' => '活动详情不能为空',
        ]);
        $data = $request->all();
        $data['is_prize']=0;
        Event::create($data);
        return redirect()->route('events.index')->with("success", "添加成功");
    }

    public function edit(Event $event)
    {
        //$this->authorize('update',$event);
        return view('event.edit', compact('event'));
    }

    public function update(Request $request,Event $event)
    {

        //  $this->authorize('update',$event);
        $this->validate($request, [
            'title' => 'required',
            'signup_start'=>'required',
            'signup_end'=>'required|after:signup_start',
            'prize_date'=>'required|after:signup_end',
            'signup_num'=>'required|regex:/^\d/',
            'content'=>'required',
        ], [
            'title.required' => '名字不能为空',
            'signup_start.required' => '开始时间不能为空',
            'signup_end.required' => '结束时间不能为空',
            'signup_end.after' => '结束时间不能小于开始时间',
            'prize_date.required' => '开奖日期不能为空',
            'prize_date.after' => '开奖日期不能小于结束时间',
            'signup_num.required' => '报名人数限制不能为空',
            'signup_num.regex' => '报名人数不能小于0',
            'content.required' => '活动详情不能为空',
        ]);
        $data=$request->all();
        $event->update($data);
        return redirect()->route('events.index')->with("success", "修改成功");
    }

    public function destroy(Event $event)
    {
        //$this->authorize('update',$event);
        $event->delete();
        return redirect()->route('events.index')->with("success", "删除成功");
    }
}
