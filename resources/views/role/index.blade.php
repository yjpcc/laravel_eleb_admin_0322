@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Role</li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>角色名</th>
            <th>权限</th>
            <th>操作</th>
        </tr>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach($role->permissions as $key=>$permission)
                        {{ $permission->name }},
                        @if($key==4)
                            ······
                            @break
                        @endif
                    @endforeach
                </td>
                <td>
                    @can('role-edit')
                    <a class="btn btn-warning" href="{{ route('roles.edit',[$role]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a>
                     @endcan
                    @can('role-del')
                        <form action="{{ route('roles.destroy',[$role]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        @can('role-create')
        <tr>
            <td colspan="5">
                <a href="{{ route('roles.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
         @endcan
    </table>
@endsection