@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>shop_Category</li>
    </ol>
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>店铺分类</th>
            <th>商家名</th>
            <th>店铺图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach ($shops as $shop)
            <tr>
                <td>{{ $shop->id }}</td>
                <td>{{ $shop->shop_category_id }}</td>
                <td>{{ $shop->shop_name }}</td>
                <td><img src="{{ $shop->shop_img }}" alt="" width="50"></td>
                <td>
                    <span class="btn-sm {{ $shop->status==-1?'btn-danger':($shop->status?'btn-success':'btn-warning') }}">{{ $shop->status==-1?'禁用':($shop->status?'审核':'未审核') }}</span>
                </td>
                <td>
                    <a class="btn btn-success" href="{{ route('shops.show',[$shop]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a> <a class="btn btn-warning" href="{{ route('shops.edit',[$shop]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a> <form action="{{ route('shops.destroy',[$shop]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <a href="{{ route('shops.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
    </table>
    {{ $shops->links() }}
@endsection