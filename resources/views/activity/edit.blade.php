@extends("default")
@section("content")
    @include('vendor.ueditor.assets')
    <ol class="breadcrumb">
        <li>修改活动</li>
    </ol>
    <h1 class="text-center">修改活动</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('activitys.update',[$activity]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">活动名称</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="inputTitle1" placeholder="活动名称" value="{{ $activity->title }}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">开始时间</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="start_time" class="form-control" placeholder="开始时间" value="{{ date('Y-m-d\TH:i:s',strtotime($activity->start_time)) }}">
        </div>
    </div>


    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">结束时间</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="end_time" class="form-control" placeholder="结束时间" value="{{ date('Y-m-d\TH:i:s',strtotime($activity->end_time)) }}">
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
            <script id="container" name="content" type="text/plain">{!! $activity->content !!}</script>
        </div>
    </div>

    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection
