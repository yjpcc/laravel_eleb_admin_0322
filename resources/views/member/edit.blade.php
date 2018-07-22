@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="{{ route('members.index') }}">Member</a></li>
        <li>Member_Edit</li>
    </ol>
    <h1>用户修改</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('members.update',[$member]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">会员名</label>
        <div class="col-sm-10">
            <input type="text" name="username" class="form-control"  placeholder="会员名" value="{{ $member->username  }}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-sm-2 control-label">电话号码</label>
        <div class="col-sm-10">
            <input type="number" name="tel" class="form-control" placeholder="电话号码" value="{{ $member->tel }}" >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">头像</label>
        <div class="col-sm-10">
            <input type="file" name="members_img">
            <img class="thumbnail img-responsive" src="{{ $member->members_img }}" width="200" />
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
            <button type="submit" class="btn btn-primary btn-lg btn-block">修改</button>
        </div>
    </div>
</form>
@endsection
