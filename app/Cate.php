<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table="shop_cate";
    protected $primaryKey="cate_id";
    // 设置时间戳
    public $timestamps=false;
}
