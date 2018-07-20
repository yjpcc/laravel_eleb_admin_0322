@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Menu_Category</li>
    </ol>
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
@endsection