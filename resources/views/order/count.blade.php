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

        </div>
    </div>
    <div class="jumbotron row">
        <div class="col-xs-4">
            <p> 今日订单:<span style="font-weight: bold; color: red">{{ $dayCount }}</span></p>
            <p> 本月订单:<span style="font-weight: bold; color: red">{{ $monthCount }}</span></p>
            <p> 累计订单:<span style="font-weight: bold; color: red">{{ $count }}</span></p>
            <table class="table table-striped table-hover table-bordered table-condensed">
                <tr>
                    <th>商家名</th>
                    <th>今日订单</th>
                    <th>本月订单</th>
                    <th>总订单</th>
                </tr>
                @foreach($shops as $key=>$shop)
                    <tr>
                        <td>{{ $shop['shop_name'] }}</td>
                        <td>{{ $shop['dayCount'] }}</td>
                        <td>{{ $shop['monthCount'] }}</td>
                        <td>{{ $shop['count'] }}</td>
                    </tr>
                    @if($key==9)
                        @break
                    @endif
                @endforeach
            </table>
        </div>
        <div class="col-xs-8">
            <p> 今日销量:<span style="font-weight: bold; color: red">{{ $menuDay }}</span></p>
            <p> 本月销量:<span style="font-weight: bold; color: red">{{ $menuMonth }}</span></p>
            <p> 累计销量:<span style="font-weight: bold; color: red">{{ $menuAll }}</span></p>
            <table class="table table-striped table-hover table-bordered table-condensed">
                <tr>
                    <th>菜品</th>
                    <th>商家名</th>
                    <th>今日销量</th>
                    <th>本月销量</th>
                    <th>总销量</th>
                </tr>
                @foreach($menus as $key=>$menu)
                    <tr>
                        <td>{{ $menu['goods_name'] }}</td>
                        <td>{{ $menu['shop_name'] }}</td>
                        <td>{{ $menu['dayCount'] }}</td>
                        <td>{{ $menu['monthCount'] }}</td>
                        <td>{{ $menu['count'] }}</td>
                    </tr>
                    @if($key==9)
                        @break
                    @endif
                @endforeach
            </table>
        </div>
    </div>
@endsection