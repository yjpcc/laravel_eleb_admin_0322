@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>shop_Category</li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>权限名</th>
            <th>操作</th>
        </tr>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    @can('permission-edit')
                    <a class="btn btn-warning" href="{{ route('permissions.edit',[$permission]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a>
                     @endcan
                    @can('permission-del')
                        <form action="{{ route('permissions.destroy',[$permission]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        @can('permission-del')
        <tr>
            <td colspan="5">
                <a href="{{ route('permissions.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
        @endcan
    </table>
    {{ $permissions->links() }}
@endsection