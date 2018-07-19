@extends('default')
@section('content')
    @include('_errors')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="{{ route('admins.index') }}">Admin</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron">
        <form action="{{ route("editInfo",[$admin]) }}" method="post">
        <p>用户名：<span class="name">{{ $admin->name }}</span></p>
        <p>邮　箱：<span class="email">{{ $admin->email }}</span></p>
        <p>头　像：</p>
        <p><span class="icon"></span><img src="{{ $admin->icon }}" class="img-thumbnail" width="200"></p>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
        <p class="submit">
            <button class="btn btn-info" id="btn1">修改个人资料</button>
        </p>
        </form>
    </div>

@endsection