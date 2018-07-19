@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Admin</li>
    </ol>
    @include('_errors')
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>用户头像</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td><img class="img-circle" src="{{ $admin->icon }}" width="80"></td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td><a class="btn btn-success" href="{{ route('admins.show',[$admin]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a> <a class="btn btn-warning" href="{{ route('admins.edit',[$admin]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('admins.destroy',[$admin]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="8">
                <a href="{{ route('admins.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
    </table>
    {{ $admins->links() }}
@endsection