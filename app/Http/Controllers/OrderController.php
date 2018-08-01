<?php

namespace App\Http\Controllers;


use App\Model\Menu;
use App\Model\Order;
use App\Model\OrderGood;
use App\Model\Shop;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function count(){
        //- 订单量统计[按商家分别统计和整体统计]（每日、每月、总计）
        $shops=Shop::all(['id','shop_name']);
        $arrs=[];
        foreach ($shops as $shop){
            $arr['shop_name']=$shop->shop_name;
            $arr['dayCount']=Order::where('shop_id',$shop->id)
                ->where('created_at','>=', date('Y-m-d H:i:s',strtotime('-1 day')))
                ->count();
            $arr['monthCount']=Order::where('shop_id',$shop->id)
                ->where('created_at','>=', date('Y-m-d H:i:s',strtotime('-1 month')))
                ->count();
            $arr['count']=Order::where('shop_id',$shop->id)
                ->count();
            $arrs[]=$arr;
        }
        //今日订单
        $data['dayCount']=Order::where('created_at','>=', date('Y-m-d H:i:s',strtotime('-1 day')))->count();

        //本月订单
        $data['monthCount']=Order::where('created_at','>=', date('Y-m-d H:i:s',strtotime('-1 month')))
            ->count();
        //累计订单
        $data['count']=Order::count();
        usort($arrs,function ($a,$b){
            return -($a['count']<=>$b['count']);
        });

        $data['shops']=$arrs;
        //- 菜品销量统计[按商家分别统计和整体统计]（每日、每月、总计）
        //今日销量
        $data['menuDay']=DB::table('order_goods')
            ->select(DB::raw('sum(amount) as count'))
            ->where('created_at','>=', date('Y-m-d H:i:s',strtotime('-1 day')))->first()->count;
        //本月销量
        $data['menuMonth']=DB::table('order_goods')
            ->select(DB::raw('sum(amount) as count'))
            ->where('created_at','>=', date('Y-m-d H:i:s',strtotime('-1 month')))->first()->count;

        //总计销量
        $data['menuAll']=DB::table('order_goods')
            ->select(DB::raw('sum(amount) as count'))
             ->first()->count;

        $goods=DB::table('order_goods')
            ->select(DB::raw('sum(amount) as count,goods_id,goods_name'))
            ->groupBy('goods_id')
            ->get()->toArray();
        $menus=[];
        foreach ($goods as $good){
            $menu['count']=$good->count;
            $menu['goods_name']=$good->goods_name;
            $shop_id=Menu::where('id',$good->goods_id)->first()->shop_id;
            $menu['shop_name']=Shop::where('id',$shop_id)->first()->shop_name;
            $menu['dayCount']=OrderGood::where('goods_id',$good->goods_id)
                ->select(DB::raw('sum(amount) as amount'))
                ->where('created_at','>=', date('Y-m-d H:i:s',strtotime('-1 day')))
                ->first()->amount;
            $menu['monthCount']=OrderGood::where('goods_id',$good->goods_id)
                ->select(DB::raw('sum(amount) as amount'))
                ->where('created_at','>=', date('Y-m-d H:i:s',strtotime('-1 month')))
                ->first()->amount;
            $menus[]=$menu;
        }

        usort($menus,function ($a,$b){
            return -($a['count']<=>$b['count']);
        });
        $data['menus']=$menus;


        return view('order/count',$data);
    }

    public function day(Request $request){
        $day=[['created_at','>=', date('Y-m-d H:i:s',strtotime(date('Y-m-d')))]];
        if($request->day){
            $day=[['created_at','>=',$request->day],['created_at','<',date('Y-m-d H:i:s',strtotime($request->day)+3600*24)]];
        }
        $shops=Shop::all(['id','shop_name']);
        $arrs=[];
        foreach ($shops as $shop){
            $arr['shop_name']=$shop->shop_name;
            $arr['dayCount']=Order::where('shop_id',$shop->id)
                ->where($day)
                ->count();
            $arrs[]=$arr;
        }
        usort($arrs,function ($a,$b){
            return -($a['dayCount']<=>$b['dayCount']);
        });

        $data['shops']=$arrs;
        //- 菜品销量统计[按商家分别统计和整体统计]（每日、每月、总计）
        $goods=DB::table('order_goods')
            ->select(DB::raw('sum(amount) as count,goods_id,goods_name'))
            ->groupBy('goods_id')
            ->get()->toArray();
        $menus=[];
        foreach ($goods as $good){
            $menu['count']=$good->count;
            $menu['goods_name']=$good->goods_name;
            $shop_id=Menu::where('id',$good->goods_id)->first()->shop_id;
            $menu['shop_name']=Shop::where('id',$shop_id)->first()->shop_name;
            $menu['dayCount']=OrderGood::where('goods_id',$good->goods_id)
                ->select(DB::raw('sum(amount) as amount'))
                ->where($day)
                ->first()->amount;
            $menus[]=$menu;
        }

        usort($menus,function ($a,$b){
            return -($a['dayCount']<=>$b['dayCount']);
        });
        $data['menus']=$menus;
        $data['day']=$request->day;

        return view('order/order_day',$data);
    }

    public function month(Request $request){
        $date=$request->year.'-'.$request->month;
        $month=[['created_at','>=', date('Y-m-d H:i:s',strtotime(date('Y-m')))]];
        if($request->month){
            $month=[['created_at','>=',date('Y-m-d H:i:s',strtotime($date))],['created_at','<',date('Y-m-d H:i:s',strtotime('+1 month',strtotime($date)))]];
        }
        $shops=Shop::all(['id','shop_name']);
        $arrs=[];
        foreach ($shops as $shop){
            $arr['shop_name']=$shop->shop_name;
            $arr['dayCount']=Order::where('shop_id',$shop->id)
                ->where($month)
                ->count();
            $arrs[]=$arr;
        }
        usort($arrs,function ($a,$b){
            return -($a['dayCount']<=>$b['dayCount']);
        });

        $data['shops']=$arrs;
        //- 菜品销量统计[按商家分别统计和整体统计]（每日、每月、总计）
        $goods=DB::table('order_goods')
            ->select(DB::raw('sum(amount) as count,goods_id,goods_name'))
            ->groupBy('goods_id')
            ->get()->toArray();
        $menus=[];
        foreach ($goods as $good){
            $menu['count']=$good->count;
            $menu['goods_name']=$good->goods_name;
            $shop_id=Menu::where('id',$good->goods_id)->first()->shop_id;
            $menu['shop_name']=Shop::where('id',$shop_id)->first()->shop_name;
            $menu['dayCount']=OrderGood::where('goods_id',$good->goods_id)
                ->select(DB::raw('sum(amount) as amount'))
                ->where($month)
                ->first()->amount;
            $menus[]=$menu;
        }

        usort($menus,function ($a,$b){
            return -($a['dayCount']<=>$b['dayCount']);
        });
        $data['menus']=$menus;
        $data['month']=$request->month;
        $data['year']=$request->year;

        return view('order/order_month',$data);
    }


    public function orderMenu(){
        //- 菜品销量统计[按商家分别统计和整体统计]（每日、每月、总计）
        $menus=DB::select("select * from
        (select s.shop_name,sum(o.amount) as amount,o.goods_id,m.goods_name
from order_goods as o 
LEFT JOIN menus as m on o.goods_id=m.id
LEFT JOIN shops as s on s.id=m.shop_id
GROUP BY o.goods_id
ORDER BY amount DESC) as a
group by shop_name
ORDER BY amount DESC");
        return view('order/order_menu',compact('menus'));
    }


    public function dayMenu(Request $request){
        //- 菜品销量统计[按商家分别统计和整体统计]（每日、每月、总计）
        $day="o.created_at>='".date('Y-m-d H:i:s',strtotime(date('Y-m-d')))."'";
        if($request->day){
            $day="o.created_at>='".$request->day."' and o.created_at<'".date('Y-m-d H:i:s',strtotime($request->day)+3600*24)."'";
        }
        $data['menus']=DB::select("select * from
        (select s.shop_name,sum(o.amount) as amount,o.goods_id,m.goods_name,o.created_at
from order_goods as o 
LEFT JOIN menus as m on o.goods_id=m.id
LEFT JOIN shops as s on s.id=m.shop_id
where $day
GROUP BY o.goods_id
ORDER BY amount DESC) as a
group by shop_name
ORDER BY amount DESC");
        $data['day']=$request->day;
        return view('order/order_day_menu',$data);
    }

    public function monthMenu(Request $request){
        //- 菜品销量统计[按商家分别统计和整体统计]（每日、每月、总计）
        $date=$request->year.'-'.$request->month;
        $month="o.created_at>='".date('Y-m-d H:i:s',strtotime(date('Y-m')))."'";
        if($request->month){
            $month="o.created_at>='".date('Y-m-d H:i:s',strtotime($date))."' and o.created_at<'".date('Y-m-d H:i:s',strtotime('+1 month',strtotime($date)))."'";
        }
        $data['menus']=DB::select("select * from
        (select s.shop_name,sum(o.amount) as amount,o.goods_id,m.goods_name,o.created_at
from order_goods as o 
LEFT JOIN menus as m on o.goods_id=m.id
LEFT JOIN shops as s on s.id=m.shop_id
where {$month}
GROUP BY o.goods_id
ORDER BY amount DESC) as a
group by shop_name
ORDER BY amount DESC");
        $data['month']=$request->month;
        $data['year']=$request->year;
        return view('order/order_month_menu',$data);
    }

}
