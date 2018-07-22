@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>添加商户账号</li>
    </ol>
    <h1 class="text-center">添加商户账号</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('shopusers.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">账号名</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" placeholder="账号" value="{{ old('name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" placeholder="密码">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-10">
            <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">状态</label>
        <div class="col-sm-10">
            <input type="checkbox" name="status" value="1" class="checkbox">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">验证码</label>
        <div class="col-sm-10">
            <div class="col-sm-3">
                <input id="captcha" class="form-control" name="captcha"  placeholder="请输入验证码">
            </div>
            <div class="col-sm-9">
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            </div>
        </div>
    </div>

    {{ csrf_field() }}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection
