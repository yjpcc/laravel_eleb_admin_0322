@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Nav</li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>菜单名</th>
            <th>地址</th>
            <th>关联权限</th>
            <th>上级菜单</th>
            <th>操作</th>
        </tr>
        @foreach ($navs as $nav)
            <tr>
                <td>{{ $nav->id }}</td>
                <td>{{ $nav->name }}</td>
                <td>{{ $nav->url }}</td>
                <td>{{ $nav->permission?$nav->permission->name:'0'}}</td>
                <td>{{ $nav->pid?\App\Model\Nav::find($nav->pid)->name:'顶级菜单' }}</td>
                <td>
                @can('nav-edit')
                    <a class="btn btn-warning" href="{{ route('navs.edit',[$nav]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a>
                @endcan
                @can('nav-del')
                        <form action="{{ route('navs.destroy',[$nav]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                @endcan

                </td>
            </tr>
        @endforeach
        @can('nav-create')
        <tr>
            <td colspan="6">
                <a href="{{ route('navs.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
        @endcan
    </table>
    {{ $navs->links() }}
@endsection