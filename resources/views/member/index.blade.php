@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Member</li>
    </ol>
    @include('_errors')
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>会员头像</th>
            <th>会员名</th>
            <th>电话号码</th>
            <th>操作</th>
        </tr>
        @foreach ($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td><img class="img-circle" src="{{ $member->members_img }}" width="80"></td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td><a class="btn btn-success" href="{{ route('members.show',[$member]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a> <a class="btn btn-warning" href="{{ route('members.edit',[$member]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('members.destroy',[$member]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="8">
                <a href="{{ route('members.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
    </table>
    {{ $members->links() }}
@endsection