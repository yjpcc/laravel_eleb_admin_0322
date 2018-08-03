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
            <form action="{{ route('events.index') }}" method="get">
                <div class="input-group">
                    <select class="form-control" name="status">
                            <option value="0" {{ $status==0?'selected':'' }}>全部</option>
                            <option value="1" {{ $status==1?'selected':'' }}>未开始</option>
                            <option value="2" {{ $status==2?'selected':'' }}>进行中</option>
                            <option value="3" {{ $status==3?'selected':'' }}>已结束</option>
                            <option value="4" {{ $status==4?'selected':'' }}>已开奖</option>
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
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->signup_start }}</td>
                <td>{{ $event->signup_end }}</td>
                <td>{{ $event->prize_date }}</td>
                <td>{{ $event->signup_num }}</td>
                <td><sapn  class="btn-sm {{ $event->is_prize?'btn-warning':'btn-success' }}">{{ $event->is_prize?'已开奖':'未开奖' }}</sapn></td>
                <td>
                    @can('event-show')
                    <a class="btn btn-success" href="{{ route('events.show',[$event]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                    @endcan
                    @can('event-edit')
                    <a class="btn btn-warning" href="{{ route('events.edit',[$event]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('events.destroy',[$event]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                    @endcan
                        @if(!$event->is_prize)
                        <a href="{{ route('eventprizes.create',['id'=>$event->id]) }}" class="btn btn-success">添加奖品</a>
                            @endif
                </td>
            </tr>
        @endforeach
        @can('event-create')
        <tr>
            <td colspan="9">
                <a href="{{ route('events.create') }}" class="btn btn-success btn-block">添加活动</a>
            </td>
        </tr>
        @endcan
    </table>
    {{ $events->appends(['status' => $status])->links() }}
@endsection