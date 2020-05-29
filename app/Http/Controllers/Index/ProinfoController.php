<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Shop;
class ProinfoController extends Controller
{
    // 商品详情
    public function proinfo($id){
        /*********memcache**********/
        $ShopData=Cache::get('ShopData_'.$id);
        $ShopData->visit=Cache::increment($ShopData->visit);
        // dump($ShopData);
        if(!$ShopData){
            $ShopData=Shop::find($id);
            Cache::put('ShopData_'.$id,$ShopData);
        }
        // Shop::where('goods_id',$id)->update($ShopData);
        
        // dd($ShopData);
        return view('index.proinfo',['ShopData'=>$ShopData]);
    }
}
