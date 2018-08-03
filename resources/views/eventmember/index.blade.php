@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>活动</th>
            <th>商家邮箱</th>
            {{--<th>操作</th>--}}
        </tr>
        @foreach ($eventmembers as $eventmember)
            <tr>
                <td>{{ $eventmember->id }}</td>
                <td>{{ $eventmember->event->title}}</td>
                <td>{{ $eventmember->shop->email }}</td>
                {{--<td>--}}

                    {{--<a class="btn btn-warning" href="{{ route('eventmembers.edit',[$eventmember]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a>--}}

                    {{--<form action="{{ route('eventmembers.destroy',[$eventmember]) }}" method="post" style="display: inline">--}}
                        {{--{{ method_field('DELETE') }}--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>--}}
                    {{--</form>--}}

                {{--</td>--}}
            </tr>
        @endforeach
        {{--<tr>--}}
            {{--<td colspan="5">--}}
                {{--<a href="{{ route('eventmembers.create') }}" class="btn btn-success btn-block">添加</a>--}}
            {{--</td>--}}
        {{--</tr>--}}

    </table>
@endsection