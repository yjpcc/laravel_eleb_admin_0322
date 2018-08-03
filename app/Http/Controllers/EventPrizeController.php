<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventMember;
use App\Model\EventPrize;
use App\Model\ShopUser;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $eventprizes=EventPrize::paginate(10);
        return view('eventprize/index', compact('eventprizes'));
    }

    public function show(EventPrize $eventprize)
    {

        return view('eventprize/show', compact('eventprize'));
    }

    public function create(Request $request)
    {
        $event=Event::where('is_prize',0)
            ->where('id',$request->id)
            ->first();
        return view('eventprize/create',compact('event'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'events_id' => 'required',
            'name'=>'required',
            'description'=>'required',
            'captcha' => 'required|captcha'
        ], [
            'events_id.required' => '活动名不能为空',
            'name.required' => '奖品名不能为空',
            'description.required' => '奖品描述不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ]);
        $data = $request->all();
        $data['member_id']=0;
        EventPrize::create($data);
        return redirect()->route('eventprizes.index')->with("success", "添加成功");
    }

    public function edit(EventPrize $eventprize)
    {
        $events=Event::all();
        return view('eventprize/edit', compact('eventprize','events'));
    }

    public function update(Request $request,EventPrize $eventprize)
    {

        $this->validate($request, [
            'events_id' => 'required',
            'name'=>'required',
            'description'=>'required',
        ], [
            'events_id.required' => '活动名不能为空',
            'name.required' => '奖品名不能为空',
            'description.required' => '奖品描述不能为空',
        ]);
        $data=$request->all();
        $eventprize->update($data);
        return redirect()->route('eventprizes.index')->with("success", "修改成功");
    }

    public function destroy(EventPrize $eventprize)
    {

        $eventprize->delete();
        return redirect()->route('eventprizes.index')->with("success", "删除成功");
    }


    public function open(Request $request)
    {
        //判断是否开奖
        $event = Event::where('id', $request->id)
            ->where('prize_date', '<', date('Y-m-d H:i:s'))
            ->first();
        if (!$event) {
            return back()->with('danger', '开奖日期未到不能开奖');
        }

        if ($event->is_prize) {
            return back()->with('danger', '该活动已开奖');
        }
        //获得报名商家id
        $eventmembers = EventMember::where('events_id', $request->id)->get(['member_id'])->toArray();
        //获得该活动奖品
        $eventprizes = EventPrize::where('events_id', $request->id)->get()->toArray();
        //打乱顺序
        shuffle($eventmembers);
        shuffle($eventprizes);
        foreach ($eventprizes as $eventprize) {
            $member_id = array_pop($eventmembers);
            if (!$member_id['member_id']) break;
                //修改活动状态
                $event->update(['is_prize' => 1]);
                //将中奖商家写入到奖品表
                EventPrize::find($eventprize['id'])->update($member_id);
                //发送邮件
                $email = ShopUser::where('id', $member_id['member_id'])->first()->email;
                try {
                    \Illuminate\Support\Facades\Mail::send('email-event', ['user' => '1'], function ($message) use ($email) {
                        $message->from('18202840880@163.com', '饿了吧通知');
                        $message->to([$email])->subject('恭喜您已中奖');
                    });
                } catch (\Exception $e) {

                }
        }
        return back()->with('success','开奖成功');
    }
}
