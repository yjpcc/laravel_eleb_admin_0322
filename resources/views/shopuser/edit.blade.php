@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="{{ route('shopusers.index') }}">ShopUser</a></li>
        <li>ShopUser</li>
    </ol>
    <h1 class="text-center">修改账户</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('shopusers.update',[$shopuser]) }}">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">商户名称</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputTitle1" placeholder="分类名" value="{{ $shopuser->name }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $shopuser->email }}">
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
            <input type="checkbox" name="status" value="1" class="checkbox" {{ $shopuser->status?'checked':'' }}>
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
    {{ method_field("PATCH") }}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection
