<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop;
use App\Car;
class CarController extends Controller
{
    // 加入购物车
    public function carDo(){
        // 获取session
        $session=session('user');
        // dd($session);
        if(!$session){
            return json_encode(['code'=>'00000','msg'=>'请先登录']);die;
        }
        $data=request()->except('_token');
        $goods_num=Shop::select('goods_num')->where('goods_id',$data['goods_id'])->first();
        if($data['car_num']>$goods_num['goods_num']){
            return json_encode(['code'=>'00001','msg'=>'您购买的数量超过了库存']);
        }

        $data['user_id']=$session->user_id;
        $data['car_time']=time();
        $carData=Car::where(['user_id'=>$session->user_id,'goods_id'=>$data['goods_id']])->first();
        if(isset($carData)){
            $data['car_id']=$carData->car_id;
            $data['goods_id']=$data['goods_id'];
            $data['car_time']=time();
            $data['car_num']=$data['car_num']+$carData->car_num;
            $data['user_id']=$session->user_id;
            $data['cart_del']=1;
            
            // dd($data);
            if($data['car_num']>$goods_num['goods_num']){
                return json_encode(['code'=>'00001','msg'=>'您购买的总数量超过了库存']);die;
            }
            $res=Car::where(['user_id'=>$session->user_id,'goods_id'=>$data['goods_id']])->update($data);
            // dd($res);
            if($res){
                return json_encode(['code'=>'11111','msg'=>'加入购物车成功1']);die;
            }
        }
        $res=Car::insert($data);
        if($res){
            return json_encode(['code'=>'11111','msg'=>'加入购物车成功']);
        }
    }
    // 购物车
    public function car(){
        $session=session('user');
        $where=[
            ['user_id','=',$session->user_id],
            ['cart_del','=','1']
        ];
        $data=Car::select('car.*','goods_name','goods_price','goods_img')->leftjoin('shop','car.goods_id','=','shop.goods_id')->where($where)->get();
        // dd($data);
        $car_id=array_column($data->toArray(),'car_id');
        $car_num=array_column($data->toArray(),'car_num');
        $buyData=array_combine($car_id,$car_num);
        // 查询改用户下购物车有多少商品
        $count=Car::where($where)->count();
        return view('index.car',['data'=>$data,'count'=>$count,'buyData'=>$buyData]);
    }
    
}
