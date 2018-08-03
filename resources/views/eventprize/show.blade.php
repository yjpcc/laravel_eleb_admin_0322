@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">EventPrize</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron">
            <h1 class="text-center">{{ $eventprize->name }}</h1>
        <p>奖品名称:{{ $eventprize->event->title }}</p>
        <p>奖品详情:</p>
        <p>{!! $eventprize->description !!}</p>
        <p>中奖商家:{{ $eventprize->member_id?$eventprize->member->email:'无' }}</p>
    </div>

@endsection