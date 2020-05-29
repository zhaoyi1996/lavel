<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table="shop_area";
    protected $primaryKey="id";
    // 设置时间戳
    public $timestamps=false;
}
