@extends('default')
@section('content')
    @include('_errors')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="{{ route('members.index') }}">Member</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron">
        <p>用户名：{{ $member->username }}</p>
        <p>电　话：{{ $member->tel }}</p>
        <p>头　像：</p>
        <p><img src="{{ $member->members_img }}" class="img-thumbnail" width="200"></p>
    </div>

@endsection