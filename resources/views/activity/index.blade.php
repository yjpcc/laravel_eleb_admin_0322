@extends('default')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li><a href="">Home</a></li>
                <li>Article</li>
            </ol>
        </div><!-- /.col-lg-6 -->
        <div class="col-lg-2">
            <form action="{{ route('activitys.index') }}" method="get">
                <div class="input-group">
                    <select class="form-control" name="status">
                            <option value="0" {{ $status==0?'selected':'' }}>全部</option>
                            <option value="1" {{ $status==1?'selected':'' }}>未开始</option>
                            <option value="2" {{ $status==2?'selected':'' }}>进行中</option>
                            <option value="3" {{ $status==3?'selected':'' }}>已结束</option>
                    </select>
                    <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach ($activitys as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('activitys.show',[$activity]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                    <a class="btn btn-warning" href="{{ route('activitys.edit',[$activity]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('activitys.destroy',[$activity]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <a href="{{ route('activitys.create') }}" class="btn btn-success btn-block">添加活动</a>
            </td>
        </tr>
    </table>
    {{ $activitys->appends(['status' => $status])->links() }}
@endsection