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
        </tr>
        @foreach ($eventmembers as $eventmember)
            <tr>
                <td>{{ $eventmember->id }}</td>
                <td>{{ $eventmember->event->title}}</td>
                <td>{{ $eventmember->shop->email }}</td>

            </tr>
        @endforeach

    </table>
@endsection