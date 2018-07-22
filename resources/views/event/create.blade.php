@extends("default")
@section("content")
    @include('vendor.ueditor.assets')
    <ol class="breadcrumb">
        <li>添加抽奖活动</li>
    </ol>
    <h1 class="text-center">添加抽奖活动</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('events.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">活动名称</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="inputTitle1" placeholder="活动名称" value="{{ old('title') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">报名开始时间</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="signup_start" class="form-control" value="{{ old('signup_start') }}">
        </div>
    </div>


    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">报名结束时间</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="signup_end" class="form-control"  value="{{ old('signup_end') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">开奖日期</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="prize_date" class="form-control" placeholder="结束时间" value="{{ old('prize_date') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">报名人数限制</label>
        <div class="col-sm-10">
            <input type="number" name="signup_num" class="form-control" value="{{ old('signup_num') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">活动详情</label>
        <div class="col-sm-10">
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>

            <!-- 编辑器容器 -->
            <script id="container" name="content" type="text/plain">{{ old('content') }}</script>
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
