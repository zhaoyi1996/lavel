<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $table="brand";
    protected $primaryKey="brand_id";
    // 设置时间戳
    public $timestamps=false;
}
