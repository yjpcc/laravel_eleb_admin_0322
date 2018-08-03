@extends("default")
@section("content")
    @include('vendor.ueditor.assets')
    <ol class="breadcrumb">
        <li>修改抽奖奖品</li>
    </ol>
    <h1 class="text-center">修改抽奖奖品</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('eventprizes.update',[$eventprize]) }}" enctype="multipart/form-data">

    <div class="form-group">
        <label class="col-sm-2 control-label">活动名称</label>
        <div class="col-sm-10">
        <select class="form-control" name="events_id">
            @foreach($events as $event)
                <option value="{{ $event->id }}" {{ $eventprize->events_id==$event->id?'selected':'' }}>{{ $event->title }}</option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">奖品名称</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" placeholder="奖品名称" value="{{ $eventprize->name }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">奖品详情</label>
        <div class="col-sm-10">
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>

            <!-- 编辑器容器 -->
            <script id="container" name="description" type="text/plain">{!! $eventprize->description !!}</script>
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
