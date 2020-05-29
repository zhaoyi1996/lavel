<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etype extends Model
{
    //
    protected $table="etype";
    protected $primaryKey="e_id";
    // 设置时间戳
    public $timestamps=false;
}
