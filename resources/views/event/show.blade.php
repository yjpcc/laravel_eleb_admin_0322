@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">Event</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron">
            <h1 class="text-center">{{ $event->title }}</h1>
        <p>活动详情:</p>
        <p>{!! $event->content !!}</p>
        <p>开始时间:{{ $event->signup_start }}</p><br>
        <p>结束时间:{{ $event->signup_end }}</p>
        <p>开奖日期:{{ $event->prize_date }}</p>
        <p>报名人数限制:{{ $event->signup_num }}</p>
        <p>当前报名人数:{{ $signup_sum }}</p>
        <p>是否已开奖:<sapn  class="btn-sm {{ $event->is_prize?'btn-warning':'btn-success' }}">{{ $event->is_prize?'已开奖':'未开奖' }}</sapn>
        @if(strtotime($event->signup_start)<=time())
        <p>
            @if($event->is_prize)
                <a class="btn btn-success" href="{{ route('eventprizes.index') }}">查看抽奖结果</a>
            @elseif(strtotime($event->prize_date)<time())
                <a class="btn btn-info" href="{{ route('eventmembers.signup',['id'=>$event->id]) }}">查看报名名单</a>
                <a class="btn btn-success" href="{{ route('open',['id'=>$event->id]) }}">开奖</a>
            @else
                <a class="btn btn-info" href="{{ route('eventmembers.signup',['id'=>$event->id]) }}">查看报名名单</a>
            @endif
        </p>
        @endif
    </div>

@endsection