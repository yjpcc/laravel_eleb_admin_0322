@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="{{ route('admins.index') }}">Admin</a></li>
        <li>Admin_Edit</li>
    </ol>
    <h1>用户修改</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('admins.update',[$admin]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputTitle1" placeholder="用户名" value="{{ $admin->name  }}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $admin->email }}" >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">头像</label>
        <div class="col-sm-10">
            <input type="file" name="icon">
            <img class="thumbnail img-responsive" src="{{ $admin->icon }}" width="200" />
        </div>
    </div>

    {{--<div class="form-group">--}}
        {{--<label class="col-sm-2 control-label">验证码</label>--}}
        {{--<div class="col-sm-10">--}}
            {{--<div class="col-sm-3">--}}
                {{--<input id="captcha" class="form-control" name="captcha"  placeholder="请输入验证码">--}}
            {{--</div>--}}
            {{--<div class="col-sm-9">--}}
                {{--<img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection
