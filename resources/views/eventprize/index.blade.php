@extends('default')
@section('content')
            <ol class="breadcrumb">
                <li><a href="">Home</a></li>
                <li>EventPrize</li>
            </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家邮箱</th>
            <th>操作</th>
        </tr>
        @foreach ($eventprizes as $eventprize)
            <tr>
                <td>{{ $eventprize->id }}</td>
                <td>{{ $eventprize->event->title }}</td>
                <td>{{ $eventprize->name }}</td>
                <td>{!! $eventprize->description !!}</td>
                <td>{{ $eventprize->member_id?$eventprize->member->email:'无' }}</td>
                <td>
                    @can('eventprize-show')
                    <a class="btn btn-success" href="{{ route('eventprizes.show',[$eventprize]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                    @endcan
                    @can('eventprize-edit')
                    <a class="btn btn-warning" href="{{ route('eventprizes.edit',[$eventprize]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('eventprizes.destroy',[$eventprize]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {{ $eventprizes->links() }}
@endsection