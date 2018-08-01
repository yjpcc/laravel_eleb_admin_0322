@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>Shop_User</li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>账户名</th>
            <th>邮箱</th>
            <th>所属商家</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach ($shopusers as $shopuser)
            <tr>
                <td>{{ $shopuser->id }}</td>
                <td>{{ $shopuser->name }}</td>
                <td>{{ $shopuser->email }}</td>
                <td>{{ $shopuser->shop->shop_name }}</td>
                <td>
                    <a href="{{ route('checkuser',[$shopuser]) }}" class="btn-sm {{ $shopuser->status?'btn-success':'btn-danger' }}">{{ $shopuser->status?'启用':'禁用' }}</a>
                </td>
                <td>
                    @can('shopuser-show')
                    <a class="btn btn-warning" href="{{ route('shopusers.edit',[$shopuser]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a>
                     @endcan
                    @can('shopuser-del')
                        <form action="{{ route('shopusers.destroy',[$shopuser]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                     @endcan
                </td>
            </tr>
        @endforeach
        @can('shopuser-create')
        <tr>
            <td colspan="6">
                <a href="{{ route('shopusers.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
          @endcan
    </table>
    {{ $shopusers->links() }}
@endsection