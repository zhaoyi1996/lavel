<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table="shop";
    protected $primaryKey="goods_id";
    // 设置时间戳
    public $timestamps=false;
    // 获取幻灯片展示商品
    public static function getslide(){
        return self::select('goods_id','goods_img')->where(['is_up'=>1,'slide'=>1])->take(5)->get();
    }
}
