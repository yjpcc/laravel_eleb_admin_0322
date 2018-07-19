@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>shop_Category</li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>分类名</th>
            <th>分类图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach ($shopcategorys as $shopcategory)
            <tr>
                <td>{{ $shopcategory->id }}</td>
                <td>{{ $shopcategory->name }}</td>
                <td><img src="{{ $shopcategory->img }}" alt="" width="50"></td>
                <td>
                    <span class="btn-sm {{ $shopcategory->status?'btn-success':'btn-warning' }}">{{ $shopcategory->status?'显示':'隐藏' }}</span></td>
                <td><a class="btn btn-warning" href="{{ route('shopcategorys.edit',[$shopcategory]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('shopcategorys.destroy',[$shopcategory]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">
                <a href="{{ route('shopcategorys.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
    </table>
@endsection