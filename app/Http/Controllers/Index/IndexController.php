<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Shop;
use App\Cate;
class IndexController extends Controller
{
    // 首页
    public function index(){
        $session=session('user');
        // 查询商品信息
        /*********memcache**********/
        // $Shopdata=Cache::get('Shopdata');
        /*********memcache**********/
        $Shopdata=Redis::get('Shopdata');
        // dump($Shopdata);
        if(!$Shopdata){
            // echo 'DB';
            /*********memcache**********/
            $Shopdata=Shop::select('goods_id','goods_name','goods_img','goods_price')->get();
            // Cache::put('Shopdata',$Shopdata);
            /*********memcache**********/
            $Shopdata=serialize($Shopdata);
            Redis::set('Shopdata',$Shopdata);
        }
        $Shopdata=unserialize($Shopdata);
        // dd($Shopdata);
        // 获取幻灯片数据
        $slide=Cache::get('slide');
        if(!$slide){
            // echo 'dd';
            $slide=Shop::getslide();
            Cache::put('slide',$slide);
        }
        
        // dd($slide);
        // 查询顶级分类
        $TopData=Cache::get('TopData');
        if(!$TopData){
            $TopData=Cate::where('p_id',0)->get();
            Cache::put('TopData',$TopData);
        }
        // dd($CateData);
        return view('index.index',['slide'=>$slide,'TopData'=>$TopData,'session'=>$session,'Shopdata'=>$Shopdata]);
    }
}
