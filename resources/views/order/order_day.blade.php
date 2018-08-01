@extends('default')
@section('content')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">Order</a></li>
        <li>Order_Show</li>
    </ol>
    <div class="row">
        <div class="col-xs-3">
            <a href="{{ route('orders.day') }}" class="btn btn-info">按天统计</a>
            <a href="{{ route('orders.month') }}"  class="btn btn-info">按月统计</a>
            <a href="{{ route('orders.count') }}"  class="btn btn-info">累计</a>

            <a href="{{ route('orders.dayMenu') }}" class="btn btn-info">菜品销量</a>
            <a href="{{ route('orders.monthMenu') }}"  class="btn btn-info">按月统计</a>
            <a href="{{ route('orders.orderMenu') }}"  class="btn btn-info">累计</a>
        </div>
        <div class="col-xs-4" id="search">
            <form action="{{ route('orders.day') }}" method="get">
                <div class="input-group">
                    <input type="date" class="form-control" name="day" value="{{ $day??date('Y-m-d') }}">
                    <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
            </span>
                </div>
            </form>
        </div>
    </div>

    <div class="jumbotron row">
        <h1 class="text-center">{{ $day??date('Y年m月d日') }}</h1>
        <div class="col-xs-4">
            <table class="table table-striped table-hover table-bordered table-condensed">
                <tr>
                    <th>商家名</th>
                    <th>今日订单</th>
                </tr>
                @foreach($shops as $key=>$shop)
                    <tr>
                        <td>{{ $shop['shop_name'] }}</td>
                        <td>{{ $shop['dayCount'] }}</td>
                    </tr>
                    @if($key==9)
                        @break
                    @endif
                @endforeach
            </table>
        </div>
        <div class="col-xs-8">
            <table class="table table-striped table-hover table-bordered table-condensed">
                <tr>
                    <th>菜品</th>
                    <th>商家名</th>
                    <th>今日销量</th>
                </tr>
                @foreach($menus as $key=>$menu)
                    <tr>
                        <td>{{ $menu['goods_name'] }}</td>
                        <td>{{ $menu['shop_name'] }}</td>
                        <td>{{ $menu['dayCount'] }}</td>
                    </tr>
                    @if($key==9)
                        @break
                    @endif
                @endforeach
            </table>
        </div>
    </div>
@endsection