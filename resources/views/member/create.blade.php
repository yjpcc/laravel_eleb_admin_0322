@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="{{ route('members.index') }}">Member</a></li>
        <li>Create</li>
    </ol>
    <h1 class="text-center">会员添加</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('members.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        <label  class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-10">
            <input type="text" name="username" class="form-control"  placeholder="用户名" value="{{ old('username') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-sm-2 control-label">电话号码</label>
        <div class="col-sm-10">
            <input type="number" name="tel" class="form-control" placeholder="电话号码" value="{{ old('tel') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" placeholder="密码" value="{{ old('password') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-10">
            <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">头像</label>
        <div class="col-sm-10">
            <input type="file" name="members_img">
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
