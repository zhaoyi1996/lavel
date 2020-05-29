<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop;
use App\Car;
use App\Address;
class PayController extends Controller
{
    // 结算
    public function account($id){
        $id=explode(',',$id);
        $user=session('user');
        // 查询收货地址
        $address=Address::where('user_id',$user['user_id'])->get();
        if(!$address){
            return redirect('/addressAdd');
        }
        
        $where[]=['user_id','=',$user->user_id];
        $data=Car::select('car.*','goods_price','goods_img','goods_name')->leftjoin('shop','car.goods_id','=','shop.goods_id')->where($where)->orWhere('shop.goods_id',$id)->get();
        // 单个商品总价
        foreach($data as $k=>$v){
            $data[$k]['Oneprice']=$v->goods_price*$v->car_num;
        }
        $prices=[];
        foreach($data as $v){
            $prices[].=$v->Oneprice;
        }        
        $prices=array_sum($prices);
        return view('index.pay',['data'=>$data,'prices'=>$prices,'address'=>$address]);
    }
}
